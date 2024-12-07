<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil data kompetisi
require_once '../app/models/KompetisiModel.php';
$kompetisiModel = new KompetisiModel();
$getJenis = $kompetisiModel->getJenisKomp();
$getTingkat = $kompetisiModel->getTingkatKomp();
?>

<div class="container mt-5">
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

    <div class="table-responsive mt-3">
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

    <!-- Paginasi -->
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
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
                <h5 class="modal-title" id="insertModalLabel">Data Kompetisi - Step 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertFormStep1">
                    <div class="row">
                        <div class="col">
                            <label>Jenis Kompetisi</label>
                            <select name="jenis_id" class="form-control" id="jenis_id" required>
                                <option value="">Pilih Jenis Kompetisi</option>
                                <?php foreach ($getJenis as $row) : ?>
                                    <option value="<?= htmlspecialchars($row['id']) ?>">
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label>Tingkat Kompetisi</label>
                            <select name="tingkat_id" class="form-control" id="tingkat_id" required>
                                <option value="">Pilih Tingkat Kompetisi</option>
                                <?php foreach ($getTingkat as $row) : ?>
                                    <option value="<?= htmlspecialchars($row['id']) ?>">
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-target="#insertModal2" data-bs-toggle="modal">Next</button>
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
                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
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
                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                        <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                        <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
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