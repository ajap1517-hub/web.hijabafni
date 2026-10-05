<?php
session_start();
// if (!isset($_SESSION['id_user'])) {
//     header('location:login.php');
// }

include "koneksi.php";

$id_user = $_SESSION['id_user'] ?? 0;

if (isset($_POST["add"])) {
    $id_produk = $_GET["id"];

    if (isset($_SESSION["cart"][$id_produk])) {
        // Kalau produk sudah ada di keranjang → update jumlahnya
        $_SESSION["cart"][$id_produk]['jumlah'] += $_POST["jumlah"];
    } else {
        // Kalau produk belum ada → tambahkan baru
        $_SESSION["cart"][$id_produk] = array(
            'id' => $id_produk,
            'nama' => $_POST["hidden_nama"],
            'harga' => $_POST["hidden_harga"],
            'foto' => $_POST["hidden_poto"],
            'jumlah' => $_POST["jumlah"]
        );
    }

    echo '<script>window.location="keranjang.php"</script>';
}

if (isset($_GET["aksi"])) {
    if ($_GET["aksi"] == "hapus") {
        $id_produk = $_GET["id"];
        if (isset($_SESSION["cart"][$id_produk])) {
            unset($_SESSION["cart"][$id_produk]);
            echo '<script>alert("Produk berhasil dihapus.")</script>';
            echo '<script>window.location="keranjang.php"</script>';
        }
    } elseif ($_GET["aksi"] == "beli") {

        $total = 0;
        foreach ($_SESSION["cart"] as $value) {
            $total += ($value["jumlah"] * $value["harga"]);
        }

        // Simpan transaksi utama
        $query = mysqli_query(
            $koneksi,
            "INSERT INTO tb_transaksi(tanggal, id_pelanggan, total_harga) 
                 VALUES ('" . date("Y-m-d") . "', '$id_user', '$total')"
        )
            or die("Error insert transaksi: " . mysqli_error($koneksi));
        $id_transaksi = mysqli_insert_id($koneksi);

        // Simpan detail produk
        foreach ($_SESSION["cart"] as $value) {
            $id_produk = $value['id'];
            $jumlah = $value['jumlah'];
            $sql = "INSERT INTO tb_detail(id_transaksi, id_produk, jumlah) 
                        VALUES ('$id_transaksi', '$id_produk', '$jumlah')";
            mysqli_query($koneksi, $sql);
        }

        // Kosongkan keranjang setelah transaksi
        unset($_SESSION["cart"]);
        echo "<script>window.location='cetak.php?id=" . $id_transaksi . "'</script>";
        exit;
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>IBox Online Shopping</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ==============================
       PINK CUTE THEME - IBOX
       ============================== */

        body {
            background: #fff5fa;
            color: #5c3b4a;
            font-family: "Segoe UI", sans-serif;
        }

        /* Header */
        header {
            background: #ffffff;
            border-bottom: 2px solid #ffd6e8 !important;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 15px rgba(255, 182, 212, 0.15);
        }

        header a {
            color: #c94f83 !important;
            font-weight: 600;
            transition: 0.3s;
        }

        header a:hover {
            color: #ff6fa8 !important;
            transform: translateY(-2px);
        }

        /* Logo */
        header img {
            object-fit: contain;
        }

        /* Navigation */
        .nav-link {
            color: #b85c82 !important;
            font-weight: 500;
            border-radius: 20px;
            padding: 8px 14px !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: #ffe1ed;
            color: #e83e82 !important;
            transform: translateY(-2px);
        }

        /* Icon profile & cart */
        .col-md-3.text-end .btn {
            color: #d94f87;
            background: #fff0f6;
            border: 1px solid #ffd0e2;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            margin-left: 5px;
            transition: all 0.3s ease;
        }

        .col-md-3.text-end .btn:hover {
            background: #ffb6d2;
            color: white;
            transform: scale(1.1) rotate(-3deg);
            box-shadow: 0 5px 15px rgba(255, 105, 160, 0.3);
        }

        /* Container keranjang */
        .marketing {
            background: white;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(255, 158, 194, 0.18);
            margin-top: 30px;
            margin-bottom: 40px;
        }

        /* Judul */
        .marketing h3 {
            color: #d94f87;
            font-weight: 700;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .marketing h3::before {
            content: "♡ ";
            color: #ff8fba;
        }

        .marketing h3::after {
            content: " ♡";
            color: #ff8fba;
        }

        /* Tabel */
        .table {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #ffd6e7;
            margin-top: 15px;
        }

        .table thead {
            background: #ffd6e7;
            color: #8d3d61;
        }

        .table thead th {
            border: none;
            padding: 16px;
            font-weight: 700;
        }

        .table tbody tr {
            border-bottom: 1px solid #ffe5ef;
            transition: all 0.25s ease;
        }

        .table tbody tr:hover {
            background: #fff6fa;
        }

        .table td,
        .table th {
            vertical-align: middle;
            border-color: #ffe5ef;
        }

        /* Foto produk */
        .table td img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            background: #fff5f9;
            padding: 8px;
            border-radius: 15px;
            border: 2px solid #ffd9e8;
            margin-right: 12px;
            transition: 0.3s;
        }

        .table td img:hover {
            transform: scale(1.06);
            box-shadow: 0 5px 15px rgba(255, 132, 177, 0.2);
        }

        /* Nama produk */
        .table td {
            color: #684557;
            font-weight: 500;
        }

        /* Harga */
        .table td:nth-child(3),
        .table td:nth-child(4),
        .table th {
            color: #b94776;
        }

        /* Tombol Hapus */
        .btn-danger {
            background: #ff8fb8 !important;
            border: none !important;
            color: white !important;
            border-radius: 20px !important;
            padding: 8px 18px !important;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(255, 120, 165, 0.2);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #e95c91 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 100, 155, 0.3);
        }

        /* Grand Total */
        .table tbody tr:last-child {
            background: #fff0f6;
        }

        .table tbody tr:last-child td,
        .table tbody tr:last-child th {
            border-top: 2px solid #ffd1e2;
            color: #c43f73;
            font-size: 17px;
        }

        /* Tombol Beli */
        .btn-outline-dark {
            color: white !important;
            background: #e9689b !important;
            border: none !important;
            border-radius: 25px !important;
            padding: 10px 25px !important;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(233, 104, 155, 0.25);
            transition: all 0.3s ease;
        }

        .btn-outline-dark:hover {
            background: #d94f87 !important;
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 20px rgba(217, 79, 135, 0.3);
        }

        /* Keranjang kosong */
        .marketing>p {
            color: #b36a87;
            font-size: 16px;
            padding: 30px;
            background: #fff4f8;
            border-radius: 18px;
        }

        /* Garis */
        hr {
            border: none;
            border-top: 2px dashed #ffc8dd;
            opacity: 1;
        }

        /* Footer */
        footer {
            color: #a45c7b;
            padding: 20px 0 30px;
        }

        footer a {
            color: #d94f87;
            text-decoration: none;
            font-weight: 500;
        }

        footer a:hover {
            color: #ff6fa8;
            text-decoration: underline;
        }

        /* Back to top */
        footer .float-end a {
            background: #ffe1ed;
            padding: 8px 15px;
            border-radius: 20px;
            transition: 0.3s;
        }

        footer .float-end a:hover {
            background: #ffb6d2;
            color: white;
            text-decoration: none;
        }

        /* Tampilan HP */
        @media (max-width: 768px) {

            header {
                padding: 15px !important;
            }

            .marketing {
                padding: 18px;
                border-radius: 20px;
            }

            .marketing h3 {
                font-size: 24px;
            }

            .table {
                font-size: 13px;
            }

            .table td img {
                width: 60px;
                height: 60px;
            }

            .btn-danger {
                padding: 6px 12px !important;
                font-size: 12px;
            }

            .btn-outline-dark {
                padding: 8px 15px !important;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php#produk" class="nav-link px-2 link-dark">Instan</a></li>
                <li><a href="index.php#ipad" class="nav-link px-2 link-secondary">Segiempat</a></li>
                <li><a href="index.php#watch" class="nav-link px-2 link-secondary">Pashmina</a></li>
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

    <main>
        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">
            <h3 align="center"> Keranjangmu</h3>
            <br>
            <?php if (!empty($_SESSION["cart"])) { ?>
                <table class="table">
                    <thead>
                        <tr class="text-center align-middle">
                            <th scope="col">Produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                            <tr>
                                <td>
                                    <img src="dashboard/img/<?= $value["foto"] ?>" height="100px"><?= $value["nama"] ?>
                                </td>
                                <td class="text-center align-middle"><?= $value["jumlah"] ?></td>
                                <td class="text-center align-middle">Rp <?php echo number_format($value["harga"]) ?></td>
                                <td class="text-center align-middle">
                                    Rp <?php echo number_format($value["jumlah"] * $value["harga"], 2); ?></td>
                                <td class="text-center align-middle">
                                    <a href="keranjang.php?aksi=hapus&id=<?= $value["id"]; ?>"><span class="btn btn-danger">Hapus</span></a>
                                </td>
                            </tr>
                        <?php
                            $total = $total + ($value["jumlah"] * $value["harga"]);
                        }
                        ?>
                        <tr>
                            <td colspan="3" class="text-end align-middle">Grand Total</td>
                            <th class="text-center align-middle">Rp <?php echo number_format($total, 2); ?></th>
                            <td class="text-center align-middle">
                                <a href="keranjang.php?aksi=beli" type="button" class="btn btn-outline-dark">Beli</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } else { ?>
                <p align="center"> Belum Ada Produk di Keranjang </p>
                <hr>
            <?php } ?>

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class=" container">
            <p class="float-end"><a href="index2.php">Back to top</a></p>
            <p>&copy; 2017–2023 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>