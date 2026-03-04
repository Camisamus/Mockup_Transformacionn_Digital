/**
 * Ingresos Permission Utility
 * Maps rol_usuario to granular permissions.
 */

const IngrPermissions = {
    getPermissions: function (rol) {
        // Normalize role
        const r = rol ? rol.toLowerCase() : 'lector';

        return {
            consultar: true, // Everyone with access can see
            editar: ['propietario'].includes(r),
            preparar: ['responsable', 'visador', 'firmante', 'lector'].includes(r),
            comentar: ['responsable', 'propietario', 'visador', 'firmante', 'lector'].includes(r),
            bitacora: ['responsable', 'propietario', 'lector'].includes(r),
            visar: ['visador'].includes(r),
            firmar: r === 'firmante',
            responder: ['responsable', 'firmante'].includes(r)
        };
    },

    /**
     * Helper to apply visibility to UI elements based on role
     */
    applyToUI: function (rol) {
        const r = rol ? rol.toLowerCase() : 'lector';
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

        // Responder Column (Visar/Firmar/Respondar-Resp)
        const colResponder = document.getElementById('col_ir_responder');
        if (colResponder) {
            colResponder.style.display = (p.visar || p.firmar) ? 'block' : 'none';
        }

        // Preparar Column
        const colPreparar = document.getElementById('col_ir_preparar');
        if (colPreparar) {
            colPreparar.style.display = p.preparar ? 'block' : 'none';
        }

        // PESTAÑAS (TABS)
        const tabVisar = document.getElementById('nav-visar');
        if (tabVisar) tabVisar.style.display = p.visar ? 'block' : 'none';

        const tabResponder = document.getElementById('nav-responder');
        if (tabResponder) tabResponder.style.display = p.responder ? 'block' : 'none';

        // Pestañas comunes (siempre visibles por ahora según requerimiento)
        const tabsComunes = ['nav-detalle', 'nav-derivacion', 'nav-dependencia', 'nav-mapa', 'nav-historial'];
        tabsComunes.forEach(tid => {
            const el = document.getElementById(tid);
            if (el) el.style.display = 'block';
        });

        return p;
    }
};
