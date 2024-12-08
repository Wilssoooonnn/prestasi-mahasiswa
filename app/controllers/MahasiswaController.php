<?php

require_once '../app/models/UserModel.php'; // Memuat model
require_once '../app/models/MahasiswaModel.php';

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
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        $mahasiswaModel = new MahasiswaModel();

        // Ambil parameter page dari URL
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Jumlah data per halaman
        $offset = ($page - 1) * $limit;

        // Ambil data kompetisi dengan paginasi
        $dataKompetisi = $mahasiswaModel->readKompetisiPaginated($_SESSION['user'], $offset, $limit);

        // Hitung total data
        $totalData = $mahasiswaModel->countKompetisiByUsername($_SESSION['user']);
        $totalPages = ceil($totalData / $limit);

        // Kirim data ke view
        $judul = 'Kompetisi';
        include '../app/views/template/header.php';
        include '../app/views/template/navigation_mahasiswa.php';
        include '../app/views/mahasiswa/kompetisi.php';
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
        $mahasiswaModel = new MahasiswaModel();
        $dataKompetisi = $mahasiswaModel->readKompetisiByUsername($_SESSION['user']);

        // Kirim data kompetisi ke view
        echo json_encode($dataKompetisi);
        exit;
    }

    public function profileUpdate()
    {
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

    public function insertKompetisi()
    {
        $mahasiswaModel = new MahasiswaModel();
        try {
            // Proses data yang diterima dari POST
            $data = [
                'jenis_id' => isset($_POST['jenis_id']) ? $_POST['jenis_id'] : null,
                'tingkat_id' => isset($_POST['tingkat_id']) ? $_POST['tingkat_id'] : null,
                'nama_kompetisi' => isset($_POST['nama_kompetisi']) ? $_POST['nama_kompetisi'] : null,
                'tempat_kompetisi' => isset($_POST['tempat_kompetisi']) ? $_POST['tempat_kompetisi'] : null,
                'url_kompetisi' => isset($_POST['url_kompetisi']) ? $_POST['url_kompetisi'] : null,
                'tanggal_mulai' => isset($_POST['tanggal_mulai']) ? $_POST['tanggal_mulai'] : null,
                'tanggal_akhir' => isset($_POST['tanggal_akhir']) ? $_POST['tanggal_akhir'] : null,
                'no_surat_tugas' => isset($_POST['no_surat_tugas']) ? $_POST['no_surat_tugas'] : null,
                'tanggal_surat_tugas' => isset($_POST['tanggal_surat_tugas']) ? $_POST['tanggal_surat_tugas'] : null,
                'file_surat_tugas' => isset($_FILES['file_surat_tugas']) ? $_FILES['file_surat_tugas']['name'] : null,
                'file_sertifikat' => isset($_FILES['file_sertifikat']) ? $_FILES['file_sertifikat']['name'] : null,
                'foto_kegiatan' => isset($_FILES['foto_kegiatan']) ? $_FILES['foto_kegiatan']['name'] : null,
                'file_poster' => isset($_FILES['file_poster']) ? $_FILES['file_poster']['name'] : null,
                // Data mahasiswa
                'nim' => $_POST['nim'],
                'full_name' => $_POST['full_name'],
                'alamat' => $_POST['alamat'],
                'no_telp' => $_POST['no_telp'],
                'email' => $_POST['email']
            ];
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            // Memasukkan data ke dalam model
            $result = $mahasiswaModel->insertKompetisi($data);
            if ($result['success']) {
                echo json_encode(['success' => true, 'message' => $result['message']]);
            } else {
                echo json_encode(['success' => false, 'message' => $result['message']]);
            }
        } catch (Exception $e) {
            // Tangani error jika terjadi masalah
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
