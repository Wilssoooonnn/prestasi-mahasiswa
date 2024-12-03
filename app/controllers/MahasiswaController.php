<?php

require_once '../app/models/UserModel.php'; // Memuat model

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/sidebar_mahasiswa.php';    
        include '../app/views/mahasiswa/dashboard.php';
        include '../app/views/template/footer.php';
    }
}
