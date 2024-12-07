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

    public function profileUpdate()
    {
        require_once '../app/models/MahasiswaModel.php';
        $data = [
            'id' => $_POST['id'],
            'nama' => $_POST['fullName'],
            'alamat' => $_POST['address'],
            'no_telp' => $_POST['phone'],
            'email' => $_POST['email']
        ];

        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->editProfile($data);

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil diupdate.'
        ]);
        header("Location: profile");
        exit;
    }

    public function changePassword()
    {
        require_once '../app/models/MahasiswaModel.php';

        $hashedPassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
        $data = [
            'user' => $_POST['user'],
            'newPassword' => $hashedPassword
        ];

        $mahasiswaModel = new MahasiswaModel();

        // Mengecek apakah pengguna ada di database
        $user = $mahasiswaModel->getUserByUsername($_SESSION['user']);

        if ($user) {
            // Verify the password
            if (password_verify($_POST['password'], $user['password'])) {
                if ($_POST['newpassword'] == $_POST['renewpassword']) {
                    $mahasiswaModel->updatePassword($data);
                } else {
                    echo "Password yang Anda Masukkan Tidak Sama";
                    return;
                }
            } else {
                echo "Password yang Anda Masukkan Salah";
                return;
            }
        }

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil diupdate.'
        ]);
        header("Location: profile");
        exit;
    }
}
