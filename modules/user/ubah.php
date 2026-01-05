<?php
// Fungsi pembantu is_select disertakan kembali di sini
function is_select($var, $val) { return ($var == $val) ? 'selected="selected"' : ''; }

$id = 0;
if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
} else {
    header('Location: index.php?page=barang/list');
    exit;
}

$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='content'>Data barang dengan ID {$id} tidak ditemukan.</div>";
    exit;
}
$data = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {
    // ... (Logika pemrosesan form sama seperti ubah.php lama, termasuk upload gambar dan penghapusan file lama) ...
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga_jual = (int)$_POST['harga_jual'];
    $harga_beli = (int)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar_lama = mysqli_real_escape_string($conn, $_POST['gambar_lama']);
    $gambar = $gambar_lama; 

    // Proses upload gambar baru
    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {
        // ... (Logika upload gambar di sini, dengan penyesuaian path seperti di add.php) ...
        $file_gambar = $_FILES['file_gambar'];
        $filename = time() . '_' . preg_replace('/\s+/', '_', basename($file_gambar['name']));
        $destination_dir = dirname(dirname(dirname(__FILE__))) . '/gambar/';
        if (!is_dir($destination_dir)) { mkdir($destination_dir, 0755, true); }
        $destination = $destination_dir . $filename;
        
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
            if (!empty($gambar_lama) && file_exists($gambar_lama)) { unlink($gambar_lama); }
        }
    }

    $sql_update = "UPDATE data_barang SET nama = '{$nama}', kategori = '{$kategori}', harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}', gambar = '{$gambar}' WHERE id_barang = '{$id}'";
    
    $update_success = mysqli_query($conn, $sql_update);
    header('Location: index.php?page=barang/list&status=updated');
    exit;
}
?>
<div class="content">
    <h2>Ubah Barang - <?php echo htmlspecialchars($data['nama']); ?></h2>
    <div class="main">
        <form method="post" action="index.php?page=barang/ubah&id=<?php echo $id; ?>" enctype="multipart/form-data">
            
            <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($data['gambar']); ?>">

            <div class="input"><label>Nama Barang</label><input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required /></div>
            <div class="input"><label>Kategori</label><select name="kategori"><option value="Komputer" <?php echo is_select($data['kategori'], 'Komputer'); ?>>Komputer</option><option value="Elektronik" <?php echo is_select($data['kategori'], 'Elektronik'); ?>>Elektronik</option><option value="Hand Phone" <?php echo is_select($data['kategori'], 'Hand Phone'); ?>>Hand Phone</option></select></div>
            <div class="input"><label>Harga Jual</label><input type="number" name="harga_jual" value="<?php echo htmlspecialchars($data['harga_jual']); ?>" required /></div>
            <div class="input"><label>Harga Beli</label><input type="number" name="harga_beli" value="<?php echo htmlspecialchars($data['harga_beli']); ?>" required /></div>
            <div class="input"><label>Stok</label><input type="number" name="stok" value="<?php echo htmlspecialchars($data['stok']); ?>" required /></div>
            <div class="input"><label>Gambar Saat Ini</label><?php if (!empty($data['gambar'])): ?><img src="<?php echo htmlspecialchars($data['gambar']); ?>" alt="Gambar Barang" style="max-width: 200px; display: block; margin-bottom: 10px;"><?php else: ?><p>Tidak ada gambar</p><?php endif; ?><label>File Gambar (Kosongkan jika tidak ingin mengubah)</label><input type="file" name="file_gambar" accept="image/*" /></div>
            
            <div class="submit">
                <input type="submit" name="submit" value="Simpan Perubahan" />
                <a class="btn" href="index.php?page=barang/list">Batal</a>
            </div>
        </form>
    </div>
</div>