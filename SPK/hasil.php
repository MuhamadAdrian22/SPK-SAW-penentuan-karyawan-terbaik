<?php 
include 'koneksi.php'; 
include 'header.php'; 
?>

<style>
    body { background-color: #f8f9fa; }
    .result-container {
        max-width: 900px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .nav-pills .nav-link.active {
        background-color: #4e73df;
    }
    .table-custom {
        font-size: 0.9rem;
        border-radius: 10px;
        overflow: hidden;
    }
    .badge-rank {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: bold;
    }
    .rank-1 { background: #ffd700; color: #000; } /* Gold */
    .rank-2 { background: #c0c0c0; color: #000; } /* Silver */
    .rank-3 { background: #cd7f32; color: #fff; } /* Bronze */
</style>

<div class="container">
    <div class="result-container">
        <h4 class="text-center mb-4">Hasil Perhitungan SAW</h4>

        <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="tab-ranking" data-bs-toggle="pill" data-bs-target="#pills-ranking" type="button">Peringkat Akhir</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-matriks" data-bs-toggle="pill" data-bs-target="#pills-matriks" type="button">Matriks Normalisasi</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <?php
            // --- LOGIKA PERHITUNGAN (Tetap Sama Agar Akurat) ---
            $max = []; $min = []; $kriteria = []; $matriks_r = [];
            $q_k = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
            while($k = mysqli_fetch_array($q_k)){
                $idK = $k['id_kriteria'];
                $kriteria[$idK] = $k;
                $row_max = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(nilai) as m FROM penilaian WHERE id_kriteria='$idK'"));
                $row_min = mysqli_fetch_array(mysqli_query($conn, "SELECT MIN(nilai) as n FROM penilaian WHERE id_kriteria='$idK' AND nilai > 0"));
                $max[$idK] = $row_max['m'] ?: 1;
                $min[$idK] = $row_min['n'] ?: 1;
            }

            $alt_list = mysqli_query($conn, "SELECT * FROM alternatif");
            while($a = mysqli_fetch_array($alt_list)){
                $idA = $a['id_alternatif'];
                foreach($kriteria as $idK => $k){
                    $dt_n = mysqli_fetch_array(mysqli_query($conn, "SELECT nilai FROM penilaian WHERE id_alternatif='$idA' AND id_kriteria='$idK'"));
                    $nilai = $dt_n['nilai'] ?? 0;
                    if($k['tipe'] == 'benefit') { $r = $nilai / $max[$idK]; }
                    else { $r = ($nilai > 0) ? ($min[$idK] / $nilai) : 0; }
                    $matriks_r[$idA][$idK] = $r;
                }
            }
            ?>

            <div class="tab-pane fade show active" id="pills-ranking" role="tabpanel">
                <table class="table table-hover table-custom border">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Rank</th>
                            <th>Nama Karyawan</th>
                            <th class="text-center">Skor Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rank_data = [];
                        foreach($matriks_r as $idA => $n_r){
                            $v = 0;
                            foreach($n_r as $idK => $r) { $v += ($r * $kriteria[$idK]['bobot']); }
                            $nm = mysqli_fetch_array(mysqli_query($conn, "SELECT nama FROM alternatif WHERE id_alternatif='$idA'"));
                            $rank_data[] = ['nama' => $nm['nama'], 'skor' => $v];
                        }
                        usort($rank_data, function($a, $b) { return $b['skor'] <=> $a['skor']; });

                        $no = 1;
                        foreach($rank_data as $rd){
                            $cls = ($no <= 3) ? "rank-$no" : "bg-light text-dark";
                            echo "<tr>
                                <td><span class='badge-rank $cls'>$no</span></td>
                                <td><b>{$rd['nama']}</b></td>
                                <td class='text-center text-primary'><b>".round($rd['skor'], 4)."</b></td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="pills-matriks" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered text-center table-custom">
                        <tr class="table-light">
                            <th>Alternatif</th>
                            <?php foreach($kriteria as $k) echo "<th>C{$k['id_kriteria']}</th>"; ?>
                        </tr>
                        <?php
                        mysqli_data_seek($alt_list, 0);
                        while($a = mysqli_fetch_array($alt_list)){
                            echo "<tr><td class='text-start'>{$a['nama']}</td>";
                            foreach($kriteria as $idK => $k){
                                echo "<td>".round($matriks_r[$a['id_alternatif']][$idK], 2)."</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>