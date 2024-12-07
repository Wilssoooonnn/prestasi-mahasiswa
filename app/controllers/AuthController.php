<?php
// app/controllers/AuthController.php

require_once '../app/models/UserModel.php'; // Memuat model

class AuthController
{
    public function index()
    {
        // Tampilkan halaman login sebagai halaman default
        $judul = 'Login';
        include '../app/views/template/header.php';
        include '../app/views/auth/login.php';
        include '../app/views/template/footer.php';
    }

    public function showRegisterForm()
    {
        // Tampilkan halaman register sebagai halaman default
        $judul = 'Register';
        include '../app/views/template/header.php';
        include '../app/views/auth/register.php';
        include '../app/views/template/footer.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel(); // Membuat instance UserModel

            $user = $userModel->login($_POST['username'], $_POST['password']);
            var_dump($user);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user['username'];
                $_SESSION['role'] = $user['role_name']; // Menyimpan role di session
                // Redirect berdasarkan role
                if ($_SESSION['role'] === 'Admin') {
                    header('Location: ' . BASE_URL . 'admin/dashboard'); // Arahkan ke halaman dashboard admin
                } elseif ($_SESSION['role'] === 'Mahasiswa') {
                    header('Location: ' . BASE_URL . 'mahasiswa/dashboard'); // Arahkan ke halaman dashboard mahasiswa
                } else {
                    echo "Role tidak valid.";
                }
                exit();
            } else {
                echo "Username atau password salah.";
            }
        } else {
            AuthController::index(); // Menampilkan halaman login
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input (pastikan username dan password tidak kosong)
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $role = $_POST['role_id']; // Pastikan ada mekanisme pemilihan role (misalnya dropdown)

            if (empty($username) || empty($password) || empty($role)) {
                // Jika ada data yang kosong
                echo "Semua field harus diisi.";
                return;
            }

            // Cek apakah username sudah ada di database
            $userModel = new UserModel();
            if ($userModel->isUsernameExists($username)) {
                echo "Username sudah terdaftar.";
                return;
            }

            // Hash password sebelum menyimpannya
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data pengguna baru ke database
            $userData = [
                'username' => $username,
                'password' => $hashedPassword,
                'role_id' => $role
            ];

            $isRegistered = $userModel->register($userData);

            if ($isRegistered) {
                // Jika registrasi sukses, redirect ke halaman login
                header('Location: ' . BASE_URL . 'auth/login');
                exit();
            } else {
                // Jika gagal menyimpan ke database
                echo "Terjadi kesalahan saat registrasi. Coba lagi.";
            } var_dump($isRegistered);
        } else {
            // Jika bukan request POST, tampilkan halaman registrasi
            AuthController::showRegisterForm(); // Bisa menampilkan form registrasi
        }
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'auth/login'); // Arahkan kembali ke halaman login setelah logout
        exit();
    }
}
