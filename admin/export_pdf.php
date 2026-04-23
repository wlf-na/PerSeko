<?php
include('../config/db.php');

header("Content-type: application/vnd-ms-word");
header("Content-Disposition: attachment; filename=Laporan.pdf");

$data = $conn->query("
SELECT peminjaman.*, buku.judul 
FROM peminjaman 
JOIN buku ON peminjaman.buku_id = buku.id
");

echo "<table border='1'>
<tr>
<th>User</th>
<th>Judul Buku</th>
<th>Status</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
</tr>";

while($d = $data->fetch_assoc()){
    echo "<tr>
        <td>{$d['user']}</td>
        <td>{$d['judul']}</td>
        <td>{$d['status']}</td>
        <td>{$d['tanggal_pinjam']}</td>
        <td>{$d['tanggal_kembali']}</td>
    </tr>";
}

echo "</table>";
?>