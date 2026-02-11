document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-empresa');
    const tableBody = document.getElementById('lista-empresas');
    const emptyState = document.getElementById('empty-state');

    // Form Submit Handler
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const rut = document.getElementById('empresaRut').value;
        const nombre = document.getElementById('empresaNombre').value;
        const fileInput = document.getElementById('empresaDoc');
        const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Documento.pdf';

        if (rut && nombre) {
            addCompany({ rut, nombre, doc: fileName });
            form.reset();
            window.dispatchEvent(new Event('companiesUpdated'));

            Swal.fire({
                icon: 'success',
                title: 'Empresa Registrada',
                text: 'La empresa ha sido agregada exitosamente.',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });

    function getCompanies() {
        return JSON.parse(localStorage.getItem('local_companies')) || [];
    }

    function saveCompanies(companies) {
        localStorage.setItem('local_companies', JSON.stringify(companies));
    }

    function renderTable() {
        if (!tableBody) return;
        const companies = getCompanies();
        tableBody.innerHTML = '';

        if (companies.length === 0) {
            if (emptyState) emptyState.style.display = 'block';
        } else {
            if (emptyState) emptyState.style.display = 'none';
            companies.forEach((company, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="fw-bold">${company.rut}</td>
                    <td>${company.nombre}</td>
                    <td>
                        <span class="badge bg-light text-dark border fw-normal shadow-xs">
                             <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                             ${company.doc}
                        </span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-danger" onclick="window.deleteCompany(${index})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            if (window.feather) window.feather.replace();
        }
    }

    function addCompany(company) {
        const companies = getCompanies();
        companies.push(company);
        saveCompanies(companies);
        renderTable();
    }

    window.deleteCompany = async function (index) {
        const result = await Swal.fire({
            title: '¿Eliminar empresa?',
            text: 'Esta acción desvinculará la representación de la empresa.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (result.isConfirmed) {
            const companies = getCompanies();
            companies.splice(index, 1);
            saveCompanies(companies);
            renderTable();
            window.dispatchEvent(new Event('companiesUpdated'));
        }
    }

    // Initialize
    if (!localStorage.getItem('local_companies')) {
        fetch('../../recursos/jsons/empresas_mock.json')
            .then(response => response.json())
            .then(data => {
                localStorage.setItem('local_companies', JSON.stringify(data));
                renderTable();
            })
            .catch(error => {
                console.error('Error loading mock companies:', error);
                renderTable();
            });
    } else {
        renderTable();
    }
});
