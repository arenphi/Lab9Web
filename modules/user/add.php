<?php
/**
 * Modul Tambah Barang - Praktikum 9
 */

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga_jual = (int)$_POST['harga_jual'];
    $harga_beli = (int)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    
    // Proses upload gambar sederhana
    $gambar = null;
    if ($_FILES['file_gambar']['error'] == 0) {
        $filename = time() . '_' . $_FILES['file_gambar']['name'];
        $destination = "gambar/" . $filename;
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination)) {
            $gambar = $destination;
        }
    }

    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) 
            VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location='index.php?page=barang/list';</script>";
    }
}
?>

<div class="content"> 
    <h2>Tambah Barang Baru</h2> 
    
    <form method="post" action="index.php?page=barang/add" enctype="multipart/form-data"> 
        <div class="form-grid">
            
            <div class="input-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" placeholder="Contoh: Laptop Asus" required />
            </div> 

            <div class="input-group">
                <label>Kategori</label>
                <select name="kategori">
                    <option value="Komputer">Komputer</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Hand Phone">Hand Phone</option>
                </select>
            </div> 

            <div class="input-group">
                <label>Stok Barang</label>
                <input type="number" name="stok" required />
            </div> 

            <div class="input-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" required />
            </div> 

            <div class="input-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" required />
            </div> 

            <div class="input-group">
                <label>File Gambar</label>
                <input type="file" name="file_gambar" accept="image/*" />
            </div>

            <div class="form-actions">
                <input type="submit" name="submit" value="Simpan Data" class="btn" style="padding: 10px 40px; cursor: pointer;">
                <a href="index.php?page=barang/list" class="btn del" style="padding: 10px 40px; text-decoration: none; margin-left: 10px;">Batal</a>
            </div>

        </div>
    </form>
</div>