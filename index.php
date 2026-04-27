<!DOCTYPE html>
<html>
<head>
<title>SPK SAW</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: url('image1.jpg.jpg') center/cover no-repeat;
    font-family: 'Segoe UI', sans-serif;
}

/* HERO BACKGROUND */
.hero {
    background: url('image1.jpg.jpg') center/cover no-repeat;
    height: 400px;
    border-radius: 20px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    overflow: hidden;
}

/* Overlay */
.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.55);
}

/* Content */
.hero-content {
    position: relative;
    z-index: 2;
    animation: fadeUp 1s ease;
}

/* Animasi */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Tombol */
.btn-custom {
    border-radius: 25px;
    padding: 10px 20px;
    transition: 0.3s;
}

.btn-custom:hover {
    transform: scale(1.05);
}

/* Card bawah */
.info-card {
    border-radius: 15px;
    transition: 0.3s;
}

.info-card:hover {
    transform: translateY(-5px);
}
</style>

</head>

<body>

<div class="container mt-5">
    <!-- HERO -->
    <div class="hero shadow-lg mb-4">

        <div class="hero-content">
            <h3 class="fw-bold">Penentuan Karyawan Terbaik</h3>
            <p>Menggunakan metode SAW secara cepat & akurat</p>

            <div class="mt-3">
                <a href="kriteria.php" class="btn btn-primary btn-custom m-1">Bobot Penilaiaan</a>
                <a href="alternatif.php" class="btn btn-success btn-custom m-1">Daftar Nama</a>
                <a href="penilaian.php" class="btn btn-warning btn-custom m-1">Penilaian</a>
                <a href="hasil.php" class="btn btn-danger btn-custom m-1">Hasil</a>
            </div>
        </div>

    </div>

    <!-- DASHBOARD MINI -->
    <div class="row text-center">

        <div class="col-md-4">
            <div class="card info-card shadow p-3">
                <h5>🆔 NIM</h5>
                <p>231011400365</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card info-card shadow p-3">
                <h5>👤 Nama</h5>
                <p>Muhamad Adrian</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card info-card shadow p-3">
                <h5>🏫 Kelas</h5>
                <p>06TPLE007</p>
            </div>
        </div>

    </div>

</div>

</body>
</html>