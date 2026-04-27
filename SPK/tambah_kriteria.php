<?php
include 'koneksi.php';

// ✅ Pastikan request dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ✅ Ambil data dengan aman
    $nama  = trim($_POST['nama'] ?? '');
    $bobot = trim($_POST['bobot'] ?? '');
    $tipe  = trim($_POST['tipe'] ?? '');

    // 🧪 Debug (opsional, bisa dihapus nanti)
    // print_r($_POST); exit;

    // ✅ Validasi
    if ($nama == '' || $bobot == '' || $tipe == '') {
        echo "<script>alert('Data dalam form kurang!'); window.location='kriteria.php';</script>";
        exit;
    }

    // ✅ Insert ke database
    $query = mysqli_query($conn, 
        "INSERT INTO kriteria (nama_kriteria, bobot, tipe) 
         VALUES ('$nama','$bobot','$tipe')"
    );

    if ($query) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='kriteria.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    // ❌ Akses langsung tanpa form
    echo "<script>alert('Akses tidak valid!'); window.location='kriteria.php';</script>";
}
?>