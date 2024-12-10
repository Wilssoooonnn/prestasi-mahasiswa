<?php

require_once '../app/models/UserModel.php'; // Memuat model

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Dashboard | Mahasiswa']);
        $view->view('template/navigation_mahasiswa');
        include '../app/views/mahasiswa/dashboard.php';
        $view->view('template/footer');
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
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Profile | Mahasiswa']);
        $view->view('template/navigation_mahasiswa');
        include '../app/views/mahasiswa/profile.php';
        $view->view('template/footer');
    }

    public function kompetisi()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        require_once '../app/models/MahasiswaModel.php';
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
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Kompetisi | Mahasiswa']);
        $view->view('template/navigation_mahasiswa');
        include '../app/views/mahasiswa/kompetisi.php';
        $view->view('template/footer');
    }

    public function help()
    {
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Help | Mahasiswa']);
        $view->view('template/navigation_mahasiswa');
        include '../app/views/mahasiswa/help.php';
        $view->view('template/footer');
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
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        $data = [
            'username' => $_SESSION['user'],
            'fullName' => $_POST['fullName'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email']
        ];

        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();
        $result = $mahasiswaModel->editProfileMahasiswa($data);

        if ($result) {
            header('Location: profile');
        } else {
            echo "Update failed!";
        }
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

    public function getKompetisiCounts_Mhs()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();

        return [
            'totalKompetisi' => $mahasiswaModel->getTotalKompetisiCount_Mhs($_SESSION['user']),
            'kompetisiProses' => $mahasiswaModel->getKompetisiProsesCount_Mhs($_SESSION['user']),
            'kompetisiBerhasil' => $mahasiswaModel->getKompetisiBerhasilCount_Mhs($_SESSION['user']),
            'kompetisiGagal' => $mahasiswaModel->getKompetisiGagalCount_Mhs($_SESSION['user']),
        ];
    }

    public function insertKompetisi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Direktori upload
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/prestasi-mahasiswa/uploads/';

            // Validasi input
            if (empty($_POST['jenis_id']) || empty($_POST['tingkat_id'])) {
                echo json_encode(['success' => false, 'message' => 'Jenis Kompetisi dan Tingkat Kompetisi harus diisi.']);
                exit;
            }

            // Pastikan direktori upload ada dan bisa ditulis
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Data input
            $data = [
                'username' => $_SESSION['user'], // Pastikan session user valid
                'jenis_id' => $_POST['jenis_id'],
                'tingkat_id' => $_POST['tingkat_id'],
                'nama_kompetisi' => $_POST['nama_kompetisi'],
                'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                'tanggal_mulai' => $_POST['tanggal_mulai'],
                'tanggal_akhir' => $_POST['tanggal_akhir'],
                'no_surat_tugas' => $_POST['no_surat_tugas'],
                'tanggal_surat_tugas' => $_POST['tanggal_surat_tugas'],
                'url_kompetisi' => $_POST['url_kompetisi'],
                'file_surat_tugas' => null,
                'file_sertifikat' => null,
                'foto_kegiatan' => null,
                'file_poster' => null,
                'dosen_id' => $_POST['dosen_id']
            ];

            // Handle file uploads
            $files = [
                'file_surat_tugas',
                'file_sertifikat',
                'foto_kegiatan',
                'file_poster'
            ];

            foreach ($files as $file) {
                if (isset($_FILES[$file]) && $_FILES[$file]['error'] === UPLOAD_ERR_OK) {
                    $tmpName = $_FILES[$file]['tmp_name'];
                    $fileName = uniqid() . '_' . basename($_FILES[$file]['name']); // Generate unique file name
                    $destination = $uploadDir . $fileName;

                    if (move_uploaded_file($tmpName, $destination)) {
                        $data[$file] = $fileName; // Save file name to the data array
                    } else {
                        echo json_encode(['success' => false, 'message' => "Error saat mengupload file $file."]);
                        exit;
                    }
                }
            }

            // Simpan data ke database
            try {
                require_once '../app/models/MahasiswaModel.php';
                $mahasiswaModel = new MahasiswaModel(); // Instantiate the model
                $mahasiswaModel->insertKompetisi($data); // Call the method
                echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan!']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error saat menyimpan data: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}
