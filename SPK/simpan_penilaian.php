<?php
include 'koneksi.php';

// 1. Tangkap ID Karyawan dan Array Nilai
$id_alternatif = $_POST['id_alternatif'] ?? '';
$nilai_array   = $_POST['nilai'] ?? []; // Ini berisi [id_kriteria => nilai]

// 2. Validasi awal: Pastikan karyawan sudah dipilih
if (!empty($id_alternatif) && !empty($nilai_array)) {
    
    // 3. Looping untuk menyimpan nilai setiap kriteria
    foreach ($nilai_array as $id_kriteria => $nilai) {
        
        // Pastikan nilai adalah angka (mencegah SQL Injection sederhana)
        $nilai = mysqli_real_escape_string($conn, $nilai);
        
        // 4. Cek apakah karyawan ini sudah punya nilai untuk kriteria tersebut
        $cek = mysqli_query($conn, "SELECT * FROM penilaian 
                                   WHERE id_alternatif = '$id_alternatif' 
                                   AND id_kriteria = '$id_kriteria'");

        if (mysqli_num_rows($cek) > 0) {
            // Jika sudah ada, lakukan UPDATE (timpa nilai lama)
            $query = "UPDATE penilaian SET nilai = '$nilai' 
                      WHERE id_alternatif = '$id_alternatif' 
                      AND id_kriteria = '$id_kriteria'";
        } else {
            // Jika belum ada, lakukan INSERT (masukkan data baru)
            $query = "INSERT INTO penilaian (id_alternatif, id_kriteria, nilai) 
                      VALUES ('$id_alternatif', '$id_kriteria', '$nilai')";
        }

        // Jalankan query
        mysqli_query($conn, $query);
    }

    // 5. Setelah selesai, kembali ke halaman penilaian dengan status sukses
    header("Location: penilaian.php?status=sukses");
} else {
    // Jika data tidak lengkap, beri peringatan
    echo "<script>
            alert('Gagal menyimpan! Pastikan semua nilai sudah diisi.');
            window.location.href='penilaian.php';
          </script>";
}
?>