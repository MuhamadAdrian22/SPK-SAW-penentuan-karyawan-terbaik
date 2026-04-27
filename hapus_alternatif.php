<?php
include 'koneksi.php';

$id = $_GET['id'];

// Hapus semua nilai yang berhubungan dengan alternatif ini di tabel penilaian
mysqli_query($conn, "DELETE FROM penilaian WHERE id_alternatif='$id'");

// Baru hapus data alternatifnya
mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif='$id'");

header("Location:alternatif.php");
?>