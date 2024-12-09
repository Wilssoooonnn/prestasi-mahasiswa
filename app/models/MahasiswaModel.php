<?php
require_once '../config/Database.php';

class MahasiswaModel
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

    public function readKompetisiByNim($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisiByNim", [$username]);
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
    public function readDataMahasiswaByUsername($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetMahasiswaDataByUsername", [$username]);
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

    public function getNimByLogin($username)
    {
        try {
            // Declare a variable to hold the NIM
            $nim = 'nunll';

            // Execute the stored procedure
            $stmt = $this->executeStoredProcedure("GetNimByLogin", [$username, &$nim]);

            // Return the NIM
            return $nim;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }
    }

    public function readKompetisiByUsername($username)
    {
        try {
            // Get the NIM by the provided username
            $nim = $this->getNimByLogin($username);

            if ($nim) {
                // Now use the NIM to fetch the competition data
                $stmt = $this->executeStoredProcedure("GetKompetisiByNim", [$username]);
                $result = [];
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $result[] = $row;
                }
                return $result;
            } else {
                // Return a message if NIM is not found

                return [['Pesan' => 'Tidak Ada Data Prestasi']];
            }
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [['Pesan' => 'Error retrieving data']];
        }
    }

    public function editProfileMahasiswa($data)
    {
        try {
            // Memanggil prosedur EditProfileMahasiswa untuk mengupdate data
            $stmt = $this->executeStoredProcedure("EditProfileMahasiswa", [
                $data['username'],
                $data['fullName'],
                $data['address'],
                $data['phone'],
                $data['email']
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

    public function readKompetisiPaginated($username, $offset, $limit)
    {
        try {
            // Call the paginated stored procedure
            $stmt = $this->executeStoredProcedure("GetKompetisiByNimPaginated", [$username, $offset, $limit]);
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

    public function countKompetisiByUsername($username)
    {
        try {
            // Call the stored procedure to count data
            $stmt = $this->executeStoredProcedure("CountKompetisiByNim", [$username]);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row ? $row['Total'] : 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getTotalKompetisiCount_Mhs($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisi_CountMhs", [$username]);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['total'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getKompetisiProsesCount_Mhs($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("CountKompetisi_ProsesMhs", [$username]);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['JumlahKompetisi'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getKompetisiBerhasilCount_Mhs($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("CountKompetisi_BerhasilMhs", [$username]);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['JumlahKompetisi'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
    }

    public function getKompetisiGagalCount_Mhs($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("CountKompetisi_GagalMhs", [$username]);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['JumlahKompetisi'] ?? 0;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return 0;
        }
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
            return "Data kompetisi berhasil ditambahkan.";
        } catch (Exception $e) {
            // Log and rethrow the error
            $this->logError($e->getMessage());
            throw new Exception("Failed to insert kompetisi data: " . $e->getMessage());
        }
    }
}
