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
