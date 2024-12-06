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
}
