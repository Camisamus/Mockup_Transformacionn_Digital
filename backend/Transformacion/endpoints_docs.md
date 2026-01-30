# Documentación de Endpoints API - Backend

Esta es la lista de endpoints disponibles en el backend, sus métodos y las estructuras de datos requeridas.

## Base URL
`/backend/api/`

---

## 1. Autenticación

### Login
- **URL**: `login.php`
- **Método**: `POST`
- **Body**:
```json
{
  "usuario": "nombre_usuario",
  "password": "tu_password"
}
```

### Logout
- **URL**: `logout.php`
- **Método**: `GET`

### Verificar Sesión
- **URL**: `verify_session.php`
- **Método**: `GET`
- **Descripción**: Retorna el estado de la sesión, datos del usuario y sus permisos.

---

## 2. Solicitudes

### Listar / Obtener Solicitud
- **URL**: `solicitudes.php`
- **Método**: `GET`
- **Parámetros**: `id` (opcional, para obtener una específica)
- **Nota**: Al consultar por `id`, se incluirá un arreglo `respuestas` con todas las respuestas asociadas.

#### Ejemplo de Respuesta (con ID):
```json
{
  "status": "success",
  "data": {
    "ID_Solicitud": 123,
    "Nombre_expediente": "...",
    "respuestas": [
      {
        "ID_Respuesta": 1,
        "Solicitud_res": 123,
        "respuesta": "Texto de la respuesta...",
        "Fecha_respuesta": "2023-12-24 10:30:00"
      }
    ]
  }
}
```

### Crear Solicitud
- **URL**: `solicitudes.php`
- **Método**: `POST`
- **Body**:
```json
{
  "ID_Solicitud": 123,
  "Ingreso_Desve": "Texto",
  "Nombre_expediente": "Nombre",
  "Origen_solicitud": 1,
  "Origen_solicitud_texto": "Texto adicional",
  "Detalle_ingreso": "Detalle",
  "Fecha_ultima_recepcion_Erwin": "2023-12-24 10:00:00",
  "Prioridad": 1,
  "Funcionario_Interno": 1,
  "Sector": 1,
  "Fecha_vecimiento": "2024-01-24 10:00:00",
  "Entrego_Coordinador": false,
  "Fecha_respuesta_coordinador": null,
  "Estado_de_entrega": false,
  "Dias_transcurridos_vencimiento": 0,
  "OBSERVACIONES": "Notas",
  "Dias_transcurridos": 0,
  "Reingreso": null
}
```

### Actualizar Solicitud
- **URL**: `solicitudes.php?id={ID}`
- **Método**: `PUT`
- **Body**: (Igual al de creación)

### Eliminar Solicitud
- **URL**: `solicitudes.php?id={ID}`
- **Método**: `DELETE`

---

## 3. Organizaciones

### Listar Organizaciones
- **URL**: `organizaciones.php`
- **Método**: `GET`

### Crear Organización
- **URL**: `organizaciones.php`
- **Método**: `POST`
- **Body**:
```json
{
  "Nombre_organizacion": "Nombre nuevo",
  "Tipo_organizacion": 1
}
```

---

## 4. Funcionarios

### Listar Funcionarios
- **URL**: `funcionarios.php`
- **Método**: `GET`

### Crear Funcionario
- **URL**: `funcionarios.php`
- **Método**: `POST`
- **Body**:
```json
{
  "RUT": "12.345.678-9",
  "Nombre": "Juan Pérez",
  "Cargo": "Analista"
}
```

---

## 5. Respuestas

### Ingresar Respuesta
- **URL**: `respuestas.php`
- **Método**: `POST`
- **Body**:
```json
{
  "Solicitud_res": 123,
  "respuesta": "Texto de la respuesta..."
}
```

---

## 6. Catálogos (Solo Consulta)

### Tipos de Organización
- **URL**: `tipo_organizaciones.php`
- **Método**: `GET`

### Sectores
- **URL**: `sectores.php`
- **Método**: `GET`

### Prioridades
- **URL**: `prioridades.php`
- **Método**: `GET`
