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

        // Editar Button
        const btnModificar = document.getElementById('btn_ir_modificar');
        if (btnModificar) btnModificar.style.display = p.editar ? 'block' : 'none';

        // Comentar Button
        const btnComentar = document.getElementById('btn_abrir_comentario');
        if (btnComentar) btnComentar.style.display = p.comentar ? 'block' : 'none';

        // Bitacora Section
        const sectionBitacora = document.getElementById('lista_bitacora');
        const containerBitacora = sectionBitacora ? sectionBitacora.closest('.card') : null;
        if (containerBitacora) containerBitacora.style.display = p.bitacora ? 'block' : 'none';

        // Responder Button (Visar/Firmar)
        const btnResponder = document.getElementById('btn_ir_responder');
        if (btnResponder) {
            btnResponder.style.display = (p.visar || p.firmar) ? 'block' : 'none';
        }

        // Preparar Button
        const btnPreparar = document.getElementById('btn_ir_preparar');
        if (btnPreparar) {
            btnPreparar.style.display = p.preparar ? 'block' : 'none';
        }

        return p;
    }
};
