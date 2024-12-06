<?php

require_once '../config/database.php'; // Memuat file Database.php

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
            $error = "Preparation failed: " . print_r(sqlsrv_errors(), true);
            $this->logError($error);
            throw new Exception($error);
        }

        if (!sqlsrv_execute($stmt)) {
            $error = "Execution failed: " . print_r(sqlsrv_errors(), true);
            $this->logError($error);
            throw new Exception($error);
        }

        return $stmt;
    }

    // Login method
    public function login($username, $password)
    {
        try {
            // Execute stored procedure to fetch user details by username
            $stmt = $this->executeStoredProcedure("GetUserByUsername(?)", [$username]);
            $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            if ($user) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    return $user; // Successful login
                } else {
                    $this->logError("Invalid password for username: $username");
                }
            } else {
                $this->logError("User not found: $username");
            }

            return null;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }
    }

    // Check if username exists
    public function isUsernameExists($username)
    {
        try {
            $stmt = $this->executeStoredProcedure("CheckUsernameExists(?)", [$username]);
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            return !empty($row); // Returns true if the username exists
        } catch (Exception $e) {
            $this->logError("Error in checking username existence: " . $e->getMessage());
            return false;
        }
    }

    // Register a new user
    public function register($userData)
    {
        try {
            // Execute stored procedure to register the user
            $this->executeStoredProcedure("RegisterUser(?, ?, ?)", [
                $userData['username'],
                $userData['password'],
                $userData['role_id']
            ]);

            return true; // Successfully registered
        } catch (Exception $e) {
            $this->logError("Error during user registration: " . $e->getMessage());
            return false;
        }
    }
}
