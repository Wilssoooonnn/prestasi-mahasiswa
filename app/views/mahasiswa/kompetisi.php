<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<div class="container mt-5">
    <h2>Data Kompetisi</h2>
    <div class="table-responsive mt-5">
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
                            <td><?= htmlspecialchars($row['Status']) ?></td>
                            <td>
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="loadDetailData('<?= json_encode($row) ?>')">
                                    <i class="fi fi-rr-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal" onclick="">
                                    <i class="fi fi-rr-pencil"></i>
                                </button>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fi fi-rr-trash"></i>
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Kompetisi</h5>
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