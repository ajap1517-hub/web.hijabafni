<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header('location:login.php');
    exit;
}

$id_user = $_SESSION['id_user'];
?>
<!doctype html>
<html lang="id" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi - IBox Online Shopping</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff5fa; color: #5c3b4a; font-family: "Segoe UI", sans-serif; }
        header { background: #ffffff; border-bottom: 2px solid #ffd6e8 !important; border-radius: 0 0 20px 20px; box-shadow: 0 4px 15px rgba(255, 182, 212, 0.15); padding: 15px 0;}
        .container-box { background: white; padding: 35px; border-radius: 25px; box-shadow: 0 8px 30px rgba(255, 158, 194, 0.18); margin-top: 30px; margin-bottom: 40px; }
        .container-box h3 { color: #d94f87; font-weight: 700; margin-bottom: 20px; text-align: center;}
        .table thead { background: #ffd6e7; color: #8d3d61; }
        .table tbody tr { border-bottom: 1px solid #ffe5ef; }
        .table tbody tr:hover { background: #fff6fa; }
        .btn-detail { background: #ff8fb8 !important; border: none !important; color: white !important; border-radius: 20px !important; padding: 6px 15px !important; font-weight: 600; }
        .btn-detail:hover { background: #e95c91 !important; }
        
        .nav-link { color: #b85c82 !important; font-weight: 500; border-radius: 20px; padding: 8px 14px !important; transition: all 0.3s ease; }
        .nav-link:hover { background: #ffe1ed; color: #e83e82 !important; transform: translateY(-2px); }
        .col-md-3.text-end .btn { color: #d94f87; background: #fff0f6; border: 1px solid #ffd0e2; border-radius: 50%; width: 45px; height: 45px; margin-left: 5px; transition: all 0.3s ease; }
        .col-md-3.text-end .btn:hover { background: #ffb6d2; color: white; transform: scale(1.1) rotate(-3deg); box-shadow: 0 5px 15px rgba(255, 105, 160, 0.3); }
    </style>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="index2.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="logo-neper.png" class="bi" width="100" height="35" role="img" aria-label="Logo">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index2.php#produk" class="nav-link px-2 link-dark">iPhone</a></li>
                <li><a href="index2.php#ipad" class="nav-link px-2 link-secondary">iPad</a></li>
                <li><a href="index2.php#watch" class="nav-link px-2 link-secondary">Watch</a></li>
                <li><a href="index2.php#mac" class="nav-link px-2 link-secondary">Mac</a></li>
                <li><a href="index2.php" class="nav-link px-2 link-secondary">Aksesori</a></li>
                <li><a href="transaksi.php" class="nav-link px-2 link-secondary">Riwayat</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <a href="profil.php" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                </a>
                <a href="keranjang.php" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                </a>
            </div>
        </header>
    </div>

    <main class="container">
        <div class="container-box">
            <h3>Riwayat Transaksi</h3>
            
            <?php
            $queryTrx = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id_pelanggan = '$id_user' ORDER BY id_transaksi DESC");
            if (mysqli_num_rows($queryTrx) > 0):
            ?>
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No Nota</th>
                            <th>Tanggal</th>
                            <th>Total Belanja</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($trx = mysqli_fetch_assoc($queryTrx)): ?>
                        <tr>
                            <td class="fw-bold text-danger">TRX-<?= str_pad($trx['id_transaksi'], 5, "0", STR_PAD_LEFT) ?></td>
                            <td><?= date('d M Y', strtotime($trx['tanggal'])) ?></td>
                            <td class="fw-bold">Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <a href="cetak.php?id=<?= $trx['id_transaksi'] ?>" class="btn btn-detail" target="_blank">Lihat Nota</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <p class="text-center mt-5 text-muted">Belum ada transaksi.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="text-center pb-4 text-muted">
        <small>&copy; <?= date('Y') ?> IBox Online Shopping</small>
    </footer>
</body>
</html>