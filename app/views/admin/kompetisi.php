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
// $dataAllKompetisi = $adminModel->readAllKompetisi($_SESSION['user']);

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
                <button type="button" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Tambah Data</button>
            </div>
        </div>
    </div>

    <!-- Table Data -->
    <div class="table-responsive">
        <table class="table table-hover mt-3">
            <thead class="table-primary">
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
                    <!-- <p><strong>NIM :</strong> <span id="detailNIM"></span></p>
                    <p><strong>Nama Mahasiswa :</strong> <span id="detailNama"></span></p>
                    <p><strong>Nama Kompetisi :</strong> <span id="detailKompetisi"></span></p>
                    <p><strong>Jenis Kompetisi :</strong> <span id="detailJenis"></span></p>
                    <p><strong>Tingkat Kompetisi :</strong> <span id="detailTingkat"></span></p>
                    <p><strong>Tempat Kompetisi :</strong> <span id="detailTempat"></span></p>
                    <p><strong>URL Kompetisi :</strong> <a href="#" target="_blank" id="detailURL">Link</a></p>
                    <p><strong>No Surat Tugas :</strong> <span id="detailSurat"></span></p> -->
                    <form>
                        <div class="row">
                            <div class="col">
                                <label>NIM</label>
                                <input type="text" class="form-control" name="nim" id="nim">
                            </div>
                            <div class="col">
                                <label>Nama Mahasiswa</label>
                                <input class="form-control" name="full_name" id="full_name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Jenis Kompetisi</label>
                                <input class="form-control" name="jenis_kompetisi" id="jenis_kompetisi">
                            </div>
                            <div class="col">
                                <label>Tingkat Kompetisi</label>
                                <input type="text" class="form-control" name="tingkat_kompetisi" id="tingkat_kompetisi">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Tempat Kompetisi</label>
                                <input class="form-control" name="tempat_kompetisi" id="tempat_kompetisi">
                            </div>
                            <div class="col">
                                <label>URL Kompetisi</label>
                                <input type="text" class="form-control" name="url_kompetisi" id="url_kompetisi">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Nomor Surat Tugas</label>
                                <input type="text" class="form-control" name="no_surat_tugas" id="no_surat_tugas">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Insert -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Data Kompetisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="position-relative m-4">
                            <div class="progress" style="height: 1px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                            <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                            <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Jenis Kompetisi</label>
                                <select name="jenis_id" class="form-control" id="jenis_id" required>
                                    <option value=""> Pilih Jenis Kompetisi</option>
                                    <?php
                                    // Menampilkan data dari table jenis_kompetisi ke dalam option
                                    $jenis = $kompetisiModel->getJenisKomp();
                                    if (!empty($jenis)):
                                        foreach ($jenis as $j): ?>
                                            <option value="<?= htmlspecialchars($j['id']); ?>">
                                                <?= htmlspecialchars($j['nama']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">Jenis Tidak Ditemukan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label>Tingkat Kompetisi</label>
                                <select name="tingkat_id" class="form-control" id="tingkat_id" required>
                                    <option value=""> Pilih Tingkat Kompetisi</option>
                                    <?php
                                    // Menampilkan data dari table tingkat_kompetisi ke dalam option
                                    $tingkat = $kompetisiModel->getTingkatKomp();
                                    if (!empty($tingkat)):
                                        foreach ($tingkat as $t): ?>
                                            <option value="<?= htmlspecialchars($t['id']); ?>">
                                                <?= htmlspecialchars($t['nama']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">Tingkat Tidak Ditemukan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Nama Kompetisi</label>
                                <input type="text" class="form-control" name="nama_kompetisi" id="nama_kompetisi">
                            </div>
                            <div class="col">
                                <label>Tempat Kompetisi</label>
                                <input class="form-control" name="tempat_kompetisi" id="tempat_kompetisi">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                            </div>
                            <div class="col">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Nomor Surat Tugas</label>
                                <input type="text" class="form-control" name="no_surat_tugas" id="no_surat_tugas">
                            </div>
                            <div class="col">
                                <label>Tanggal Surat Tugas</label>
                                <input type="date" class="form-control" name="tanggal_surat_tugas" id="tanggal_surat_tugas">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>URL Kompetisi</label>
                                <input type="text" class="form-control" name="url_kompetisi" id="url_kompetisi">

                            </div>
                        </div>
                    </form>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        <button type="button" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal2">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal slide 2 -->

    <div class="modal fade" id="insertModal2" tabindex="-1" aria-labelledby="insertModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel2">Upload Berkas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="position-relative m-4">
                            <div class="progress" style="height: 1px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                            <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                            <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>File Surat Tugas</label>
                                <input type="file" class="form-control" name="file_surat_tugas" id="file_surat_tugas">
                            </div>
                            <div class="col">
                                <label>File Sertifikat</label>
                                <input type="file" class="form-control" name="file_sertifikat" id="file_sertifikat">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Foto Kegiatan</label>
                                <input type="file" class="form-control" name="foto_kegiatan" id="foto_kegiatan">
                            </div>
                            <div class="col">
                                <label>File Poster</label>
                                <input type="file" class="form-control" name="file_poster" id="file_poster">
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        <button type="button" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal3">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal slide 3 -->

    <div class="modal fade" id="insertModal3" tabindex="-1" aria-labelledby="insertModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel3">Data Kompetisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="position-relative m-4">
                            <div class="progress" style="height: 1px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                            <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                            <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>NIM</label>
                                <input type="text" class="form-control" name="nim" id="nim">
                            </div>
                            <div class="col">
                                <label>Full Name</label>
                                <input class="form-control" name="full_name" id="full_name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>
                            <div class="col">
                                <label>No Telp</label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal3">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>