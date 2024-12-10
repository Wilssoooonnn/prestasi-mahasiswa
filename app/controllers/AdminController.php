<?php

require_once '../app/models/UserModel.php'; // Memuat model

class AdminController extends Controller
{
    public function dashboard()
    {
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Dashboard | Admin']);
        $view->view('template/navigation_admin');
        include '../app/views/admin/dashboard.php';
        $view->view('template/footer');
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
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Profile | Admin']);
        $view->view('template/navigation_admin');
        include '../app/views/admin/profile.php';
        $view->view('template/footer');
    }

    public function kompetisi()
    {
        // Tampilkan halaman admin sebagai halaman default
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Kompetisi | Admin']);
        $view->view('template/navigation_admin');
        include '../app/views/admin/kompetisi.php';
        $view->view('template/footer');
    }
    public function help()
    {
        $view = new Controller();
        $view->view('template/header', ['judul' => 'Help | Admin']);
        $view->view('template/navigation_admin');
        include '../app/views/admin/help.php';
        $view->view('template/footer');
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

    public function profileUpdate()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        $data = [
            'username' => $_SESSION['user'],
            'fullName' => $_POST['fullName'],
            'email' => $_POST['email'],
            'no_telp' => $_POST['telp'],
            'alamat' => $_POST['alamat'],
            'newUsername' => $_POST['newusername']
        ];

        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();
        $result = $adminModel->editProfileAdmin($data);

        if ($result) {
            $_SESSION['user'] = $data['newUsername'];
            header('Location: profile');
        } else {
            echo "Update failed!";
        }
    }

    public function changePassword()
    {
        require_once '../app/models/AdminModel.php';

        $hashedPassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
        $data = [
            'user' => $_POST['user'],
            'newPassword' => $hashedPassword
        ];

        $adminModel = new AdminModel();

        // Mengecek apakah pengguna ada di database
        $user = $adminModel->getUserByUsername($_SESSION['user']);

        if ($user) {
            // Verify the password
            if (password_verify($_POST['password'], $user['password'])) {
                if ($_POST['newpassword'] == $_POST['renewpassword']) {
                    $adminModel->updatePassword($data);
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

    function getKompetisiDetail($nim, $kompetisiId)
    {
        // Load the model that contains the detailKompetisi method
        require_once '../app/models/AdminModel.php';
        $AdminModel = new AdminModel();

        $dataMhs = $AdminModel->GetDataKompetisi($nim, $kompetisiId);

        // Pastikan data Mahasiswa ada
        if (empty($dataMhs)) {
            // Jika data tidak ditemukan, arahkan ke halaman error
            echo "Mahasiswa data not found!";
            exit;
        }
        // kirim data sebagai JSON
        echo json_encode($dataMhs);
    }
    public function insertKompetisi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input
            if (empty($_POST['jenis_id']) || empty($_POST['tingkat_id'])) {
                die('Jenis Kompetisi dan Tingkat Kompetisi harus diisi.');
            }

            $data = [
                'username' => $_SESSION['user'], // Pastikan session user valid
                'jenis_id' => $_POST['jenis_id'],
                'tingkat_id' => $_POST['tingkat_id'],
                'nama_kompetisi' => $_POST['nama_kompetisi'],
                'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                'url_kompetisi' => $_POST['url_kompetisi'],
                'tanggal_mulai' => $_POST['tanggal_mulai'],
                'tanggal_akhir' => $_POST['tanggal_akhir'],
                'no_surat_tugas' => $_POST['no_surat_tugas'],
                'tanggal_surat_tugas' => $_POST['tanggal_surat_tugas'],
                'file_surat_tugas' => $_FILES['file_surat_tugas']['name'],
                'file_sertifikat' => $_FILES['file_sertifikat']['name'],
                'foto_kegiatan' => $_FILES['foto_kegiatan']['name'],
                'file_poster' => $_FILES['file_poster']['name'],
                'dosen_id' => $_POST['dosen_id'],
            ];

            // Upload files
            $uploadDir = '../uploads/';
            if (
                !move_uploaded_file($_FILES['file_surat_tugas']['tmp_name'], $uploadDir . $data['file_surat_tugas']) ||
                !move_uploaded_file($_FILES['file_sertifikat']['tmp_name'], $uploadDir . $data['file_sertifikat']) ||
                !move_uploaded_file($_FILES['foto_kegiatan']['tmp_name'], $uploadDir . $data['foto_kegiatan']) ||
                !move_uploaded_file($_FILES['file_poster']['tmp_name'], $uploadDir . $data['file_poster'])
            ) {
                die('Error saat mengunggah file.');
            }

            try {
                // Eksekusi stored procedure
                $adminModel = new AdminModel();
                $adminModel->insertKompetisi($data);

                // Redirect setelah sukses
                header('Location: /kompetisi?success=1');
                exit;
            } catch (Exception $e) {
                die('Error inserting kompetisi: ' . $e->getMessage());
            }
        } else {
            echo "<script>";
            echo "alert('Gagal!');";
            echo "</script>";
        }
    }

    public function approveKompetisi($kompetisiId)
    {
        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();

        $data = $adminModel->ApproveKompetisi($kompetisiId);

        header('Content-Type: application/json'); // Pastikan header JSON dikirimkan
        if ($data) {
            echo json_encode([
                'success' => true,
                'message' => 'Data berhasil diupdate.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate data.'
            ]);
        }
        exit; // Hentikan eksekusi setelah output
    }

    public function declineKompetisi($kompetisiId)
    {
        require_once '../app/models/AdminModel.php';
        $adminModel = new AdminModel();

        $data = $adminModel->DeclineKompetisi($kompetisiId);

        header('Content-Type: application/json'); // Pastikan header JSON dikirimkan
        if ($data) {
            echo json_encode([
                'success' => true,
                'message' => 'Data berhasil diupdate.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate data.'
            ]);
        }
        exit; // Hentikan eksekusi setelah output
    }
}
