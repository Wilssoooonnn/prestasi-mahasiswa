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

    //fungsi top 3 leaderboard
    public function getLeaderboard()
    {
        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();
        // echo "<pre>";
        // var_dump($mahasiswaModel->getLeaderboard());
        return $mahasiswaModel->getLeaderboard();
    }

    //fungsi leaderboard
    public function getLeaderboardOffset()
    {
        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();
        // echo "<pre>";
        // var_dump($mahasiswaModel->getLeaderboard());
        return $mahasiswaModel->getLeaderboardOffset();
    }

    public function updateKompetisi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/prestasi-mahasiswa/uploads/';

            // Validasi input wajib
            $requiredFields = ['jenis_id', 'tingkat_id', 'id_kompetisi', 'nama_kompetisi'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    echo json_encode(['success' => false, 'message' => "Field $field harus diisi."]);
                    exit;
                }
            }

            // Pastikan folder upload ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $data = [
                'jenis_id' => htmlspecialchars($_POST['jenis_id']),
                'tingkat_id' => htmlspecialchars($_POST['tingkat_id']),
                'nama_kompetisi' => htmlspecialchars($_POST['nama_kompetisi']),
                'tempat_kompetisi' => htmlspecialchars($_POST['tempat_kompetisi']),
                'tanggal_mulai' => $_POST['tanggal_mulai'],
                'tanggal_akhir' => $_POST['tanggal_akhir'],
                'no_surat_tugas' => htmlspecialchars($_POST['no_surat_tugas']),
                'tanggal_surat_tugas' => $_POST['tanggal_surat_tugas'],
                'url_kompetisi' => htmlspecialchars($_POST['url_kompetisi']),
                'dosen_id' => htmlspecialchars($_POST['dosen_id']),
                'id_kompetisi' => htmlspecialchars($_POST['id_kompetisi']),
            ];

            // Pemrosesan file
            $fileKeys = ['file_surat_tugas', 'file_sertifikat', 'foto_kegiatan', 'file_poster'];
            foreach ($fileKeys as $key) {
                if (isset($_FILES[$key . '_new']) && $_FILES[$key . '_new']['error'] === UPLOAD_ERR_OK) {
                    $tmpName = $_FILES[$key . '_new']['tmp_name'];
                    $fileName = uniqid() . '_' . basename($_FILES[$key . '_new']['name']);
                    $destination = $uploadDir . $fileName;

                    if (move_uploaded_file($tmpName, $destination)) {
                        // Hapus file lama jika ada
                        if (isset($_POST[$key . '_old']) && file_exists($uploadDir . $_POST[$key . '_old'])) {
                            unlink($uploadDir . $_POST[$key . '_old']);
                        }
                        $data[$key] = $fileName;
                    } else {
                        echo json_encode(['success' => false, 'message' => "Gagal mengupload file $key."]);
                        exit;
                    }
                } elseif (isset($_POST[$key . '_old'])) {
                    $data[$key] = $_POST[$key . '_old'];
                } else {
                    $data[$key] = null;
                }
            }

            // Simpan data ke database
            try {
                require_once '../app/models/MahasiswaModel.php';
                $mahasiswaModel = new MahasiswaModel();
                $mahasiswaModel->updateKompetisi($data);
                echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui!']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error saat menyimpan data: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }


    public function loadKompetisiAjax()
    {
        require_once '../app/models/MahasiswaModel.php';
        $mahasiswaModel = new MahasiswaModel();

        $username = $_SESSION['user'];
        // Ambil parameter dari request
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $limit = 7; // Jumlah data per halaman
        $offset = ($page - 1) * $limit;

        // Ambil data kompetisi dan total
        $dataAllKompetisi = $mahasiswaModel->readKompetisiPaginated($username,  $offset, $limit);
        $totalKompetisi = $mahasiswaModel->countKompetisiByUsername($username);
        $totalPages = ceil($totalKompetisi / $limit);

        // Kirim data sebagai JSON
        header('Content-Type: application/json');
        echo json_encode([
            'data' => $dataAllKompetisi,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }
}
