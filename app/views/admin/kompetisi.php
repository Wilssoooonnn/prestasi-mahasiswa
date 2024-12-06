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
<div class="container mt-3">
    <h2>Data Kompetisi</h2>
    <!-- Card Header -->
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col d-flex">
                <input type="search" class="form-control w-50" placeholder="Cari NIM">
            </div>
            <div class="col d-flex justify-content-end">
                <a href="#" class="btn btn-primary"> Tambah Data</a>
            </div>
        </div>
    </div>

    <!-- Table Data -->
    <div class="table-responsive">
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Kompetisi</th>
                    <th>Jenis Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>No Surat Tugas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="kompetisiTableBody">
                <!-- Load data -->
            </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination justify-content-center" id="pagination">
            <!-- Load pagination -->
        </ul>
    </nav>


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
<!-- <script>
    const baseURL = "<?= BASE_URL ?>";
</script> -->