<?php 
include 'koneksi.php'; 
include 'header.php'; 
?>

<style>
    body { background-color: #f8f9fa; }
    
    .canvas-container {
        max-width: 850px; /* Lebar ditambah sedikit untuk 2 kolom */
        margin: 30px auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .header-section {
        text-align: center;
        margin-bottom: 25px;
    }

    /* Grid System untuk membagi kriteria jadi 2 kolom */
    .kriteria-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Membagi dua kolom sama besar */
        gap: 20px 40px; /* Jarak antar kolom dan baris */
    }

    .kriteria-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .kriteria-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: #444;
        margin-bottom: 8px;
        display: block;
        text-transform: uppercase;
    }

    /* Tombol angka lebih kecil agar hemat tempat */
    .btn-number-group {
        display: flex;
        justify-content: space-between;
        gap: 4px;
    }

    .btn-num {
        flex: 1;
        padding: 5px 0;
        font-size: 0.8rem;
        border: 1px solid #dee2e6;
        color: #666;
        border-radius: 6px !important;
        transition: 0.2s;
    }

    .btn-check:checked + .btn-num {
        background-color: #4e73df;
        border-color: #4e73df;
        color: #fff;
    }

    .footer-action {
        margin-top: 30px;
        text-align: center;
    }

    .btn-save-custom {
        width: 250px;
        padding: 10px;
        border-radius: 30px;
        font-weight: 600;
        background: #4e73df;
        border: none;
    }

    /* Responsif: Jika layar HP, balik jadi 1 kolom */
    @media (max-width: 768px) {
        .kriteria-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="container">
    <div class="canvas-container">
        <div class="header-section">
            <h4>Penilaian Performa</h4>
        </div>
        
        <form action="simpan_penilaian.php" method="POST">
            
            <div class="d-flex justify-content-center mb-4">
                <select name="id_alternatif" class="form-select w-50 text-center" style="border-radius: 10px;" required>
                    <option value="">-- Pilih Karyawan --</option>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM alternatif");
                    while($row = mysqli_fetch_array($res)){
                        echo "<option value='$row[id_alternatif]'>$row[nama]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="kriteria-grid">
                <?php
                $query_k = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                while($k = mysqli_fetch_array($query_k)){
                ?>
                    <div class="kriteria-item">
                        <span class="kriteria-name"><?php echo $k['nama_kriteria']; ?></span>
                        <div class="btn-number-group">
                            <?php for($i=1; $i<=10; $i++): ?>
                                <input type="radio" class="btn-check" name="nilai[<?php echo $k['id_kriteria']; ?>]" 
                                       id="btn-<?php echo $k['id_kriteria'].'-'.$i; ?>" value="<?php echo $i; ?>" required>
                                <label class="btn btn-num btn-outline-light" for="btn-<?php echo $k['id_kriteria'].'-'.$i; ?>">
                                    <?php echo $i; ?>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="footer-action">
                <button type="submit" class="btn btn-primary btn-save-custom shadow">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>