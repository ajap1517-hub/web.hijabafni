<?php
include 'koneksi.php';

if (isset($_POST['register'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    
    $register = mysqli_query($koneksi,"INSERT INTO tb_user (nama, username, email, hp, alamat, password, role) VALUES ('$name', '$username', '$email', '$hp', '$alamat', '$password', 'pelanggan')");

    if($register) {
      echo "<script>
      alert('Registrasi berhasil! Silahkan Login');
      window.location='login.php';
      </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Pink Interactive Theme</title>
    <!-- Memuat Tailwind CSS untuk layout dan styling dasar -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Memuat Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fbc2eb 0%, #ff9a9e 100%);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animasi untuk efek melayang pada latar belakang (Floating Orbs) */
        @keyframes float {
            0% { transform: translateY(0px) translateX(0px) rotate(0deg); }
            33% { transform: translateY(-30px) translateX(20px) rotate(10deg); }
            66% { transform: translateY(20px) translateX(-20px) rotate(-10deg); }
            100% { transform: translateY(0px) translateX(0px) rotate(0deg); }
        }

        .blob-1 { animation: float 8s ease-in-out infinite; }
        .blob-2 { animation: float 10s ease-in-out infinite reverse; }
        .blob-3 { animation: float 12s ease-in-out infinite 2s; }

        /* Animasi masuk (fade in & slide up) untuk card form */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-enter {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Styling spesifik untuk efek Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 40px 0 rgba(255, 154, 158, 0.4);
        }
    </style>
</head>
<body class="flex items-center justify-center relative w-full py-10">

    <!-- Latar Belakang Dekoratif (Floating Blobs) -->
    <div class="fixed top-[-10%] left-[-5%] w-[30rem] h-[30rem] bg-fuchsia-300 rounded-full mix-blend-multiply filter blur-3xl opacity-60 blob-1 z-0 pointer-events-none"></div>
    <div class="fixed bottom-[-10%] right-[-5%] w-[30rem] h-[30rem] bg-rose-300 rounded-full mix-blend-multiply filter blur-3xl opacity-60 blob-2 z-0 pointer-events-none"></div>
    <div class="fixed top-[30%] left-[40%] w-[20rem] h-[20rem] bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-40 blob-3 z-0 pointer-events-none"></div>

    <!-- Kontainer Form Registrasi -->
    <div class="glass-panel w-full max-w-2xl p-8 sm:p-10 rounded-[2rem] z-10 card-enter mx-4 relative overflow-hidden">
        
        <!-- Aksen garis bercahaya di atas form -->
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-pink-300 via-rose-400 to-fuchsia-400"></div>

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-white/50 text-rose-500 mb-4 shadow-sm border border-white/60">
                <i class="fa-solid fa-user-plus text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight mb-2">Daftar Akun Baru</h2>
            <p class="text-pink-700 text-sm font-medium">Lengkapi formulir di bawah ini untuk bergabung.</p>
        </div>

        <form id="registerForm" method="post" class="space-y-6">
            <!-- Grid untuk merapikan layout form menjadi 2 kolom di layar besar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                
                <!-- Input Grup: Nama -->
                <div class="relative z-0 w-full group">
                    <input type="text" name="name" id="name" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Nama Lengkap
                    </label>
                </div>

                <!-- Input Grup: Username -->
                <div class="relative z-0 w-full group">
                    <input type="text" name="username" id="username" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300" placeholder=" " required />
                    <label for="username" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Username
                    </label>
                </div>

                <!-- Input Grup: Email -->
                <div class="relative z-0 w-full group">
                    <input type="email" name="email" id="email" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300" placeholder=" " required />
                    <label for="email" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Alamat Email
                    </label>
                </div>

                <!-- Input Grup: No. HP -->
                <div class="relative z-0 w-full group">
                    <input type="tel" name="hp" id="hp" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300" placeholder=" " required />
                    <label for="hp" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        No. Handphone
                    </label>
                </div>

                <!-- Input Grup: Alamat (Full Width) -->
                <div class="relative z-0 w-full group md:col-span-2">
                    <textarea name="alamat" id="alamat" rows="2" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300 resize-none" placeholder=" " required></textarea>
                    <label for="alamat" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Alamat Lengkap
                    </label>
                </div>

                <!-- Input Grup: Password -->
                <div class="relative z-0 w-full group">
                    <input type="password" name="password" id="password" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300 pr-10" placeholder=" " required />
                    <label for="password" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Kata Sandi
                    </label>
                    <button type="button" class="toggle-password absolute right-0 top-3 text-pink-500 hover:text-rose-700 focus:outline-none transition-colors" data-target="password">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>

                <!-- Input Grup: Konfirmasi Password -->
                <div class="relative z-0 w-full group">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="block py-3 px-0 w-full text-base text-gray-800 bg-transparent border-0 border-b-2 border-pink-300 appearance-none focus:outline-none focus:ring-0 focus:border-rose-500 peer transition-colors duration-300 pr-10" placeholder=" " required />
                    <label for="confirmPassword" class="peer-focus:font-medium absolute text-base text-pink-600 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-rose-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Konfirmasi Kata Sandi
                    </label>
                    <button type="button" class="toggle-password absolute right-0 top-3 text-pink-500 hover:text-rose-700 focus:outline-none transition-colors" data-target="confirmPassword">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Pesan Error Password -->
            <p id="passwordError" class="text-red-500 text-sm hidden font-medium mt-2"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Kata sandi dan konfirmasi tidak cocok!</p>

            <!-- Tombol Register -->
            <button type="submit" name="register" id="submitBtn" class="relative mt-6 w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-md text-base font-bold text-white bg-gradient-to-r from-pink-400 to-rose-500 hover:from-pink-500 hover:to-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-400 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg overflow-hidden group">
                <span class="relative z-10 flex items-center gap-2">
                    Daftar Sekarang <i class="fa-solid fa-paper-plane text-sm group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                </span>
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out z-0"></div>
            </button>
        </form>

        <!-- Link ke Login -->
        <div class="mt-8 text-center text-sm text-pink-800 font-medium">
            Sudah punya akun? 
            <a href="login.php" class="font-bold text-rose-600 hover:text-rose-800 transition-colors hover:underline decoration-2 underline-offset-4 ml-1">
                Masuk di sini
            </a>
        </div>
    </div>

    <script>
        // --- LOGIKA TOGGLE SHOW/HIDE PASSWORD ---
        const toggleButtons = document.querySelectorAll('.toggle-password');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const inputField = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                // Ganti tipe input
                const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                inputField.setAttribute('type', type);
                
                // Ganti ikon mata
                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // --- LOGIKA SUBMIT FORM (VALIDASI AJA, JANGAN MENCEGAH PHP BEKERJA) ---
        const registerForm = document.getElementById('registerForm');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordError = document.getElementById('passwordError');

        registerForm.addEventListener('submit', function(e) {
            // Validasi Password Cocok
            if (passwordInput.value !== confirmPasswordInput.value) {
                e.preventDefault(); // Mencegah form terkirim HANYA JIKA password salah
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('border-red-500');
                confirmPasswordInput.classList.add('border-red-500');
            } else {
                // JIKA COCOK, biarkan event berjalan (form akan ter-submit ke server via metode POST normal)
                passwordError.classList.add('hidden');
                passwordInput.classList.remove('border-red-500');
                confirmPasswordInput.classList.remove('border-red-500');
                
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin text-xl text-white"></i> <span class="ml-2">Memproses...</span>';
                submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
            }
        });
        
        // Hapus peringatan error saat user mulai mengetik ulang password
        [passwordInput, confirmPasswordInput].forEach(input => {
            input.addEventListener('input', () => {
                passwordError.classList.add('hidden');
                passwordInput.classList.remove('border-red-500');
                confirmPasswordInput.classList.remove('border-red-500');
            });
        });
    </script>
</body>
</html>

