<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../app/models/AdminModel.php';
require_once '../app/models/KompetisiModel.php';
$kompetisiModel = new KompetisiModel();
$adminModel = new AdminModel();

?>
<div class="container mt-5">
    <h2>Data Kompetisi</h2>
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <!-- <div class="col d-flex">
                <input type="search" class="form-control w-50" placeholder="Cari NIM">
            </div> -->
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">Tambah Data</button>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
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
                            <td><?= htmlspecialchars($row['kompetisi_id']) ?></td>
                            <td><?= htmlspecialchars($row['Nama_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Jenis_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Tingkat_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['Tempat_Kompetisi']) ?></td>
                            <td><?= htmlspecialchars($row['No_Surat_Tugas']) ?></td>
                            <td class="text-center">
                                <span class="<?php
                                                if ($row['Status'] == 'Proses') {
                                                    echo 'badge bg-warning text-white';
                                                } else if ($row['Status'] == 'Berhasil') {
                                                    echo 'badge bg-success text-white';
                                                } else {
                                                    echo 'badge bg-danger text-white';
                                                }
                                                ?>">
                                    <?= htmlspecialchars($row['Status']) ?>
                                </span>
                            </td>

                            <td>
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="loadDetailData('<?= json_encode($row) ?>')">
                                    <i class="fi fi-rr-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['kompetisi_id'] ?>" onclick="">
                                    <i class="fi fi-rr-pencil"></i>
                                </button>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $row['kompetisi_id'] ?>" tabindex="-1" aria-labelledby="editlModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Kompetisi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formUpdateDataDiri">
                                            <div class="position-relative m-4">
                                                <div class="progress" style="height: 1px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                                                <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Jenis Kompetisi</label>
                                                    <input type="hidden" class="form-control" name="id_kompetisi" id="id_kompetisi" value="<?= $row['kompetisi_id']; ?>">
                                                    <select name="jenis_id" class="form-control" id="jenis_id" required>
                                                        <option value=""> Pilih Jenis Kompetisi</option>
                                                        <!-- Dynamic data from PHP -->
                                                        <?php
                                                        // Menampilkan data dari table jenis_kompetisi ke dalam option
                                                        $jenis = $kompetisiModel->getJenisKomp();
                                                        if (!empty($jenis)):
                                                            foreach ($jenis as $j): ?>
                                                                <option value="<?= htmlspecialchars($j['id']); ?>" <?php if ($row['id_jk'] == $j['id']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>
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
                                                                <option value="<?= htmlspecialchars($t['id']); ?>" <?php if ($row['id_tk'] == $t['id']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>
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
                                                    <input type="text" class="form-control" name="nama_kompetisi" id="nama_kompetisi" value="<?= $row['Nama_Kompetisi']; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Tempat Kompetisi</label>
                                                    <input class="form-control" name="tempat_kompetisi" id="tempat_kompetisi" value="<?= $row['Tempat_Kompetisi']; ?>">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>Tanggal Mulai</label>
                                                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="<?= $row['Tanggal_Mulai']; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Tanggal Akhir</label>
                                                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="<?= $row['Tanggal_Akhir']; ?>">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>Nomor Surat Tugas</label>
                                                    <input type="text" class="form-control" name="no_surat_tugas" id="no_surat_tugas" value="<?= $row['No_Surat_Tugas']; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Tanggal Surat Tugas</label>
                                                    <input type="date" class="form-control" name="tanggal_surat_tugas" id="tanggal_surat_tugas" value="<?= $row['Tanggal_Surat_Tugas']; ?>">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>URL Kompetisi</label>
                                                    <input type="text" class="form-control" name="url_kompetisi" id="url_kompetisi" value="<?= $row['URL_Kompetisi']; ?>">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label for="">Dosen Pembimbing</label>
                                                    <select class="form-control" name="dosen_id" id="dosen_id">
                                                        <option value="" disabled></option>
                                                        <?php
                                                        // Menampilkan data dari table dosen ke dalam option
                                                        $dosen = $adminModel->getDataDosen();
                                                        if (!empty($dosen)):
                                                            foreach ($dosen as $d): ?>
                                                                <option value="<?= htmlspecialchars($d['id']); ?>">
                                                                    <?= htmlspecialchars($d['nama']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <option value="">Dosen Tidak Ditemukan</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal2">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal edit slide 2 -->
                        <div class="modal fade" id="editModal2" tabindex="-1" aria-labelledby="editModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel2">Upload Berkas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formUpdateFile">
                                            <div class="position-relative m-4">
                                                <div class="progress" style="height: 1px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                                                <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>File Surat Tugas</label>
                                                    <input type="file" class="form-control" name="file_surat_tugas_new" id="file_surat_tugas_new">
                                                    <input type="hidden" class="form-control" name="file_surat_tugas_old" id="file_surat_tugas_old" value="<?= $row['File_Surat_Tugas']; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>File Sertifikat</label>
                                                    <input type="file" class="form-control" name="file_sertifikat_new" id="file_sertifikat_new">
                                                    <input type="hidden" class="form-control" name="file_sertifikat_old" id="file_sertifikat_old" value="<?= $row['File_Sertifikat']; ?>">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>Foto Kegiatan</label>
                                                    <input type="file" class="form-control" name="foto_kegiatan_new" id="foto_kegiatan_new">
                                                    <input type="hidden" class="form-control" name="foto_kegiatan_old" id="foto_kegiatan_old" value="<?= $row['Foto_Kegiatan']; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>File Poster</label>
                                                    <input type="file" class="form-control" name="file_poster_new" id="file_poster_new">
                                                    <input type="hidden" class="form-control" name="file_poster_old" id="file_poster_old" value="<?= $row['File_Poster']; ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer mt-3">
                                        <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-outline-primary" class="btn btn-primary" id="saveButton">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                <h5 class="modal-title" id="insertModalLabel">Data Kompetisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDataDiri">
                    <div class="position-relative m-4">
                        <div class="progress" style="height: 1px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                        <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Jenis Kompetisi</label>
                            <select name="jenis_id" class="form-control" id="jenis_id" required>
                                <option value=""> Pilih Jenis Kompetisi</option>
                                <!-- Dynamic data from PHP -->
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
                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Dosen Pembimbing</label>
                            <select class="form-control" name="dosen_id" id="dosen_id">
                                <option value="" disabled></option>
                                <?php
                                // Menampilkan data dari table dosen ke dalam option
                                $dosen = $adminModel->getDataDosen();
                                if (!empty($dosen)):
                                    foreach ($dosen as $d): ?>
                                        <option value="<?= htmlspecialchars($d['id']); ?>">
                                            <?= htmlspecialchars($d['nama']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Dosen Tidak Ditemukan</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal2">Next</button>
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
                <form id="formUploadFile">
                    <div class="position-relative m-4">
                        <div class="progress" style="height: 1px;">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                        <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
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
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-outline-secondary" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Berhasil!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data kompetisi Anda berhasil disimpan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>