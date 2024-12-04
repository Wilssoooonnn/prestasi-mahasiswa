<?php

require_once '../app/models/UserModel.php'; // Memuat model

class AdminController extends Controller
{
    public function dashboard()
    {
        // Tampilkan halaman admin sebagai halaman default
        $judul = 'Admin';
        include '../app/views/template/header.php';
        include '../app/views/template/sidebar_admin.php';
        include '../app/views/admin/dashboard.php';
        include '../app/views/template/footer.php';
    }
}
