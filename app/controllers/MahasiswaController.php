<?php

require_once '../app/models/UserModel.php'; // Memuat model

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        // Tampilkan halaman mahasiswa sebagai halaman default
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/sidebar_mahasiswa.php';    
        include '../app/views/mahasiswa/dashboard.php';
        include '../app/views/template/footer.php';
    }

    public function home(){
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/sidebar.php';
        include '../app/views/mahasiswa/home.php';
        include '../app/views/template/footer.php';
    }

    public function profile(){
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/sidebar.php';
        include '../app/views/mahasiswa/profile.php';
        include '../app/views/template/footer.php';
    }
}
