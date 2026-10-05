
<?php
include 'koneksi.php';

// Mengambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id == '') {
    die("ID produk tidak ditemukan.");
}

// Mengambil data produk berdasarkan ID
$hasil = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_produk WHERE id='$id'"
);

if (!$hasil) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Mengecek apakah data produk ditemukan
if (mysqli_num_rows($hasil) == 0) {
    die("Produk tidak ditemukan.");
}

$data = mysqli_fetch_assoc($hasil);

$nama = $data['nama'];
$harga = $data['harga'];
$deskripsi = $data['deskripsi'];
$poto = $data['poto'];
?>

<!doctype html>
<html lang="id" data-bs-theme="auto">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="description"
        content="Detail produk"
    >

    <title><?= htmlspecialchars($nama) ?> - Detail Produk</title>

    <link
        href="assets/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Hapus background lama agar Global Glassmorphism muncul */
        body {
            background-color: transparent !important;
        }

        /* Override Header Gelap */
        header[data-bs-theme="dark"] .bg-dark {
            background: rgba(255,255,255,0.4) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255,255,255,0.5);
        }
        
        .navbar-brand {
            color: #be185d !important;
        }

        /* Container Glassmorphism untuk Detail */
        .product-detail {
            margin-top: 50px;
            margin-bottom: 80px;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 2rem;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(255, 154, 158, 0.3);
        }

        /* Animasi melayang pada foto */
        .product-image {
            width: 100%;
            max-width: 450px;
            height: 450px;
            object-fit: cover;
            border-radius: 1.5rem;
            display: block;
            margin: auto;
            box-shadow: 0 15px 35px rgba(255, 154, 158, 0.4);
            transition: transform 0.4s ease;
            border: 2px solid rgba(255,255,255,0.8);
        }
        .product-image:hover {
            transform: translateY(-8px) scale(1.02);
        }

        /* Tipografi Elegan */
        .product-name {
            font-size: 38px;
            font-weight: 800;
            color: #be185d; /* text-pink-700 */
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .product-price {
            font-size: 28px;
            font-weight: 700;
            margin-top: 15px;
            color: #f43f5e; /* rose-500 */
            background: rgba(255,255,255,0.5);
            display: inline-block;
            padding: 8px 20px;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(244,63,94,0.1);
        }

        .product-description {
            font-size: 17px;
            line-height: 1.8;
            margin-top: 25px;
            color: #4b5563; /* gray-600 */
            font-weight: 500;
        }

        /* Form Input */
        input[type="number"] {
            border-radius: 1rem !important;
            padding: 10px 15px !important;
            border: 1px solid rgba(255,255,255,0.8) !important;
            font-weight: 600;
            background: rgba(255,255,255,0.6) !important;
        }
        
        .form-label {
            font-weight: 700;
            color: #8c6b75;
        }

        /* Tombol */
        input[type="submit"] {
            background: linear-gradient(to right, #f472b6, #f43f5e) !important;
            border: none !important;
            border-radius: 1rem !important;
            padding: 12px 25px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px;
            transition: all 0.3s ease !important;
            box-shadow: 0 6px 15px rgba(244,63,94,0.3) !important;
            width: 100%;
            color: white !important;
        }
        
        input[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(244,63,94,0.4) !important;
        }

        .btn-back {
            background: rgba(255,255,255,0.5) !important;
            border: 1px solid rgba(255,255,255,0.8) !important;
            color: #be185d !important;
            border-radius: 1rem !important;
            padding: 12px 25px !important;
            font-weight: 700 !important;
            transition: all 0.3s ease !important;
            width: 100%;
        }
        
        .btn-back:hover {
            background: rgba(255,255,255,0.8) !important;
            transform: translateY(-3px);
        }

        /* Ganti teks Album Produk via CSS tanpa ubah HTML */
        .navbar-brand strong {
            visibility: hidden;
            position: relative;
        }
        .navbar-brand strong::after {
            content: "\f54e AFNI Shop";
            font-family: "Font Awesome 6 Free", "Poppins", sans-serif;
            font-weight: 700;
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
            white-space: nowrap;
        }
    </style>
</head>

<body>

<header data-bs-theme="dark">

    <div class="navbar navbar-dark bg-dark shadow-sm">

        <div class="container">

            <a
                href="index2.php"
                class="navbar-brand d-flex align-items-center"
            >
                <strong>Album Produk</strong>
            </a>

        </div>

    </div>

</header>


<main>

    <div class="container product-detail">

        <div class="row align-items-center">

            <!-- GAMBAR PRODUK -->
            <div class="col-md-6 mb-4">

                <img
                    src="dashboard/img/<?= htmlspecialchars($poto) ?>"
                    class="product-image"
                    alt="<?= htmlspecialchars($nama) ?>"
                    onerror="this.src='https://via.placeholder.com/500x500?text=Gambar+Tidak+Ditemukan';"
                >

            </div>


            <!-- INFORMASI PRODUK -->
            <div class="col-md-6">

                <h1 class="product-name">
                    <?= htmlspecialchars($nama) ?>
                </h1>


                <p class="product-price">
                    Rp <?= number_format($harga, 0, ',', '.') ?>
                </p>


                <p class="product-description">
                    <?= nl2br(htmlspecialchars($deskripsi)) ?>
                </p>


                <!-- FORM KERANJANG -->
                <form
                    method="post"
                    action="keranjang.php?id=<?= htmlspecialchars($id) ?>"
                    class="mt-4"
                >

                    <input
                        type="hidden"
                        name="hidden_poto"
                        value="<?= htmlspecialchars($poto) ?>"
                    >

                    <input
                        type="hidden"
                        name="hidden_nama"
                        value="<?= htmlspecialchars($nama) ?>"
                    >

                    <input
                        type="hidden"
                        name="hidden_harga"
                        value="<?= htmlspecialchars($harga) ?>"
                    >


                    <div class="mb-3">

                        <label
                            for="jumlah"
                            class="form-label"
                        >
                            Jumlah
                        </label>

                        <input
                            type="number"
                            id="jumlah"
                            name="jumlah"
                            value="1"
                            min="1"
                            class="form-control"
                            style="max-width: 120px;"
                        >

                    </div>


                    <button
                        type="submit"
                        name="add"
                        class="btn btn-dark"
                    >
                        Tambah ke Keranjang
                    </button>

                </form>


                <!-- KEMBALI -->
                <a
                    href="index2.php"
                    class="btn btn-outline-secondary back-button"
                >
                    ← Kembali ke Produk
                </a>

            </div>

        </div>

    </div>

</main>


<footer class="text-body-secondary py-5">

    <div class="container">


    </div>

</footer>


<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>


