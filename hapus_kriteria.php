<?php
include 'koneksi.php';

$id = $_GET['id'];

// 1. Hapus dulu semua nilai yang berhubungan dengan kriteria ini
mysqli_query($conn, "DELETE FROM penilaian WHERE id_kriteria='$id'");

// 2. Baru hapus kriterianya
mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id'");

header("Location:kriteria.php");
?>