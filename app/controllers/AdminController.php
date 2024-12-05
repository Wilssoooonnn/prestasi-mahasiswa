<?php

require_once '../app/models/UserModel.php'; // Memuat model

class AdminController
{
    public function dashboard()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Admin';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_admin.php';
        include '../app/views/admin/dashboard.php';
        include '../app/views/template/footer.php';
    }

    public function profile()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Profile';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_admin.php';
        include '../app/views/admin/profile.php';
        include '../app/views/template/footer.php';
    }
    public function kompetisi()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Kompetisi';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_admin.php';
        include '../app/views/admin/kompetisi.php';
        include '../app/views/template/footer.php';
    }
    public function help()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Help';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_admin.php';
        include '../app/views/admin/help.php';
        include '../app/views/template/footer.php';
    }

    public function setting()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Setting';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_admin.php';
        include '../app/views/admin/setting.php';
        include '../app/views/template/footer.php';
    }
    public function tes()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'TES';
        include '../app/views/template/header.php';
        include '../app/views/admin/tes.php';
        include '../app/views/template/footer.php';
    }
}
