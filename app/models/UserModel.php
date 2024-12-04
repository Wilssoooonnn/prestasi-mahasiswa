<?php
// app/models/UserModel.php

require_once '../config/Database.php'; // Memuat file Database.php

class UserModel
{
    private $db;

    public function __construct()
    {
        // Membuat koneksi ke database
        $this->db = (new Database())->connect();
    }


    private function logError($message)
    {
        error_log($message, 3, '../logs/error.log');
    }

    private function executeStoredProcedure($procedure, $params = [])
    {
        $query = "{CALL $procedure}";
        $stmt = sqlsrv_prepare($this->db, $query, $params);

        if (!$stmt) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        if (!sqlsrv_execute($stmt)) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        return $stmt;
    }


    // Fungsi untuk login dan mengambil data pengguna berdasarkan username
    public function login($username, $password)
    {
        try {
            $stmt = $this->executeStoredProcedure("GetUserByUsername(?)", [$username]);
            $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return null;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }   
    }

    public function register($username, $password, $role_id)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->executeStoredProcedure("RegisterUser(?, ?, ?)", [$username, $hashedPassword, $role_id]);
            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function isUsernameExists($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("CheckUsernameExists(?)", [$username]);
            return sqlsrv_fetch_array($stmt) !== false;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }
}
