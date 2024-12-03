<?php
// app/models/UserModel.php

require_once '../config/Database.php'; // Memuat file Database.php

class UserModel
{
    private $db;

    public function __construct()
    {
        // Membuat koneksi ke database
        $this->db = (new Database())->connect();
    }

    // Fungsi untuk login dan mengambil data pengguna berdasarkan username
    public function login($username, $password)
    {
        // Menyiapkan query SQL untuk mengambil data user
        $query = "
            SELECT u.username, u.password, r.role_name 
            FROM users u
            JOIN roles r ON u.role_id = r.id
            WHERE u.username = ?";  // Menggunakan parameterized query untuk menghindari SQL Injection

        // Menyiapkan dan menjalankan query
        $stmt = sqlsrv_prepare($this->db, $query, [$username]);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Debug jika terjadi error pada query
        }

        // Menjalankan query
        if (sqlsrv_execute($stmt) === false) {
            die(print_r(sqlsrv_errors(), true)); // Debug jika terjadi error saat eksekusi
        }

        // Mengambil hasil query
        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Kembalikan data pengguna dan role-nya
        }

        return null; // Pengguna tidak ditemukan atau password salah
    }

    public function register($username, $hashedPassword, $role_id)
    {
        $query = "INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)";
        $stmt = sqlsrv_prepare($this->db, $query, [$username, $hashedPassword, $role_id]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return sqlsrv_execute($stmt); // Kembalikan true jika berhasil
    }

    public function isUsernameExists($username)
    {
        $query = "SELECT username FROM users WHERE username = ?";
        $stmt = sqlsrv_prepare($this->db, $query, [$username]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_execute($stmt);
        return sqlsrv_fetch_array($stmt) !== false; // Kembalikan true jika username ada
    }
}