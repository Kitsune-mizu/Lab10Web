<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Barang</title>
    <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-boxes"></i>
                    <h1>Inventory System</h1>
                </div>
                <nav class="main-nav">
                    <a href="<?php echo BASE_URL; ?>/dashboard" class="nav-link <?php echo $module === 'dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/barang/list" class="nav-link <?php echo $module === 'barang' ? 'active' : ''; ?>">
                        <i class="fas fa-list"></i>
                        <span>Data Barang</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/barang/add" class="nav-link">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Barang</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/auth/logout" class="nav-link logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
        </header>

        <main class="main-content">
            <div class="content-wrapper">