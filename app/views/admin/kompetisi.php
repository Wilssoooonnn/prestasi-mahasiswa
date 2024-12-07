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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal"> Tambah Data</button>
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

    <!-- Modal Insert -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Tambah Kompetisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
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
                    <div class="form-group">
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
                    <div class="form-group">
                        <label>Nama Kompetisi</label>
                        <input type="text" class="form-control" name="nama_kompetisi" id="nama_kompetisi">
                    </div>
                    <div class="form-group">
                        <label>Tempat Kompetisi</label>
                        <input class="form-control" name="tempat_kompetisi" id="tempat_kompetisi">
                    </div>
                    <div class="form-group">
                        <label>URL Kompetisi</label>
                        <input type="text" class="form-control" name="url_kompetisi" id="url_kompetisi">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
                    </div>
                    <div class="form-group">
                        <label>Nomor Surat Tugas</label>
                        <input type="text" class="form-control" name="no_surat_tugas" id="no_surat_tugas">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat Tugas</label>
                        <input type="date" class="form-control" name="tanggal_surat_tugas" id="tanggal_surat_tugas">
                    </div>
                    <div class="form-group">
                        <label>File Surat Tugas</label>
                        <input type="file" class="form-control" name="file_surat_tugas" id="file_surat_tugas">
                    </div>
                    <div class="form-group">
                        <label>File Sertifikat</label>
                        <input type="file" class="form-control" name="file_sertifikat" id="file_sertifikat">
                    </div>
                    <div class="form-group">
                        <label>Foto Kegiatan</label>
                        <input type="file" class="form-control" name="foto_kegiatan" id="foto_kegiatan">
                    </div>
                    <div class="form-group">
                        <label>File Poster</label>
                        <input type="file" class="form-control" name="file_poster" id="file_poster">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
