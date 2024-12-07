<?php

require_once '../app/models/KompetisiModel.php'; // Memuat model

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

// Load table
if ($act == 'load') {
    $kompetisi = new KompetisiModel();
    $data = $kompetisi->getData();
    $result = [];
    $i = 1;

    while ($row = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
        $result['data'][] = [
            $i,
            htmlspecialchars($row['jenis_id']),
            htmlspecialchars($row['tingkat_id']),
            htmlspecialchars($row['nama_kompetisi']),
            htmlspecialchars($row['tempat_kompetisi']),
            htmlspecialchars($row['url_kompetisi']),
            htmlspecialchars($row['tanggal_mulai']),
            htmlspecialchars($row['tanggal_akhir']),
            htmlspecialchars($row['no_surat_tugas']),
            htmlspecialchars($row['tanggal_surat_tugas']),
            '<img src="' . htmlspecialchars($row['file_surat_tugas']) . '" alt="Surat Tugas" style="width: 100px; height: auto;">',
            '<img src="' . htmlspecialchars($row['file_sertifikat']) . '" alt="Sertifikat" style="width: 100px; height: auto;">',
            '<img src="' . htmlspecialchars($row['foto_kegiatan']) . '" alt="Foto Kegiatan" style="width: 100px; height: auto;">',
            '<img src="' . htmlspecialchars($row['file_poster']) . '" alt="File Poster" style="width: 100px; height: auto;">',
            // icon belum fix
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }

    echo json_encode($result);
    exit;
}

// Get ID
if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? (int)$_GET['id'] : 0;
    $kompetisi = new KompetisiModel();
    $data = $kompetisi->getDataById($id);
    echo json_encode($data);
    exit;
}

// Save data
if ($act == 'save') {
    $data = [
        'jenis_id' => $_POST['jenis_id'],
        'tingkat_id' => $_POST['tingkat_id'],
        'nama_kompetisi' => $_POST['nama_kompetisi'],
        'tempat_kompetisi' => $_POST['tempat_kompetisi'],
        'url_kompetisi' => $_POST['url_kompetisi'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_akhir' => $_POST['tanggal_akhir'],
        'no_surat_tugas' => $_POST['no_surat_tugas'],
        'tanggal_surat_tugas' => $_POST['tanggal_surat_tugas'],
        'file_surat_tugas' => $_POST['file_surat_tugas'],
        'file_sertifikat' => $_POST['file_sertifikat'],
        'foto_kegiatan' => $_POST['foto_kegiatan'],
        'file_poster' => $_POST['file_poster']
    ];

    $kompetisi = new KompetisiModel();
    $kompetisi->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
    exit;
}

// Delete data
if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? (int)$_GET['id'] : 0;
    $kompetisi = new KompetisiModel();
    $kompetisi->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
    exit;
}