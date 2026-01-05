
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
    <script src="assets/js/script.js" defer></script>
</head>
<body>
<div class="main-wrapper"> 
    
    <nav>
        <div class="nav-content">
            <a href="index.php?page=dashboard">Home</a>
            <a href="index.php?page=user/list">Daftar Barang</a>
            <a href="index.php?page=user/add">Tambah Barang</a>
            <a href="index.php?page=about">Tentang Kami</a>
            <?php if(isset($_SESSION['isLogin'])): ?>
                <a href="index.php?page=auth/logout" style="color: #e74c3c;">Logout (<?php echo $_SESSION['username']; ?>)</a>
            <?php else: ?>
                <a href="index.php?page=auth/login">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <div class="main">