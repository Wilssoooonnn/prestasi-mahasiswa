<?php
require_once '../config/Database.php';

class AdminModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    private function logError($message)
    {
        error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, '../logs/error.log');
    }

    private function executeStoredProcedure($procedure, $params = [])
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        $query = "{CALL $procedure($placeholders)}";
        $stmt = sqlsrv_prepare($this->db, $query, $params);

        if (!$stmt) {
            $this->logError(print_r(sqlsrv_errors(), true));
            throw new Exception("Error preparing stored procedure: " . $procedure);
        }

        if (!sqlsrv_execute($stmt)) {
            $this->logError(print_r(sqlsrv_errors(), true));
            throw new Exception("Error executing stored procedure: " . $procedure);
        }

        return $stmt;
    }

    public function readAllKompetisi()
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisiAllPaginated");
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function readKompetisiPaginated($limit, $offset)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisiAllPaginated", [$limit, $offset]);
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function readDataAdminByUsername($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetAdminDataByUsername", [$username]);
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;
            }
            if (empty($result)) {  // Debugging
                echo "No data returned from database.";
            }
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }


    public function getTotalKompetisiCount()
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisi_Count");
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['total'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getKompetisiProsesCount()
    {
        try {
            $stmt = $this->executeStoredProcedure("CountKompetisi_Proses");
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['JumlahKompetisi'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getKompetisiBerhasilCount()
    {
        try {
            $stmt = $this->executeStoredProcedure("CountKompetisi_Berhasil");
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['JumlahKompetisi'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getKompetisiGagalCount()
    {
        try {
            $stmt = $this->executeStoredProcedure("CountKompetisi_Gagal");
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['JumlahKompetisi'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }


    public function detailKompetisi($id)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisiById", [$id]);
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function editProfileAdmin($data)
    {
        try {
            $stmt = $this->executeStoredProcedure("EditProfileAdmin", [
                $data['username'],
                $data['fullName'],
                $data['email'],
                $data['no_telp'],
                $data['alamat'],
                $data['newUsername']
            ]);

            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        try {
            // Execute the stored procedure
            $stmt = $this->executeStoredProcedure("GetUserByUsername", [$username]);
            if ($stmt) {
                $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                // Cek jika data ditemukan
                if ($user) {
                    return $user;
                } else {
                    // Jika tidak ada data yang ditemukan
                    return null;
                }
            } else {
                throw new Exception("Query execution failed.");
            }
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }
    }

    public function GetDataKompetisi($nim, $kompetisiId)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetDataKompetisiByNim", [$nim, $kompetisiId]);
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function updatePassword($data)
    {
        $query = "UPDATE users 
                    SET password = ? WHERE username = ?";
        $params = [
            $data['newPassword'],
            $data['user']
        ];
        sqlsrv_query($this->db, $query, $params);
    }

    public function insertKompetisi($data)
    {
        try {
            // Prepare the parameters for the stored procedure
            $params = [
                [&$data['username'], SQLSRV_PARAM_IN],
                [&$data['jenis_id'], SQLSRV_PARAM_IN],
                [&$data['tingkat_id'], SQLSRV_PARAM_IN],
                [&$data['nama_kompetisi'], SQLSRV_PARAM_IN],
                [&$data['tempat_kompetisi'], SQLSRV_PARAM_IN],
                [&$data['url_kompetisi'], SQLSRV_PARAM_IN],
                [&$data['tanggal_mulai'], SQLSRV_PARAM_IN],
                [&$data['tanggal_akhir'], SQLSRV_PARAM_IN],
                [&$data['no_surat_tugas'], SQLSRV_PARAM_IN],
                [&$data['tanggal_surat_tugas'], SQLSRV_PARAM_IN],
                [&$data['file_surat_tugas'], SQLSRV_PARAM_IN],
                [&$data['file_sertifikat'], SQLSRV_PARAM_IN],
                [&$data['foto_kegiatan'], SQLSRV_PARAM_IN],
                [&$data['file_poster'], SQLSRV_PARAM_IN],
                [&$data['dosen_id'], SQLSRV_PARAM_IN],
            ];

            // Execute the stored procedure
            $stmt = $this->executeStoredProcedure("InsertKompetisi_Mhs", $params);

            // If successful, return a success message
            return "Data kompetisi, dosen, dan mahasiswa berhasil ditambahkan.";
        } catch (Exception $e) {
            // Log and rethrow the error
            $this->logError($e->getMessage());
            throw new Exception("Failed to insert kompetisi data: " . $e->getMessage());
        }
    }

    function getDataDosen()
    {
        try {
            $stmt = $this->executeStoredProcedure("GetDataDosen");
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    function ApproveKompetisi($kompetisiId)
    {
        try {
            // Memastikan ID kompetisi valid sebelum menjalankan stored procedure
            if (empty($kompetisiId) || !is_numeric($kompetisiId)) {
                throw new Exception('ID Kompetisi tidak valid.');
            }

            // Menjalankan prosedur tersimpan untuk menyetujui kompetisi
            $stmt = $this->executeStoredProcedure("SetStatus_Berhasil", [$kompetisiId]);

            // Verifikasi apakah query berhasil
            if ($stmt) {
                return true;
            } else {
                throw new Exception('Proses approve kompetisi gagal.');
            }
        } catch (Exception $e) {
            // Menangani dan mencatat error dengan pesan yang lebih jelas
            $this->logError("Error di ApproveKompetisi: " . $e->getMessage());
            return false;
        }
    }

    function DeclineKompetisi($kompetisiId)
    {
        try {
            // Memastikan ID kompetisi valid sebelum menjalankan stored procedure
            if (empty($kompetisiId) || !is_numeric($kompetisiId)) {
                throw new Exception('ID Kompetisi tidak valid.');
            }

            // Menjalankan prosedur tersimpan untuk menyetujui kompetisi
            $stmt = $this->executeStoredProcedure("SetStatus_Gagal", [$kompetisiId]);

            // Verifikasi apakah query berhasil
            if ($stmt) {
                return true;
            } else {
                throw new Exception('Proses decline kompetisi gagal.');
            }
        } catch (Exception $e) {
            // Menangani dan mencatat error dengan pesan yang lebih jelas
            $this->logError("Error di DeclineKompetisi: " . $e->getMessage());
            return false;
        }
    }
}
