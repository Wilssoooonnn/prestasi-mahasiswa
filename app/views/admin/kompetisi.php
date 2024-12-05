<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'auth/login');
    exit();
}

require_once '../app/models/AdminModel.php';

$adminModel = new AdminModel();
$dataAllKompetisi = $adminModel->readAllKompetisi($_SESSION['user']);

?>

<div class="container mt-5">
    <!-- CARD HEADER -->
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col d-flex">
                <button type="button" class="btn btn-md btn-primary" onclick="tambahData()"> Tambah Data</button>
            </div>
            <div class="col d-flex justify-content-end">
                <input type="search" class="form-control w-50" placeholder="Cari NIM">
            </div>
        </div>
    </div>
    <!-- CARD HEADER -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIM </th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Kompetisi</th>
                    <th>Jenis Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>Tempat Kompetisi</th>
                    <th>URL Kompetisi</th>
                    <th>No Surat Tugas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataAllKompetisi)) : ?>
                    <?php foreach ($dataAllKompetisi as $row) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['NIM']) ?></td>
                            <td><?= htmlspecialchars($row['Nama_Mahasiswa']) ?></td>
                            <td><?= htmlspecialchars($row['Nama_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Jenis_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Tingkat_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Tempat_Kompetisi']) ?></td>
                            <td><a href="<?= htmlspecialchars($row['URL_Kompetisi']) ?>" target="#">Link</a></td>
                            <td><?= htmlspecialchars($row['No_Surat_Tugas']) ?></td>
                            <td>
                                <a href="#" class="btn btn-success">Approve</a>
                                <a href="#" class="btn btn-danger mt-1">Decline</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data kompetisi</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>