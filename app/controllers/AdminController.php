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
        // Pastikan user sudah login dan username ada di session
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        // Ambil data admin berdasarkan username
        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();
        $dataAdmin = $adminModel->readDataAdminByUsername($_SESSION['user']);

        // Pastikan data admin ada
        if (empty($dataAdmin)) {
            // Jika data tidak ditemukan, arahkan ke halaman error
            echo "Admin data not found!";
            exit;
        }

        // Kirim data admin ke view
        $judul = 'Profile';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_admin.php';
        include '../app/views/admin/profile.php';  // Ganti dengan path view yang sesuai
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

    public function loadKompetisiAjax()
    {
        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();

        // Ambil parameter dari request
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $limit = 7; // Jumlah data per halaman
        $offset = ($page - 1) * $limit;

        // Ambil data kompetisi dan total
        $dataAllKompetisi = $adminModel->readKompetisiPaginated($limit, $offset);
        $totalKompetisi = $adminModel->getTotalKompetisiCount();
        $totalPages = ceil($totalKompetisi / $limit);

        // Kirim data sebagai JSON
        header('Content-Type: application/json');
        echo json_encode([
            'data' => $dataAllKompetisi,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }

    public function getDataAdmin()
    {
        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();
        // Ambil data admin
        $dataAdmin = $adminModel->readDataAdminByUsername($_SESSION['user']);

        // Kirim data sebagai JSON
        echo json_encode($dataAdmin);
    }

    public function getKompetisiCounts()
    {
        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();

        return [
            'totalKompetisi' => $adminModel->getTotalKompetisiCount(),
            'kompetisiProses' => $adminModel->getKompetisiProsesCount(),
            'kompetisiBerhasil' => $adminModel->getKompetisiBerhasilCount(),
            'kompetisiGagal' => $adminModel->getKompetisiGagalCount(),
        ];
    }
}
