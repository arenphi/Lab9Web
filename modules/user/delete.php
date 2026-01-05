<?php 
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); 
    
    // 1. Ambil path gambar (Tambahan untuk membersihkan server)
    $sql_get_image = "SELECT gambar FROM data_barang WHERE id_barang = '{$id}'";
    $result_image = mysqli_query($conn, $sql_get_image);
    $data_image = mysqli_fetch_assoc($result_image);
    $gambar_path = $data_image['gambar'];

    // 2. Query DELETE
    $sql_delete = "DELETE FROM data_barang WHERE id_barang = '{$id}'"; 
    $delete_success = mysqli_query($conn, $sql_delete); 

    if ($delete_success) {
        // 3. Hapus file gambar dari server
        if (!empty($gambar_path) && file_exists($gambar_path)) {
            unlink($gambar_path);
        }
    }
    // REDIRECT diubah ke routing
    header('Location: index.php?page=barang/list');
    exit;
}

// Redirect default jika tanpa ID
header('Location: index.php?page=barang/list');
exit;
?>