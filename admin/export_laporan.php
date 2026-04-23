<?php
include('../config/db.php');

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_peminjaman.xls");
?>

<table border="1">
<tr>
    <th style="width:200px;">User</th>
    <th style="width:250px;">Judul Buku</th>
    <th style="width:120px;">Status</th>
    <th style="width:150px;">Tanggal Pinjam</th>
    <th style="width:150px;">Tanggal Kembali</th>
</tr>

<?php
$data = $conn->query("
SELECT peminjaman.*, buku.judul 
FROM peminjaman 
JOIN buku ON peminjaman.buku_id = buku.id
");

while($d = $data->fetch_assoc()){
?>

<tr>
    <td><?= $d['user']; ?></td>
    <td><?= $d['judul']; ?></td>
    <td><?= $d['status']; ?></td>
    
    <td>
        <?= date('d/m/Y', strtotime($d['tanggal_pinjam'])); ?>
    </td>
    
    <td>
        <?= $d['tanggal_kembali'] 
            ? date('d/m/Y', strtotime($d['tanggal_kembali'])) 
            : '-'; ?>
    </td>
</tr>

<?php } ?>
</table>