<?php

require_once '../app/models/UserModel.php'; // Memuat model

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        // Tampilkan halaman mahasiswa sebagai halaman default
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_mahasiswa.php';
        include '../app/views/mahasiswa/dashboard.php';
        include '../app/views/template/footer.php';
    }


    public function profile()
    {
        // Pastikan user sudah login dan username ada di session
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        // Ambil data Mahasiswa berdasarkan username
        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();
        $dataMhs = $mahasiswaModel->readDataMahasiswaByUsername($_SESSION['user']);
        // Pastikan data Mahasiswa ada
        if (empty($dataMhs)) {
            // Jika data tidak ditemukan, arahkan ke halaman error
            echo "Mahasiswa data not found!";
            exit;
        }

        // Kirim data Mahasiswa ke view
        $judul = 'Profile';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_mahasiswa.php';
        include '../app/views/mahasiswa/profile.php';  // Ganti dengan path view yang sesuai
        include '../app/views/template/footer.php';
    }

    public function kompetisi()
    {
        // Kirim data kompetisi ke view
        $judul = 'Kompetisi';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_mahasiswa.php';
        include '../app/views/mahasiswa/kompetisi.php'; // Ganti dengan path view yang sesuai
        include '../app/views/template/footer.php';
    }

    public function setting()
    {
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_mahasiswa.php';
        include '../app/views/mahasiswa/setting.php';
        include '../app/views/template/footer.php';
    }

    public function help()
    {
        $judul = 'Mahasiswa';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_mahasiswa.php';
        include '../app/views/mahasiswa/help.php';
        include '../app/views/template/footer.php';
    }
    public function getKompetisiData()
    {
        // Pastikan user sudah login dan username ada di session
        if (!isset($_SESSION['user'])) {
            echo json_encode(['error' => 'User not logged in']);
            exit;
        }

        // Ambil data kompetisi berdasarkan username
        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();
        $dataKompetisi = $mahasiswaModel->readKompetisiByUsername($_SESSION['user']);

        // Kirim data kompetisi ke view
        echo json_encode($dataKompetisi);
        exit;
    }
}
