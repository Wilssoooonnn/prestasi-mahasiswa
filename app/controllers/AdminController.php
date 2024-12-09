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

    function getKompetisiDetail()
    {
        // Load the model that contains the detailKompetisi method
        require_once '../app/models/AdminModel.php';
        require_once '../app/models/MahasiswaModel.php';
        $adminModel = new AdminModel();
        $mahasiswaModel = new MahasiswaModel();

        $dataMhs = $mahasiswaModel->readDataMahasiswaByUsername('odin');

        // Pastikan data Mahasiswa ada
        if (empty($dataMhs)) {
            // Jika data tidak ditemukan, arahkan ke halaman error
            echo "Mahasiswa data not found!";
            exit;
        }

        echo "<pre>";
        print_r($dataMhs);
        echo "</pre>";
    }
    function insertKompetisi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form POST
            $data = [
                'username' => $_SESSION['user'], // Username dari sesi
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

            // Upload files ke direktori yang diinginkan
            $uploadDir = '../uploads/';
            move_uploaded_file($_FILES['file_surat_tugas']['tmp_name'], $uploadDir . $data['file_surat_tugas']);
            move_uploaded_file($_FILES['file_sertifikat']['tmp_name'], $uploadDir . $data['file_sertifikat']);
            move_uploaded_file($_FILES['foto_kegiatan']['tmp_name'], $uploadDir . $data['foto_kegiatan']);
            move_uploaded_file($_FILES['file_poster']['tmp_name'], $uploadDir . $data['file_poster']);

            try {
                // Eksekusi stored procedure melalui model
                $adminModel = new AdminModel();
                $adminModel->insertKompetisi($data);

                // Redirect atau tampilkan pesan sukses
                header('Location: /kompetisi?success=1');
                exit;
            } catch (Exception $e) {
                // Tangani error
                echo "Error inserting kompetisi: " . $e->getMessage();
            }
        } else {
            // Tampilkan halaman form
            include '../app/views/kompetisi/form.php';
        }
    }
}
