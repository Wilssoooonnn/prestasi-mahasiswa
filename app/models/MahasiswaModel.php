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

    public function editProfile($data)
    {
        $query = "UPDATE mahasiswa 
                    SET nama = ?, alamat = ?, no_telp = ?, email = ? WHERE id = ?";
        $params = [
            $data['nama'],
            $data['alamat'],
            $data['no_telp'],
            $data['email'],
            $data['id']
        ];
        sqlsrv_query($this->db, $query, $params);
    }
}
