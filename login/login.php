<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])){
    $username= $_POST['username'];
    $password= $_POST['password'];
    $login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
    if(mysqli_num_rows($login) > 0) {
        $data = mysqli_fetch_array($login);

        if($data['role'] == 'admin'){
            $_SESSION['admin']=$username;
            $redirect = 'dashboard/admin.php';
        } else if($data['role'] == 'pelanggan') {
            $_SESSION['id_user']=$data['id'];
            $_SESSION['nama']=$data['nama'];
            $_SESSION['username']=$data['username'];
            $redirect = 'index2.php';
        }
    } else {
        $login_gagal = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($redirect)) { ?>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: <?= json_encode('Selamat datang, ' . $username . '!') ?>,
                confirmButtonText: 'OK',
                confirmButtonColor: '#be185d'
            }).then(function () {
                window.location.href = <?= json_encode($redirect) ?>;
            });
        });
    </script>
    <?php } ?>

    <?php if (isset($login_gagal)) { ?>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Username atau password salah.',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#be185d'
            });
        });
    </script>
    <?php } ?>

    <title>Login - Pink Interactive Theme</title>
    <!-- Memuat Tailwind CSS untuk layout dan styling dasar -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat Font Awesome untuk ikon (ikon mata pada password) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Memuat Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fbc2eb 0%, #ff9a9e 100%);
            overflow-x: hidden;
        }

        /* Animasi untuk efek melayang pada latar belakang (Floating Orbs) */
        @keyframes float {
            0% { transform: translateY(0px) translateX(0px) rotate(0deg); }
            33% { transform: translateY(-30px) translateX(20px) rotate(10deg); }
            66% { transform: translateY(20px) translateX(-20px) rotate(-10deg); }
            100% { transform: translateY(0px) translateX(0px) rotate(0deg); }
        }

        .blob-1 {
            animation: float 8s ease-in-out infinite;
        }
        .blob-2 {
            animation: float 10s ease-in-out infinite reverse;
        }
        .blob-3 {
            animation: float 12s ease-in-out infinite 2s;
        }

        /* Animasi masuk (fade in & slide up) untuk card form */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-enter {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Styling spesifik untuk efek Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(255, 154, 158, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative w-full">

    <!-- Latar Belakang Dekoratif (Floating Blobs) -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-fuchsia-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 blob-1 z-0"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-rose-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 blob-2 z-0"></div>
    <div class="absolute top-[40%] left-[30%] w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 blob-3 z-0"></div>

    <!-- Kontainer Form Login Utama -->
    <div class="glass-panel w-full max-w-md p-8 sm:p-10 rounded-3xl z-10 card-enter mx-4 relative overflow-hidden">
        
        <!-- Aksen garis bercahaya di atas form -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-pink-300 via-rose-400 to-fuchsia-400"></div>

        <!-- Tombol Kembali ke Beranda -->
        <a href="index2.php" class="absolute top-4 left-4 w-10 h-10 flex items-center justify-center rounded-full bg-white/50 border border-white/70 text-rose-600 hover:bg-white/80 hover:text-rose-700 transition-all duration-300 shadow-sm z-20" title="Kembali ke Beranda">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight mb-2">Selamat Datang</h2>
            <p class="text-pink-700 text-sm font-medium">Silakan masuk ke akun Anda</p>
        </div>

        <form id="loginForm" method="post" class="space-y-6">
            <!-- Input Grup: Username -->
            <div class="relative z-0 w-full mb-6 group">
                <!-- Peer class digunakan oleh Tailwind untuk mendeteksi state fokus dan mengontrol label -->
                <input type="text" name="username" id="username" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300" placeholder=" " required />
                <label for="username" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Username
                </label>
            </div>

            <!-- Input Grup: Password -->
            <div class="relative z-0 w-full mb-2 group">
                <input type="password" name="password" id="password" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300 pr-10" placeholder=" " required />
                <label for="password" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Kata Sandi
                </label>
                <!-- Tombol Toggle Mata -->
                <button type="button" id="togglePassword" class="absolute right-0 top-3 text-pink-500 hover:text-rose-700 focus:outline-none transition-colors">
                    <i class="fa-regular fa-eye" id="eyeIcon"></i>
                </button>
            </div>

            <!-- Lupa Password & Ingat Saya -->
            <div class="flex items-center justify-between text-sm mb-8 mt-2">
                <label class="flex items-center text-pink-700 cursor-pointer hover:text-rose-800 transition-colors">
                    <input type="checkbox" class="w-4 h-4 rounded border-pink-300 text-rose-500 focus:ring-rose-400 bg-white/50 cursor-pointer">
                    <span class="ml-2 font-medium">Ingat saya</span>
                </label>
                <a href="#" class="text-rose-600 font-semibold hover:text-rose-800 transition-colors hover:underline decoration-2 underline-offset-4">
                  
                </a>
            </div>

            <!-- Tombol Login -->
            <button type="submit" name="login" class="relative w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-base font-bold text-white bg-gradient-to-r from-pink-400 to-rose-500 hover:from-pink-500 hover:to-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-400 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg overflow-hidden group">
                <span class="relative z-10 flex items-center gap-2">
                    Masuk <i class="fa-solid fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </span>
                <!-- Efek kilau saat hover pada tombol -->
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out z-0"></div>
            </button>
        </form>

        <!-- Link Daftar (Sign up) -->
        <div class="mt-8 text-center text-sm text-pink-800 font-medium">
            Belum punya akun? 
            <a href="register.php" class="font-bold text-rose-600 hover:text-rose-800 transition-colors hover:underline decoration-2 underline-offset-4 ml-1">
                Daftar sekarang
            </a>
        </div>
    </div>

    <script>
        // Logika untuk menampilkan / menyembunyikan kata sandi
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Toggle atribut type antara password dan text
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Mengubah ikon mata (terbuka/tertutup)
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
