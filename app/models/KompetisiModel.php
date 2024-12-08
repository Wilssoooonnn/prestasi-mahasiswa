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

    
    public function getData()
    {
        $query = "SELECT * FROM kompetisi";
        return sqlsrv_query($this->db, $query);
    }

    public function getDataById($id)
    {
        $query = "SELECT * FROM kompetisi WHERE id = ?";
        $params = [$id];
        $stmt = sqlsrv_query($this->db, $query, $params);
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function updateData($id, $data)
    {
        $query = "UPDATE kompetisi 
                    SET jenis_id = ?, tingkat_id = ?, nama_kompetisi = ?, tempat_kompetisi = ?, url_kompetisi = ?, tanggal_mulai = ?, tanggal_akhir = ?
                    no_surat_tugas = ?, tanggal_surat_tugas = ?, file_surat_tugas = ?, file_sertifikat = ?, foto_kegiatan = ?, file_poster = ?
                    WHERE id = ?";
        $params = [
            $data['jenis_id'],
            $data['tingkat_id'],
            $data['nama_kompetisi'],
            $data['tempat_kompetisi'],
            $data['url_kompetisi'],
            $data['tanggal_mulai'],
            $data['tanggal_akhir'],
            $data['no_surat_tugas'],
            $data['tanggal_surat_tugas'],
            $data['file_surat_tugas'],
            $data['file_sertifikat'],
            $data['foto_kegiatan'],
            $data['file_poster']
        ];
        sqlsrv_query($this->db, $query, $params);
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
