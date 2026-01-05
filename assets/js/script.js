document.addEventListener('DOMContentLoaded', function() {
    // 1. Validasi Form Tambah Barang
    const formBarang = document.querySelector('form');
    if (formBarang) {
        formBarang.addEventListener('submit', function(e) {
            const hargaJual = document.getElementsByName('harga_jual')[0].value;
            const hargaBeli = document.getElementsByName('harga_beli')[0].value;

            if (parseInt(hargaJual) < parseInt(hargaBeli)) {
                alert('Peringatan: Harga jual tidak boleh lebih kecil dari harga beli!');
                e.preventDefault(); // Batalkan submit
            }
        });
    }

    // 2. Efek Otomatis Hilangkan Alert setelah 3 detik
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000);
    });
});