<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID Transaksi tidak ditemukan.");
}
$id_transaksi = (int)$_GET['id'];

// Ambil info transaksi
$queryTrx = mysqli_query($koneksi, "
    SELECT t.*, u.nama, u.username
    FROM tb_transaksi t 
    LEFT JOIN tb_user u ON t.id_pelanggan = u.id 
    WHERE t.id_transaksi = '$id_transaksi'
");

if (mysqli_num_rows($queryTrx) == 0) {
    die("Transaksi tidak ditemukan.");
}
$trx = mysqli_fetch_assoc($queryTrx);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Nota Transaksi #<?= $id_transaksi ?></title>
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .nota-container {
        background: #fff;
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        border: 1px dashed #ccc;
    }
    .header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 10px; margin-bottom: 20px; }
    .btn-print { margin: 30px auto; display: block; width: 120px; }
    @media print {
        body { background: #fff; padding: 0; }
        .nota-container { border: none; padding: 0; margin: 0; }
        .btn-print, .btn-back { display: none !important; }
    }
  </style>
</head>
<body>

<div class="nota-container">
    <div class="header">
        <h2>IBOX ONLINE SHOPPING</h2>
        <p class="mb-0">Nota Pembelian</p>
    </div>

    <table class="table table-borderless table-sm mb-4">
        <tr>
            <td width="30%"><strong>No. Nota</strong></td>
            <td>: TRX-<?= str_pad($id_transaksi, 5, "0", STR_PAD_LEFT) ?></td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>: <?= date('d M Y', strtotime($trx['tanggal'])) ?></td>
        </tr>
        <tr>
            <td><strong>Pelanggan</strong></td>
            <td>: <?= htmlspecialchars($trx['nama'] ?? $trx['username'] ?? 'User Dihapus') ?></td>
        </tr>
    </table>

    <table class="table table-bordered mb-4">
        <thead class="table-light">
            <tr>
                <th>Produk</th>
                <th class="text-end">Jumlah</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $queryDetail = mysqli_query($koneksi, "
                SELECT d.*, p.nama, p.harga 
                FROM tb_detail d 
                JOIN tb_produk p ON d.id_produk = p.id 
                WHERE d.id_transaksi = '$id_transaksi'
            ");
            while ($dt = mysqli_fetch_assoc($queryDetail)):
                $subtotal = $dt['jumlah'] * $dt['harga'];
            ?>
            <tr>
                <td><?= htmlspecialchars($dt['nama']) ?><br><small class="text-muted">@ Rp <?= number_format($dt['harga'], 0, ',', '.') ?></small></td>
                <td class="text-end"><?= $dt['jumlah'] ?></td>
                <td class="text-end">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="2" class="text-end fw-bold">TOTAL</td>
                <td class="text-end fw-bold">Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <p class="mb-1">Terima kasih atas pembelian Anda!</p>
    </div>
</div>

<div class="text-center">
    <button class="btn btn-dark btn-print" onclick="window.print()">Cetak Nota</button>
    <a href="index2.php" class="btn btn-outline-secondary btn-back mt-2">Kembali ke Beranda</a>
</div>

</body>
</html>
