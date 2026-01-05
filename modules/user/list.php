<?php
if (!isset($_SESSION['isLogin'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='index.php?page=auth/login';</script>";
    exit;
}
$sql = 'SELECT * FROM data_barang ORDER BY id_barang DESC';
$result = mysqli_query($conn, $sql);
?>

<div class="list-container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Daftar Persediaan Barang</h2>
        <div class="toolbar">
            <a class="btn" href="index.php?page=barang/add" style="background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">+ Tambah Barang Baru</a>
        </div>
    </div>

    <div class="main">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th style="text-align: right;">Harga Beli</th>
                    <th style="text-align: right;">Harga Jual</th>
                    <th style="text-align: center;">Stok</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result && mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?php if(!empty($row['gambar']) && file_exists($row['gambar'])): ?>
                                    <img class="thumb" src="<?= htmlspecialchars($row['gambar']); ?>" alt="Foto">
                                <?php else: ?>
                                    <div style="width:60px; height:60px; background:#eee; display:flex; align-items:center; justify-content:center; color:#999; font-size:10px;">No Image</div>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: bold;"><?= htmlspecialchars($row['nama']); ?></td>
                            <td><span style="background: #e1e8ed; padding: 3px 8px; border-radius: 12px; font-size: 12px;"><?= htmlspecialchars($row['kategori']); ?></span></td>
                            <td style="text-align: right;">Rp <?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                            <td style="text-align: right; color: #27ae60; font-weight: bold;">Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                            <td style="text-align: center;"><?= $row['stok']; ?></td>
                            <td style="text-align: center;">
                                <a class="link edit" href="index.php?page=barang/ubah&id=<?= $row['id_barang']; ?>">Ubah</a>
                                <a class="link del" href="index.php?page=barang/delete&id=<?= $row['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #999;">Belum ada data barang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>