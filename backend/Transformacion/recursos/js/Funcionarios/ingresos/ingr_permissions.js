/**
 * Ingresos Permission Utility
 * Maps rol_usuario to granular permissions.
 */

const IngrPermissions = {
    getPermissions: function (rol) {
        // Normalize role
        const r = rol ? rol.toLowerCase() : 'consultor';

        return {
            consultar: true, // Everyone with access can see
            editar: r === 'responsable',
            preparar: ['responsable', 'visador', 'firmante'].includes(r),
            comentar: ['responsable', 'visador', 'firmante'].includes(r),
            bitacora: ['responsable', 'consultor'].includes(r),
            visar: r === 'visador',
            firmar: r === 'firmante'
        };
    },

    /**
     * Helper to apply visibility to UI elements based on role
     */
    applyToUI: function (rol) {
        const p = this.getPermissions(rol);

        // Editar Column
        const colModificar = document.getElementById('col_ir_modificar');
        if (colModificar) colModificar.style.display = p.editar ? 'block' : 'none';

        // Comentar Button (Stays in its own logic)
        const btnComentar = document.getElementById('btn_abrir_comentario');
        if (btnComentar) btnComentar.style.display = p.comentar ? 'block' : 'none';

        // Bitacora Section
        const sectionBitacora = document.getElementById('lista_bitacora');
        const containerBitacora = sectionBitacora ? sectionBitacora.closest('.card') : null;
        if (containerBitacora) containerBitacora.style.display = p.bitacora ? 'block' : 'none';

        // Responder Column (Visar/Firmar)
        const colResponder = document.getElementById('col_ir_responder');
        if (colResponder) {
            colResponder.style.display = (p.visar || p.firmar) ? 'block' : 'none';
        }

        // Preparar Column
        const colPreparar = document.getElementById('col_ir_preparar');
        if (colPreparar) {
            colPreparar.style.display = p.preparar ? 'block' : 'none';
        }

        return p;
    }
};
