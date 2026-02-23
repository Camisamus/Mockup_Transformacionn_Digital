# Plan Maestro de Auditoría y Actualización: Base de Datos v2026.02.19

Este plan detalla la hoja de ruta técnica para migrar el código fuente del sistema a la nueva estructura de base de datos, asegurando el cumplimiento del protocolo de desarrollo y la nueva terminología de negocio.

---

## Fase 1: Infraestructura y Control de Acceso (Fundación)
**Objetivo**: Asegurar que el sistema se conecte a la base de datos correcta y que el módulo de seguridad (Login/Permisos) funcione con los nuevos nombres de tablas.

1.  **Actualización de Conexión**:
    - Modificar `Database.php` para apuntar a `transformacion_digital`.
    - Auditar archivo `.env` para sincronizar credenciales.
2.  **Refactorización del Módulo de Acceso**:
    - Actualizar Modelos: `RolAcceso.php`, `PerfilAcceso.php`, `PerfilRolAcceso.php`, `UsuarioPerfilAcceso.php`.
    - Renombrar constantes internas de tablas:
        - `trd_acceso_perfiles` → `trd_acceso_roles`
        - `trd_acceso_roles` → `trd_acceso_permisos`
        - `trd_acceso_perfiles_roles` → `trd_acceso_permiso_rol`
        - `trd_acceso_usuarios_perfiles` → `trd_acceso_rol_usuario`
3.  **Verificación de Login**: Validar que la autenticación y carga de menú (drill-down) operen correctamente con los nuevos nombres.

---

## Fase 2: Registro General y Core de Negocio (Expedientes)
**Objetivo**: Adaptar los módulos DESVE, OIRS e Ingresos a la nueva terminología de "Expedientes" y corregir inconsistencias de prefijos técnicos.

1.  **Refactor del Registro General**:
    - Actualizar `Bitacora.php`, `GesDoc.php` y repositorios generales.
    - Cambiar `trd_general_registro_general_tramites` → `trd_general_registro_general_expedientes`.
2.  **Corrección de Prefijos Rule 2**:
    - Actualizar `Bitacora.php`: `` `bit-responsable` `` → `bit_responsable`.
    - Actualizar `GesDoc.php`: `` `doc-responsable` `` → `docv_responsable`.
3.  **Soporte de Feriados**:
    - Actualizar controladores de OIRS y validadores de fechas.
    - Cambiar `sup_feriados` → `trd_soporte_feriados`.

---

## Fase 3: Integridad de Datos y Soft Delete (Lógica)
**Objetivo**: Erradicar el borrado físico de registros e implementar el filtrado preventivo de registros marcados como borrados.

1.  **Enfuerzo de Soft Delete (Borrado Lógico)**:
    - Buscar todas las sentencias `DELETE FROM` en PHP.
    - Transformar a `UPDATE table SET {prefijo}_borrado = 1 WHERE ...`.
    - *Prioridad*: `trd_desve_destinos`, `trd_oirs_asignaciones`, `trd_general_comentario`.
2.  **Filtrado de Registros Activos**:
    - Auditar todas las consultas `SELECT` en `src/Models`.
    - Asegurar que la cláusula `WHERE` incluya siempre `{prefijo}_borrado = 0`.
    - Validar que los `JOINs` no incluyan accidentalmente registros eliminados de tablas relacionadas.

---

## Fase 4: Optimización Semántica y Verificación (Cierre)
**Objetivo**: Implementar el uso de los nuevos campos semánticos y realizar una prueba de regresión completa.

1.  **Unidad Semántica de Dirección (Regla 7)**:
    - Actualizar `ContribuyenteDireccion.php` y formularios de ingreso.
    - Implementar lógica para poblar y consultar `{prefijo}_direccion_completa`.
2.  **Normalización de RUTs en Código**:
    - Revisar validadores de frontend y backend para asegurar que el RUT se procese sin puntos antes de consultas `SELECT` o `INSERT`.
3.  **Pruebas de Regresión**:
    - Verificación cruzada: CRUD completo en todos los módulos.
    - Inspección de `error_log` de PHP para asegurar que no hay refererencias huérfanas a nombres antiguos.
    - Entrega de informe final de auditoría.

---

> [!IMPORTANT]
> Se recomienda **no proceder** a la Fase 3 hasta que la Fase 1 esté 100% verificada, ya que cualquier error en la autenticación bloqueará las pruebas de los módulos de negocio.
