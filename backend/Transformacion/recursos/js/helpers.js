/**
 * Formats a RUT to xxxxxxxx-k format (lowercase, no dots, with hyphen).
 * @param {string} rut 
 * @returns {string}
 */
function formatRut(rut) {
    if (!rut) return '';

    // Remove dots, hyphens and spaces
    let value = rut.replace(/[.\- ]/g, '');

    // Convert to lowercase
    value = value.toLowerCase();

    // Insert hyphen before last character if length > 1
    if (value.length > 1) {
        value = value.substring(0, value.length - 1) + '-' + value.substring(value.length - 1);
    }

    return value;
}

/**
 * Validates a Chilean RUT.
 * @param {string} rut 
 * @returns {boolean}
 */

function formatearFecha(fechaAnioMesDia) {
    // Si la fecha viene vacía o nula, retornamos un aviso o string vacío
    if (!fechaAnioMesDia) return "";

    // Dividimos la cadena por el guion
    const [anio, mes, dia] = fechaAnioMesDia.split("-");

    // Retornamos en el nuevo orden deseado
    return `${dia}-${mes}-${anio}`;
}

function validateRut(rut) {
    if (!rut) return false;
    let clean = rut.replace(/[.\- ]/g, '').toUpperCase();
    if (clean.length < 2) return false;

    let body = clean.slice(0, -1);
    let dv = clean.slice(-1);

    let sum = 0;
    let multiplier = 2;

    for (let i = body.length - 1; i >= 0; i--) {
        sum += parseInt(body[i]) * multiplier;
        multiplier = multiplier === 7 ? 2 : multiplier + 1;
    }

    let expectedDv = 11 - (sum % 11);
    expectedDv = expectedDv === 11 ? '0' : expectedDv === 10 ? 'K' : expectedDv.toString();

    return dv === expectedDv;
}

/**
 * Calcula los días hábiles restantes desde hoy hasta una fecha dada (excluyendo fines de semana).
 * @param {string} fechaStr - Fecha en formato DD-MM-YYYY
 * @returns {number|string} Cantidad de días hábiles restantes (puede ser negativo si ya venció), o '-' si es inválida.
 */
function calcularDiasHabilesRestantes(fechaStr) {
    if (!fechaStr || fechaStr === 'N/A' || fechaStr === '-') return '-';

    const partes = fechaStr.split(' ')[0].split('-');
    if (partes.length !== 3) return '-';

    const dia = parseInt(partes[2], 10);
    const mes = parseInt(partes[1], 10) - 1; // Meses en JS son 0-11
    const anio = parseInt(partes[0], 10);

    const fechaVencimiento = new Date(anio, mes, dia);
    fechaVencimiento.setHours(23, 59, 59, 999); // Fin del día de vencimiento

    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0); // Inicio del día de hoy

    if (isNaN(fechaVencimiento.getTime())) return '-';

    let diasHabiles = 0;
    let fechaIteracion = new Date(hoy);

    if (fechaIteracion > fechaVencimiento) {
        // La fecha ya pasó, contamos días hábiles de atraso (negativos)
        while (fechaIteracion > fechaVencimiento) {
            fechaIteracion.setDate(fechaIteracion.getDate() - 1);
            const diaSemana = fechaIteracion.getDay();
            // 0 = Domingo, 6 = Sábado
            if (diaSemana !== 0 && diaSemana !== 6) {
                diasHabiles--;
            }
        }
    } else {
        // La fecha es futura, contamos días hábiles a favor
        while (fechaIteracion < fechaVencimiento) {
            const diaSemana = fechaIteracion.getDay();
            // 0 = Domingo, 6 = Sábado
            if (diaSemana !== 0 && diaSemana !== 6) {
                diasHabiles++;
            }
            fechaIteracion.setDate(fechaIteracion.getDate() + 1);
        }
    }

    return diasHabiles;
}

/**
 * Calcula los días transcurridos desde una fecha dada hasta hoy (incluyendo fines de semana).
 * @param {string} fechaStr - Fecha en formato YYYY-MM-DD
 * @returns {number|string} Cantidad de días transcurridos, o '-' si es inválida.
 */
function calcularDiasTranscurridos(fechaStr) {
    if (!fechaStr || fechaStr === 'N/A' || fechaStr === '-') return '-';

    const partes = fechaStr.split(' ')[0].split('-');
    if (partes.length !== 3) return '-';

    const dia = parseInt(partes[2], 10);
    const mes = parseInt(partes[1], 10) - 1;
    const anio = parseInt(partes[0], 10);

    const fechaInicio = new Date(anio, mes, dia);
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0);

    const diff = hoy - fechaInicio;
    return Math.max(0, Math.floor(diff / (1000 * 60 * 60 * 24)));
}
