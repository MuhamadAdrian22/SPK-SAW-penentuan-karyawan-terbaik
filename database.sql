CREATE TABLE kriteria (
    id_kriteria INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_kriteria VARCHAR(100) NOT NULL,
    bobot FLOAT NOT NULL,
    tipe ENUM('benefit', 'cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Buat Tabel Alternatif (Data Karyawan)
CREATE TABLE alternatif (
    id_alternatif INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Buat Tabel Penilaian (Data Nilai Mentah)
CREATE TABLE penilaian (
    id_penilaian INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_alternatif INT(11) NOT NULL,
    id_kriteria INT(11) NOT NULL,
    nilai FLOAT NOT NULL,
    FOREIGN KEY (id_alternatif) REFERENCES alternatif(id_alternatif) ON DELETE CASCADE,
    FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Masukkan 5 Data Kriteria Standar (Total Bobot = 1.0)
INSERT INTO kriteria (id_kriteria, nama_kriteria, bobot, tipe) VALUES
(1, 'Kedisiplinan', 0.25, 'benefit'),
(2, 'Kualitas Kerja', 0.30, 'benefit'),
(3, 'Loyalitas', 0.15, 'benefit'),
(4, 'Kerjasama Tim', 0.15, 'benefit'),
(5, 'Pelanggaran', 0.15, 'cost');