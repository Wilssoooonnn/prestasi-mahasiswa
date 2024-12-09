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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validate required fields
                if (
                    empty($_POST['jenis_id']) || empty($_POST['tingkat_id']) || empty($_POST['nama_kompetisi']) ||
                    empty($_POST['tempat_kompetisi']) || empty($_POST['tanggal_mulai']) || empty($_POST['tanggal_akhir']) ||
                    empty($_POST['no_surat_tugas']) || empty($_POST['tanggal_surat_tugas']) || empty($_POST['nim']) ||
                    empty($_POST['full_name']) || empty($_POST['alamat']) || empty($_POST['no_telp']) || empty($_POST['email'])
                ) {
                    throw new Exception("Some required fields are missing.");
                }

                $data = [
                    'jenis_id' => $_POST['jenis_id'],
                    'tingkat_id' => $_POST['tingkat_id'],
                    'nama_kompetisi' => $_POST['nama_kompetisi'],
                    'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                    'url_kompetisi' => $_POST['url_kompetisi'],
                    'tanggal_mulai' => $_POST['tanggal_mulai'],
                    'tanggal_akhir' => $_POST['tanggal_akhir'],
                    'no_surat_tugas' => $_POST['no_surat_tugas'],
                    'tanggal_surat_tugas' => $_POST['tanggal_surat_tugas'],
                    'nim' => $_POST['nim'],
                    'full_name' => $_POST['full_name'],
                    'alamat' => $_POST['alamat'],
                    'no_telp' => $_POST['no_telp'],
                    'email' => $_POST['email']
                ];

                // Handle file uploads
                $uploadedFiles = $this->uploadFiles($_FILES);

                // Merge uploaded file paths with data
                $data = array_merge($data, $uploadedFiles);

                // Call model function to insert data into the database
                $mahasiswaModel = new MahasiswaModel();
                $result = $mahasiswaModel->insertKompetisi($data);

                if ($result['success']) {
                    // Redirect to the kompetisi list or success page
                    header('Location: /mahasiswa/kompetisi');
                    exit();
                } else {
                    echo $result['message'];
                }
            } catch (Exception $e) {
                echo "Terjadi kesalahan: " . $e->getMessage();
            }
        }
    }

    private function uploadFiles($files)
    {
        $uploadedFiles = [];
        $uploadDir = 'uploads/'; // Make sure this is writable

        foreach ($files as $fileKey => $file) {
            if (isset($file['name']) && $file['error'] === UPLOAD_ERR_OK) {
                $targetPath = $uploadDir . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $uploadedFiles[$fileKey] = $targetPath; // Store the file path
                } else {
                    throw new Exception("File upload failed for " . $file['name']);
                }
            } else {
                throw new Exception("File upload error: " . $file['name']);
            }
        }

        return $uploadedFiles; // Return paths of successfully uploaded files
    }
}
