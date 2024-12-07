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

require_once '../app/models/MahasiswaModel.php';

$mahasiswaModel = new MahasiswaModel();
$dataKompetisi = $mahasiswaModel->readKompetisiByNim($_SESSION['user']);

?>
<div class="container mt-5">
    <h2>Data Kompetisi</h2>
    <!-- CARD HEADER -->
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col d-flex">
                <a href="<?= BASE_URL; ?>mahasiswa/dashboard" class="btn btn-primary">+ Tambah Data</a>
            </div>
            <div class="col d-flex justify-content-end">
                <input type="search" class="form-control w-50" placeholder="Cari NIM">
            </div>
        </div>
    </div>
    <!-- CARD HEADER -->
    <div class="table-responsive mt-5">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Kompetisi</th>
                    <th>Jenis Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>Tempat Kompetisi</th>
                    <th>No Surat Tugas</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataKompetisi)) : ?>
                    <?php foreach ($dataKompetisi as $row) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['NIM']) ?></td>
                            <td><?= htmlspecialchars($row['Nama_Mahasiswa']) ?></td>
                            <td><?= htmlspecialchars($row['Nama_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Jenis_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Tingkat_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Tempat_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['No_Surat_Tugas']) ?></td>
                            <td><?= htmlspecialchars($row['Status']) ?></td>
                            <td>
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="loadDetailData('<?= json_encode($row) ?>')">
                                    <i class="fi fi-rr-eye"></i>
                                </button>
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
    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Kompetisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>NIM:</strong> <span id="detailNIM"></span></p>
                    <p><strong>Nama Mahasiswa:</strong> <span id="detailNama"></span></p>
                    <p><strong>Nama Kompetisi:</strong> <span id="detailKompetisi"></span></p>
                    <p><strong>Jenis Kompetisi:</strong> <span id="detailJenis"></span></p>
                    <p><strong>Tingkat Kompetisi:</strong> <span id="detailTingkat"></span></p>
                    <p><strong>Tempat Kompetisi:</strong> <span id="detailTempat"></span></p>
                    <p><strong>URL Kompetisi:</strong> <a href="#" target="_blank" id="detailURL">Link</a></p>
                    <p><strong>No Surat Tugas:</strong> <span id="detailSurat"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>