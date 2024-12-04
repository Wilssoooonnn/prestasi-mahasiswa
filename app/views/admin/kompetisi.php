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
    <h2>Data Kompetisi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>NIM </th>
                <th>Nama Mahasiswa</th>
                <th>Nama Kompetisi</th>
                <th>Jenis Kompetisi</th>
                <th>Tingkat Kompetisi</th>
                <th>Tempat Kompetisi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>URL Kompetisi</th>
                <th>No Surat Tugas</th>
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
                        <td><?= htmlspecialchars($row['Tanggal_Mulai']) ?></td>
                        <td><?= htmlspecialchars($row['Tanggal_Akhir']) ?></td>
                        <td><a href="<?= htmlspecialchars($row['URL_Kompetisi']) ?>" target="_blank">Link</a></td>
                        <td><?= htmlspecialchars($row['No_Surat_Tugas']) ?></td>
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
