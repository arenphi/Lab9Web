<?php
session_start(); // Wajib ada untuk login
error_reporting(E_ALL);
require_once('config/database.php');
// ... sisanya sama

// 2. Routing: Ambil parameter page. Default ke 'dashboard'.
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$page = preg_replace('/[^a-zA-Z0-9_\/]/', '', $page);

// 3. Tentukan path file konten
if ($page === 'dashboard') {
    $filepath = 'dashboard.php';
} else {
    // Muat modul dari folder modules/
    $filepath = 'modules/' . $page . '.php';
}
if ($page === 'dashboard') {
    $filepath = 'dashboard.php';
} elseif ($page === 'about') {
    // Tambahkan kondisi ini jika about.php ada di root folder
    $filepath = 'about.php';
} else {
    // Mencari di folder modules untuk halaman seperti barang/list
    $filepath = 'modules/' . $page . '.php';
}


// 4. Muat HEADER (Template Tampilan Atas)
require_once('views/header.php');

// 5. Muat KONTEN (Logika Modul)
echo "<div class='content'>";
if (file_exists($filepath)) {
    require_once($filepath);
} else {
    // Halaman 404
    echo "<h2>404 Not Found</h2><p>Halaman atau Modul tidak ditemukan: {$filepath}</p>";
}
echo "</div>";

// 6. Muat FOOTER (Template Tampilan Bawah)
require_once('views/footer.php');
?>

<head>
    <meta charset="UTF-8">
    <title>Aplikasi CRUD Modular</title>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
</head>