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

    public function readAllKompetisi($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetKompetisi_All");
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
            $stmt = $this->executeStoredProcedure("GetKompetisi_All", [$limit, $offset]);
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
            // Memanggil prosedur EditProfileAdmin untuk mengupdate data
            $stmt = $this->executeStoredProcedure("EditProfileAdmin", [
                $data['username'],
                $data['fullName'],
                $data['email'],
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
}
