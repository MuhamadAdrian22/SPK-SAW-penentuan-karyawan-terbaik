<?php 
include 'koneksi.php'; 
include 'header.php'; 
?>

<div class="container mt-4">
    <h4 class="text-center mb-4">Kriteria Pemilihan Karyawan Terbaik</h4>
    <div class="alert alert-success">
        Sistem menggunakan 5 kriteria tetap dengan total bobot 1.0 (100%) untuk normalisasi SAW.
    </div>
    
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kedisiplinan</td>
                        <td>0.25</td>
                        <td><span class="badge bg-success">BENEFIT</span></td>
                        <td>Absensi & Ketepatan Waktu</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kualitas Kerja</td>
                        <td>0.30</td>
                        <td><span class="badge bg-success">BENEFIT</span></td>
                        <td>Hasil & Akurasi Kerja</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Loyalitas</td>
                        <td>0.15</td>
                        <td><span class="badge bg-success">BENEFIT</span></td>
                        <td>Lama Kerja & Komitmen</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kerjasama Tim</td>
                        <td>0.15</td>
                        <td><span class="badge bg-success">BENEFIT</span></td>
                        <td>Komunikasi & Sikap</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Pelanggaran</td>
                        <td>0.15</td>
                        <td><span class="badge bg-danger">COST</span></td>
                        <td>Jumlah Teguran/SP</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>

<?php include 'footer.php'; ?>