<?php
require_once '../config/database.php'; // Memuat file Database.php

class KompetisiModel
{
    private $db;

    public function __construct()
    {
        // Membuat koneksi ke database
        $this->db = (new Database())->connect();
    }
    
    public function deleteData($id)
    {
        $query = "DELETE FROM kompetisi WHERE buku_id = ?";
        $params = [$id];
        sqlsrv_query($this->db, $query, $params);
    }

    public function getJenisKomp()
    {
        // Mengambil data dari table jenis_kompetisi
        $query = "SELECT * FROM jenis_kompetisi ORDER BY nama ASC";
        $jenis = [];
        $this->db = (new Database())->connect();
        $stmt = sqlsrv_query($this->db, $query);
        if ($stmt === false) {
            $errors = sqlsrv_errors();
            die("SQL Server Query Error: " . $errors[0]['message']);
        }
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $jenis[] = $row;
        }
        return $jenis;
    }

    public function getTingkatKomp()
    {
        // Mengambil data dari table tingkat_kompetisi
        $query = "SELECT * FROM tingkat_kompetisi ORDER BY nama ASC";
        $tingkat = [];
        $stmt = sqlsrv_query($this->db, $query);
        if ($stmt === false) {
            $errors = sqlsrv_errors();
            die("SQL Server Query Error: " . $errors[0]['message']);
        }
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $tingkat[] = $row;
        }
        return $tingkat;
    }
}
