document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-empresa');
    const tableBody = document.getElementById('lista-empresas');
    const emptyState = document.getElementById('empty-state');

    // Load initial data logic moved to bottom


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

            // Trigger Sidebar update if available logic exists globally
            // For now, reload or custom event could be used, but since sidebar is persistent/reloaded, 
            // we might need to force a reload of the selector if we want immediate feedback in the sidebar without refresh.
            // Let's dispatch a custom event on window
            window.dispatchEvent(new Event('companiesUpdated'));
        }
    });

    function getCompanies() {
        return JSON.parse(localStorage.getItem('local_companies')) || [];
    }

    function saveCompanies(companies) {
        localStorage.setItem('local_companies', JSON.stringify(companies));
    }

    function renderTable() {
        const companies = getCompanies();
        tableBody.innerHTML = '';

        if (companies.length === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
            companies.forEach((company, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${company.rut}</td>
                    <td class="fw-bold">${company.nombre}</td>
                    <td><span class="badge bg-light text-dark border"><i data-feather="file-text" style="width:12px"></i> ${company.doc}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger btn-delete" data-index="${index}">
                            <i data-feather="trash-2"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Re-attach listeners involved in innerHTML
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', () => {
                    deleteCompany(btn.getAttribute('data-index'));
                });
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

    async function deleteCompany(index) {
        const result = await Swal.fire({
            title: '¿Está seguro?',
            text: '¿Está seguro de eliminar esta empresa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
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
        fetch('../recursos/jsons/empresas_mock.json')
            .then(response => response.json())
            .then(data => {
                localStorage.setItem('local_companies', JSON.stringify(data));
                renderTable(); // Use renderTable directly which acts as loadCompanies
            })
            .catch(error => console.error('Error loading mock companies:', error));
    } else {
        renderTable();
    }
});
