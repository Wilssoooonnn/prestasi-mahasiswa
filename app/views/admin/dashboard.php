<div class="container mt-5">
    <!-- Greeting -->
    <h1 class="mb-4">HALO, <?= $_SESSION['user']; ?></h1>

    <?php //untuk counter kompetisi
    require_once '../app/controllers/AdminController.php';
    $controller = new AdminController();
    $data = $controller->getKompetisiCounts();
    ?>

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

        