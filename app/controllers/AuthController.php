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

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel(); // Membuat instance UserModel

            $user = $userModel->login($_POST['username'], $_POST['password']);
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
            // Validasi input
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role_id = $_POST['role_id'] ?? '';

            if (empty($username) || empty($password) || empty($role_id)) {
                echo "All fields are required.";
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Memuat model
            require_once '../app/models/UserModel.php';
            $userModel = new UserModel();

            // Cek apakah username sudah ada
            if ($userModel->isUsernameExists($username)) {
                echo "Username already exists.";
            }

            // Simpan pengguna baru ke database
            $result = $userModel->register($username, $hashedPassword, $role_id);

            if ($result) {
                echo "Registration successful.";
                header('Location: ' . BASE_URL . 'auth/login');
                exit();
            } else {
                echo "Registration failed. Please try again.";
            }
        } else {
            // Jika bukan POST, tampilkan form register
            include '../app/views/template/header.php';
            include '../app/views/auth/register.php';
            include '../app/views/template/footer.php';
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
