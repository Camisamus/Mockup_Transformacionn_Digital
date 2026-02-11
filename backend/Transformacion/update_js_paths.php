<?php
$dir = __DIR__ . '/funcionarios';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

// Base replacements for common files that might have been moved
$replacements = [
    'recursos/js/desve_' => 'recursos/js/funcionarios/desve/desve_',
    'recursos/js/ingr_' => 'recursos/js/funcionarios/ingresos/ingr_',
    'recursos/js/oirs_' => 'recursos/js/funcionarios/oirs/oirs_',
    'recursos/js/sisadmin_' => 'recursos/js/funcionarios/sisadmin/sisadmin_',
    'recursos/js/logs_' => 'recursos/js/funcionarios/sisadmin/logs_',
    'recursos/js/atenciones_' => 'recursos/js/funcionarios/NO_Asignadas/atenciones_',
    'recursos/js/organizaciones_' => 'recursos/js/funcionarios/NO_Asignadas/organizaciones_',
    'recursos/js/patentes_' => 'recursos/js/funcionarios/NO_Asignadas/patentes_',
    'recursos/js/postulaciones_' => 'recursos/js/funcionarios/NO_Asignadas/postulaciones_',
    'recursos/js/subvenciones_' => 'recursos/js/funcionarios/NO_Asignadas/subvenciones_',
    'recursos/js/bandeja.js' => 'recursos/js/funcionarios/NO_Asignadas/bandeja.js',
    'recursos/js/contribuyente_empresas.js' => 'recursos/js/funcionarios/NO_Asignadas/contribuyente_empresas.js',
    'recursos/js/historial_pagos.js' => 'recursos/js/funcionarios/NO_Asignadas/historial_pagos.js',
    'recursos/js/sidebar.js' => 'recursos/js/funcionarios/NO_Asignadas/sidebar.js',
];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $filePath = $file->getRealPath();
        $content = file_get_contents($filePath);
        $originalContent = $content;

        // 1. Fix the Funcionarios/ vs funcionarios/ casing if any (from previous runs)
        $content = str_replace('recursos/js/Funcionarios/', 'recursos/js/funcionarios/', $content);

        // 2. Map systems to subdirectories
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        // 3. Fix relative path depth if it's 3 levels instead of 2 for files in subfolders
        // Files in funcionarios/desve/ etc. should use ../../
        if (strpos($filePath, '\\funcionarios\\') !== false) {
            $parts = explode('\\funcionarios\\', $filePath);
            $after = $parts[1];
            if (strpos($after, '\\') !== false) {
                // It's in a subfolder (e.g. desve/foo.php)
                $content = str_replace('../../../recursos/js/', '../../recursos/js/', $content);
            } else {
                // It's directly in funcionarios/ (e.g. bandeja.php)
                $content = str_replace('../../../recursos/js/', '../recursos/js/', $content);
                $content = str_replace('../../recursos/js/', '../recursos/js/', $content);
            }
        }

        if ($content !== $originalContent) {
            file_put_contents($filePath, $content);
            echo "Updated: $filePath\n";
        }
    }
}
?>
