<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Municipio de Cuidados - Gestión OIRS</title>
    <!-- Framework Kit Digital (Gob.cl) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap" rel="stylesheet">
    <link href="/municipal/css/gob.cl.css" rel="stylesheet">

    <!-- Bootstrap 4 / Kit Digital Base (Gob.cl) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #dbe0e6;
            border-radius: 10px;
        }

        /* Navegación Estándar Bootstrap 4 */
        .sidebar-portal .nav-pills .nav-link {
            border-radius: 0;
            padding: 0.75rem 1.5rem;
            color: #444;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-left: 4px solid transparent;
            transition: all 0.2s;
            font-size: 14px;
        }

        .sidebar-portal .nav-pills .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--gob-primary);
        }

        .sidebar-portal .nav-pills .nav-link.active {
            background-color: rgba(0, 111, 179, 0.08) !important;
            color: var(--gob-primary) !important;
            font-weight: 700;
            border-left: 4px solid var(--gob-primary);
        }

        .sidebar-portal .nav-pills .nav-link .material-symbols-outlined {
            font-size: 24px;
        }

        /* Sistema de Layout Robusto */
        .wrapper-portal {
            display: flex;
            height: 100vh;
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
            background-color: #F8F9FA;
            display: flex;
            flex-direction: column;
            padding: 0 !important;
        }

        @media (max-width: 991.98px) {
            .sidebar-portal {
                position: fixed;
                left: -260px;
            }

            .sidebar-portal.show {
                left: 0;
            }
        }

        .bg-primary {
            background-color: var(--gob-primary) !important;
        }

        .font-serif {
            font-family: 'Roboto Slab', serif !important;
        }
    </style>
</head>

<body>

    <main class="main-portal">