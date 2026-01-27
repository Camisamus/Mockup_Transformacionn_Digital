/**
 * Export Utilities for MuniERP
 * Requires: XLSX (SheetJS) and html2pdf.js
 */

/**
 * Export an HTML Table to Excel (.xlsx)
 * @param {string} tableId - The ID of the table element to export
 * @param {string} filename - Desired filename (without extension)
 */
function exportTableToExcel(tableId, filename = 'export') {
    const table = document.getElementById(tableId);
    if (!table) {
        console.error(`Table with ID '${tableId}' not found.`);
        return;
    }

    // Use XLSX utils to generate workbook
    const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
    XLSX.writeFile(wb, `${filename}.xlsx`);
}

/**
 * Export an HTML Element (Form/Container) to PDF
 * @param {string} elementId - The ID of the element to export
 * @param {string} filename - Desired filename (without extension)
 */
function exportElementToPDF(elementId, filename = 'document') {
    const element = document.getElementById(elementId);
    if (!element) {
        console.error(`Element with ID '${elementId}' not found.`);
        return;
    }

    const opt = {
        margin: 0.5,
        filename: `${filename}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Use html2pdf lib
    html2pdf().set(opt).from(element).save();
}

/**
 * Export JSON Data to Excel (.xlsx)
 * @param {Array<Object>} data - Array of objects to export
 * @param {string} filename - Desired filename (without extension)
 */
function exportJsonToExcel(data, filename = 'export') {
    if (!data || !data.length) {
        console.error('No data to export');
        return;
    }
    const ws = XLSX.utils.json_to_sheet(data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
    XLSX.writeFile(wb, `${filename}.xlsx`);
}
