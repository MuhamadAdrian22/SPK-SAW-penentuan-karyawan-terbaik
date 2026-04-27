<?php include 'koneksi.php'; ?>
<?php include 'header.php'; ?>

<div class="card p-3 mb-3">
<form method="POST" action="tambah_alternatif.php">
<div class="row">
<input name="nama" class="form-control col" placeholder="Nama">
<button class="btn btn-success col">Tambah</button>
</div>
</form>
</div>

<table class="table table-bordered">
<tr><th>No</th><th>Nama</th><th>Aksi</th></tr>

<?php
$no=1;
$data=mysqli_query($conn,"SELECT * FROM alternatif");
while($d=mysqli_fetch_array($data)){
echo "<tr>
<td>$no</td>
<td>$d[nama]</td>
<td><a href='hapus_alternatif.php?id=$d[id_alternatif]' class='btn btn-danger btn-sm'>Hapus</a></td>
</tr>";
$no++;
}
?>
</table>

<?php include 'footer.php'; ?>