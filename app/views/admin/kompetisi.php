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
<div class="container w-100">
    <h2>Data Kompetisi</h2>
    <!-- CARD HEADER -->
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col d-flex">
                <a href="#" class="btn btn-primary"> Tambah Data</a>
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
                    <th>NIM</th>
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
                                <button class="btn btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal"
                                    onclick="loadDetailData(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    Detail
                                </button>
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
</div>

<script>
    function loadDetailData(data) {
        document.getElementById('detailNIM').textContent = data.NIM;
        document.getElementById('detailNama').textContent = data.Nama_Mahasiswa;
        document.getElementById('detailKompetisi').textContent = data.Nama_Kompetisi;
        document.getElementById('detailJenis').textContent = data.Jenis_Kompetisi;
        document.getElementById('detailTingkat').textContent = data.Tingkat_Kompetisi;
        document.getElementById('detailTempat').textContent = data.Tempat_Kompetisi;
        document.getElementById('detailURL').setAttribute('href', data.URL_Kompetisi);
        document.getElementById('detailSurat').textContent = data.No_Surat_Tugas;
    }
</script>