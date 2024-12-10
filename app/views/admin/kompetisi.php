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
require_once '../app/models/KompetisiModel.php';

$adminModel = new AdminModel();
$kompetisiModel = new KompetisiModel();

?>
<div class="container mt-3">
    <h2>Data Kompetisi</h2>
    <!-- Card Header -->
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col d-flex">
                <input type="search" class="form-control w-50" placeholder="Cari NIM">
            </div>
        </div>
    </div>

    <!-- Table Data -->
    <div class="table-responsive">
        <table class="table table-hover mt-3">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Kompetisi</th>
                    <th>Jenis Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>No Surat Tugas</th>
                    <th>Status</th>
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


    <!-- Modal Approve-->
    <div class="modal fade" id="ApproveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Aprrove</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h class="text-center">Apakah anda yakin ingin menyetujui data ini?</h>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="approveButton" onclick="">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Decline-->
    <div class="modal fade" id="DeclineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Decline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h class="text-center">Apakah anda yakin ingin menolak data ini?</h>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Decline</button>
                </div>
            </div>
        </div>
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
                    <div>
                        <p><strong>NIM:</strong> <span id="detailNIM"></span></p>
                        <p><strong>Nama Mahasiswa:</strong> <span id="detailNama"></span></p>
                        <p><strong>Nama Kompetisi:</strong> <span id="detailKompetisi"></span></p>
                        <p><strong>Jenis Kompetisi:</strong> <span id="detailJenis"></span></p>
                        <p><strong>Tingkat Kompetisi:</strong> <span id="detailTingkat"></span></p>
                        <p><strong>Tempat Kompetisi:</strong> <span id="detailTempat"></span></p>
                        <p><strong>URL Kompetisi:</strong> <a id="detailURL" href="#" target="_blank">Link</a></p>
                        <p><strong>No Surat Tugas:</strong> <span id="detailSurat"></span></p>

                        <!-- Gambar Cards -->
                        <div class="card-group gap-3" id="imageContainer">
                            <!-- Gambar akan ditambahkan di sini menggunakan JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>