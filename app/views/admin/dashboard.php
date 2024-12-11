<?php //untuk counter kompetisi
require_once '../app/controllers/AdminController.php';
require_once '../app/models/AdminModel.php';
require_once '../app/models/KompetisiModel.php';

$kompetisiModel = new KompetisiModel();
$controller = new AdminController();
$data = $controller->getKompetisiCounts();
?>


<div class="container mt-5">

    <!-- Greeting -->
    <div class="container bg-primary mt-3 mb-3 p-5 rounded-3 d-flex">
        <div class="row w-100 align-items-center">
            <div class="col-6"> <!-- Kolom untuk teks di sebelah kiri -->
                <h1 class="text-white">Welcome, <?= $_SESSION['user']; ?></h1>
                <p class="text-white">Here is what's happening with your projects today</p>
            </div>
            <div class="col-6 text-end">
                <img class="img-fluid" src="<?= BASE_URL; ?>public/assets/images/trophy.svg" alt="" style="height: 100px;">
            </div>
        </div>
    </div>


    <!-- Cards Section -->
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-header bg-transparent border-primary" style="text-align: center; font-size: 16px;">
                    Total Data Kompetisi
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-cart4 fs-2 text-primary"></i>
                    <h4 class="mb-0" style="text-align: center; font-size: 22px;"><?= $data['totalKompetisi'] ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-header bg-transparent border-warning" style="text-align: center; font-size: 16px;">
                    Proses Validasi
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-cart4 fs-2 text-primary"></i>
                    <h4 class="mb-0" style="text-align: center; font-size: 22px;"><?= $data['kompetisiProses'] ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-header bg-transparent border-success" style="text-align: center; font-size: 16px;">
                    Berhasil Validasi
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-cart4 fs-2 text-primary"></i>
                    <h4 class="mb-0" style="text-align: center; font-size: 22px;"><?= $data['kompetisiBerhasil'] ?></h4>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-header bg-transparent border-danger" style="text-align: center; font-size: 16px;">
                    Gagal Validasi
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-cart4 fs-2 text-primary"></i>
                    <h4 class="mb-0" style="text-align: center; font-size: 22px;"><?= $data['kompetisiGagal'] ?></h4>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-3">
        <h2>Data Kompetisi</h2>
        <!-- Card Header -->
        <div class="card-header">
            <div class="row g-2 align-items-center">
                <div class="col d-flex">
                    <!-- <input type="search" class="form-control w-50" placeholder="Cari NIM"> -->
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


        <!-- Modal Approve -->
        <div class="modal fade" id="ApproveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Persetujuan Kompetisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Apakah Anda yakin ingin menyetujui kompetisi ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="approveButton">Approve</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Decline-->
        <div class="modal fade" id="DeclineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Penolakan Kompetisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h class="text-center">Apakah anda yakin ingin menolak data kompetisi ini?</h>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="declineButton">Decline</button>
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