<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Vecinos - Municipio de Viña del Mar</title>
    <!-- Framework Kit Digital (Gob.cl) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap" rel="stylesheet">
    <link href="https://framework.digital.gob.cl/css/gob.cl.css" rel="stylesheet">
    
    <!-- Bootstrap 4 / Kit Digital Base (Gob.cl) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- jQuery y Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <style>
        :root {
            --gob-primary: #006FB3;
            --gob-success: #2D717C;
            --gob-warning: #FFA11B;
            --gob-danger: #FE6565;
            --gob-bg: #EEEEEE;
        }
        
        body { 
            font-family: 'Roboto', sans-serif; 
            background-color: var(--gob-bg); 
            color: #333;
            overflow-x: hidden;
        }

        .font-serif { font-family: 'Roboto Slab', serif !important; }
        
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CCC; border-radius: 10px; }
        
        .active-nav {
            background-color: rgba(0, 111, 179, 0.1) !important;
            color: var(--gob-primary) !important;
            font-weight: 700 !important;
            border-right: 4px solid var(--gob-primary) !important;
        }

        /* Sistema de Layout Robusto */
        .wrapper-portal {
            display: flex;
            height: calc(100vh - 50px);
            overflow: hidden;
            width: 100%;
        }

        .sidebar-portal {
            width: 280px;
            flex-shrink: 0;
            background: white;
            border-right: 1px solid #dee2e6;
            height: 100%;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .main-portal {
            flex-grow: 1;
            min-width: 0;
            height: 100%;
            overflow-y: auto;
            background-color: #F4F6F9;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 991.98px) {
            .sidebar-portal {
                position: fixed;
                left: -280px;
            }
            .sidebar-portal.show {
                left: 0;
            }
        }

        /* Utilidades de reemplazo de Tailwind simple */
        .bg-primary { background-color: var(--gob-primary) !important; }
        .text-primary { color: var(--gob-primary) !important; }
        .border-primary { border-color: var(--gob-primary) !important; }
    </style>
</head>
<body>
