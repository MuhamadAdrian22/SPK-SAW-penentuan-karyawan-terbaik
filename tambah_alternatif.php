<?php
include 'koneksi.php';

$nama = $_POST['nama'] ?? '';

if (!empty($nama)) {
    // Menyimpan nama karyawan ke tabel alternatif
    $q = "INSERT INTO alternatif (nama) VALUES ('$nama')";
    if(mysqli_query($conn, $q)){
        header("Location: alternatif.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Nama tidak boleh kosong!'); window.history.back();</script>";
}
?>