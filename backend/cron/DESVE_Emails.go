package main

import (
	"bufio"
	"database/sql"
	"fmt"
	"log"
	"net/smtp"
	"os"
	"strconv"
	"strings"
	"time"

	_ "github.com/go-sql-driver/mysql"
)

var config = make(map[string]string)

func cargarVariables(ruta string) {
	file, err := os.Open(ruta)
	if err != nil {
		log.Fatal("Error cargando Variables.txt:", err)
	}
	defer file.Close()

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		linea := scanner.Text()
		parts := strings.SplitN(linea, "=", 2)
		if len(parts) == 2 {
			config[strings.TrimSpace(parts[0])] = strings.TrimSpace(parts[1])
		}
	}
}

func tareaEterna() {
	// Parse frequency or default to 10 minutes
	minutes := 10
	if val, ok := config["FRECUENCIA_EMAILS"]; ok {
		if m, err := strconv.Atoi(val); err == nil && m > 0 {
			minutes = m
		}
	}

	ticker := time.NewTicker(time.Duration(minutes) * time.Minute)
	defer ticker.Stop()

	// Ejecutar inmediatamente al iniciar
	ejecutarCiclo()

	for {
		log.Printf("Esperando %d minutos para el siguiente ciclo...\n", minutes)
		<-ticker.C
		ejecutarCiclo()
	}
}

func ejecutarCiclo() {
	log.Println("Iniciando ciclo de revisión de solicitudes...")

	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?parseTime=true",
		config["USUARIO_BDD"],
		config["PASSWORD_BDD"],
		config["SERVIDOR_BDD"],
		config["PORT_BDD"],
		config["NOMBRE_BDD"])

	db, err := sql.Open("mysql", dsn)
	if err != nil {
		log.Println("Error conexión DB:", err)
		return
	}
	defer db.Close()

	if err := db.Ping(); err != nil {
		log.Println("Error ping DB:", err)
		return
	}

	procesarSolicitudes(db)
	log.Println("Ciclo completado.")
}

func procesarSolicitudes(db *sql.DB) {
	// Query ajustada a los modelos trd_desve_solicitudes y trd_acceso_usuarios.
	// Asumimos que "entregado en conformidad" corresponde a estado de entrega pendiente (0)
	// o filtramos por aquellos que no estan 'entregados'.
	// trd_desve_solicitudes: sol_estado_entrega (boolean), sol_fecha_vencimiento, sol_funcionario_id
	// trd_acceso_usuarios: usr_id, usr_nombre, usr_email

	query := `SELECT 
				u.usr_nombre, 
				u.usr_email, 
				s.sol_fecha_vencimiento 
			  FROM trd_desve_solicitudes s
			  JOIN trd_acceso_usuarios u ON s.sol_funcionario_id = u.usr_id
			  WHERE s.sol_estado_entrega = 0 
			    AND s.sol_borrado = 0
				AND s.sol_fecha_vencimiento IS NOT NULL`

	rows, err := db.Query(query)
	if err != nil {
		log.Println("Error en query:", err)
		return
	}
	defer rows.Close()

	count := 0
	for rows.Next() {
		var nombre, email string
		var fechaLimite time.Time

		if err := rows.Scan(&nombre, &email, &fechaLimite); err != nil {
			log.Println("Error leyendo fila:", err)
			continue
		}

		// Calcular diferencia de días.
		// Time.Until(t) returns duration until t. If t is in past, negative.
		// fechaLimite is the deadline.
		// Exmple: Deadline tomorrow (future). Until > 0.
		// Expired yesterday (past). Until < 0.

		diferencia := time.Until(fechaLimite)
		dias := int(diferencia.Hours() / 24)

		enviarEmail(nombre, email, dias)
		count++
	}
	log.Printf("Procesadas %d solicitudes.\n", count)
}

func enviarEmail(nombre, destino string, dias int) {
	from := config["REMITENTE_EMAIL"]
	user := config["USUARIO_EMAIL"]
	pass := config["PASSWORD_EMAIL"]
	host := config["HOST_EMAIL"]
	port := config["PUERTO_EMAIL"]

	if from == "" {
		from = user // Fallback
	}

	var subject, body string
	if dias >= 0 {
		subject = "Recordatorio Fecha Limite"
		body = fmt.Sprintf("Hola %s,\n\nTe quedan %d dias para la fecha limite de tu solicitud pendiente.\n\nAtte,\nSistema", nombre, dias)
	} else {
		subject = "Alerta de Expiracion"
		body = fmt.Sprintf("Hola %s,\n\nTu solicitud expiro hace %d dias.\n\nAtte,\nSistema", nombre, -dias)
	}

	msg := fmt.Sprintf("From: %s\r\nTo: %s\r\nSubject: %s\r\n\r\n%s", from, destino, subject, body)

	addr := fmt.Sprintf("%s:%s", host, port)
	auth := smtp.PlainAuth("", user, pass, host)

	err := smtp.SendMail(addr, auth, from, []string{destino}, []byte(msg))

	if err != nil {
		log.Printf("Error enviando email a %s: %v\n", destino, err)
	} else {
		log.Printf("Email enviado a %s (Días: %d)\n", destino, dias)
	}
}

func main() {
	cargarVariables("Variables.txt")
	fmt.Println("Clon Cron Go iniciado...")

	tareaEterna()
}
