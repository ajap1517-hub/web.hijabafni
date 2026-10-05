<?php
session_start();
include "koneksi.php";

// Ambil data user yang SEDANG LOGIN dari session (bukan tabel profil lama)
$id_user = $_SESSION['id_user'] ?? 0;
if (!$id_user) {
    header("Location: login.php");
    exit;
}

// Ambil data user dari tb_user berdasarkan session
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id_user'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['simpan'])) {

    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nohp   = mysqli_real_escape_string($koneksi, $_POST['nohp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Update data user yang login
    $sql = "UPDATE tb_user SET
            nama='$nama',
            hp='$nohp',
            alamat='$alamat',
            email='$email'
            WHERE id='$id_user'";

    if (mysqli_query($koneksi, $sql)) {
        // Sinkronkan session dengan data baru
        $_SESSION['nama'] = $nama;
        header("Location: profil.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}

// Ambil ulang data user terbaru
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id_user'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelanggan & Member</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<style>
    :root {
        --primary-color: #e878ad;
        --primary-dark: #d85d96;
        --secondary-color: #9b7183;
        --accent-gold: #e9a8c4;
        --bg-body: #fff7fb;
        --bg-card: #ffffff;
        --text-main: #6f4057;
        --text-muted: #a47d8e;
        --border-color: #f2d5e2;
        --success: #df79a7;
        --shadow: 0 6px 20px rgba(191, 91, 133, 0.10);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: transparent !important;
        color: var(--text-main);
        padding: 2rem;
        display: flex;
        justify-content: center;
        min-height: 100vh;
    }

    /* =========================
       CONTAINER
       ========================= */

    .dashboard-container {
        width: 100%;
        max-width: 1000px;
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
    }

    /* =========================
       SIDEBAR
       ========================= */

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .user-card {
        background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: var(--shadow);
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 10px 40px 0 rgba(255, 154, 158, 0.3);
    }

    .user-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 85px;
        background: linear-gradient(to right, #f472b6, #f43f5e); opacity: 0.8;
    }

    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid rgba(255,255,255,0.8);
        object-fit: cover;
        position: relative;
        margin-top: 30px;
        background: rgba(255,255,255,0.5); backdrop-filter: blur(5px);
        box-shadow: 0 5px 15px rgba(190, 83, 129, 0.15);
    }

    .user-name {
        margin-top: 1rem;
        font-weight: 700;
        font-size: 1.25rem;
        color: #a74673;
    }

    .info-value {
        font-weight: 600;
        color: #8d4c69;
    }

    .user-id {
        font-size: 0.875rem;
        color: #aa8393;
        margin-bottom: 0.7rem;
    }

    /* =========================
       MEMBER BADGE
       ========================= */

    .member-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #fff0f6;
        color: #bd5a86;
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid #f2bfd4;
    }

    .member-badge i {
        color: #d978a5 !important;
    }

    /* =========================
       MAIN CONTENT
       ========================= */

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .content-card {
        background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 10px 40px 0 rgba(255, 154, 158, 0.3);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8e5ed;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #a74673;
    }

    /* =========================
       INFORMATION
       ========================= */

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }

    .info-group label {
        display: block;
        font-size: 0.82rem;
        color: #ad8194;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .info-value {
        font-weight: 600;
        color: #704258;
    }

    .address-box {
        background: #fff7fb;
        padding: 1.2rem;
        border-radius: 13px;
        border: 1px solid #f2d6e2;
        grid-column: span 2;
    }

    /* =========================
       BUTTON
       ========================= */

    .btn {
        padding: 0.65rem 1.2rem;
        border-radius: 11px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(to right, #f472b6, #f43f5e) !important; border: none !important;
        color: white;
        box-shadow: 0 5px 12px rgba(213, 91, 145, 0.18);
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #ec4899, #e11d48) !important;
        transform: translateY(-2px);
    }

    .btn-outline {
        background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        border: 1px solid #efbfd3;
        color: #b34e7b;
    }

    .btn-outline:hover {
        background: #fff0f6;
        border-color: #e89cbb;
        color: #a33f6b;
    }

    /* =========================
       FORM EDIT
       ========================= */

    .edit-mode {
        display: none;
    }

    .edit-mode.active {
        display: block;
        animation: fadeIn 0.3s;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #9c627b;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .form-group.full {
        grid-column: span 2;
    }

    .form-input {
        background: rgba(255, 255, 255, 0.4);
        width: 100%;
        padding: 0.8rem 0.9rem;
        border: 2px solid #f1d3df;
        border-radius: 11px;
        font-size: 0.95rem;
        color: #704258;
        background: #fffafd;
        transition: all 0.2s ease;
    }

    .form-input:hover {
        border-color: #eab4cc;
    }

    .form-input:focus {
        outline: none;
        border-color: #e878ad;
        background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 0 0 4px rgba(232, 120, 173, 0.12);
    }

    .form-input::placeholder {
        color: #c4a2b0;
    }

    textarea.form-input {
        background: rgba(255, 255, 255, 0.4);
        resize: vertical;
        min-height: 100px;
    }

    /* =========================
       TOAST
       ========================= */

    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        padding: 1rem 1.5rem;
        border-radius: 13px;
        box-shadow: 0 10px 25px rgba(180, 75, 125, 0.15);
        border-left: 4px solid #e878ad;
        transform: translateY(150%);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #78455d;
    }

    .toast i {
        color: #e878ad !important;
    }

    .toast.show {
        transform: translateY(0);
    }

    /* =========================
       ANIMATION
       ========================= */

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================
       RESPONSIVE
       ========================= */

    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }

        .dashboard-container {
            grid-template-columns: 1fr;
        }

        .form-grid,
        .info-grid {
            grid-template-columns: 1fr;
        }

        .address-box {
            grid-column: span 1;
        }

        .form-group.full {
            grid-column: span 1;
        }

        .content-card,
        .user-card {
            padding: 1.5rem;
        }

        .section-header {
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>

</head>
<body>

    <div class="dashboard-container">
        
        <!-- SIDEBAR: Status & Loyalty -->
        <aside class="sidebar">
            <!-- Kartu Identitas Pelanggan -->
            <div class="user-card">
                <img src="https://picsum.photos/seed/cust99/200/200" alt="Pelanggan" id="disp-avatar" class="avatar">
                <div class="info-value"> 
                    <?= htmlspecialchars($data['nama'] ?? '') ?> 
                </div>
                <div class="user-id">Username: <?= htmlspecialchars($data['username'] ?? '') ?></div>
                <div class="member-badge">
                    <i class="fas fa-crown" style="color: #b45309;"></i>
                    <span id="disp-level">Pelanggan</span>
                </div>
            </div>
            
            <a href="index2.php" class="btn btn-outline" style="text-align: center; display: block; margin-top: 10px; text-decoration: none; font-weight: 600; padding: 12px; border-radius: 13px;">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Toko
            </a>
        </aside>


        <!-- MAIN CONTENT: Detail & Edit -->
        <main class="main-content">
            
            <!-- VIEW MODE -->
            <section id="view-section" class="content-card">
                <div class="section-header">
                    <h3 class="section-title">Informasi Akun</h3>
                    <button class="btn btn-outline" onclick="toggleEdit(true)">
                        <i class="fas fa-pen"></i> Edit Profil
                    </button>
                </div>

                <div class="info-grid">
                    <div class="info-group">
                        <label>Nama Lengkap</label>
                    <div class="info-value" id="disp-name-detail">
                    <?= htmlspecialchars($data['nama'] ?? '') ?>
                    </div>
                    </div>
                    <div class="info-group">
                        <label>Email</label>
                    <div class="info-value" id="disp-email">
                    <?= htmlspecialchars($data['email'] ?? '') ?>
                    </div>
                    </div>
                    <div class="info-group">
                        <label>Nomor Telepon</label>
                    <div class="info-value" id="disp-phone">
                    <?= htmlspecialchars($data['hp'] ?? '') ?>
                    </div>
                    </div>
                    <div class="info-group">
                        <label>Username</label>
                        <div class="info-value" id="disp-dob"><?= htmlspecialchars($data['username'] ?? '') ?></div>
                    </div>
                    
                    <!-- Alamat (Full Width) -->
                    <div class="address-box">
                        <div class="info-group">
                            <label>Alamat Pengiriman Utama</label>
                         <div class="info-value" id="disp-address">
                         <?= nl2br(htmlspecialchars($data['alamat'] ?? '')) ?>
                         </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- EDIT MODE -->
            <section id="edit-section" class="content-card edit-mode">
                <div class="section-header">
                    <h3 class="section-title">Edit Data Pelanggan</h3>
                    <button class="btn btn-outline" onclick="toggleEdit(false)">Batal</button>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-input" name="nama"
                            value="<?= htmlspecialchars($data['nama'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-input" name="email"
                            value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="tel" class="form-input" name="nohp" id="inp-phone" value="<?= htmlspecialchars($data['hp'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($data['username'] ?? '') ?>" disabled>
                        </div>
                        
                        <div class="form-group full">
                            <label>Alamat Lengkap</label>
                            <textarea class="form-input" name="alamat" id="inp-address" rows="3" placeholder="Jalan, No Rumah, Kecamatan, Kota, Kode Pos..." required><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; text-align: right;">
                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>

        </main>
    </div>
    

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <i class="fas fa-check-circle" style="color: var(--success);"></i>
        <span id="toast-msg">Data berhasil disimpan</span>
    </div>

    <script>
        const viewSection = document.getElementById('view-section');
        const editSection = document.getElementById('edit-section');

        // Toggle Edit Mode
        function toggleEdit(isEdit) {
            if (isEdit) {
                viewSection.style.display = 'none';
                editSection.classList.add('active');
            } else {
                editSection.classList.remove('active');
                setTimeout(() => {
                    editSection.style.display = 'none';
                    viewSection.style.display = 'block';
                }, 300);
            }
        }

        // Toast Function
        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        showToast("Data profil berhasil dimuat");
    </script>
</body>
</html>







