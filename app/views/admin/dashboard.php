<div class="container mt-5">
    <!-- Greeting -->
    <h1 class="mb-4">HALO, <?= $_SESSION['user']; ?></h1>

    <!-- Cards Section -->
    <div class="row mb-3">
      <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-cart4 fs-2 text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Total Data Kompetisi</h6>
                            <h4 class="mb-0">145</h4>
                            <small class="text-success">12% increase</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-cart4 fs-2 text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Data Terverifikasi</h6>
                            <h4 class="mb-0">145</h4>
                            <small class="text-success">12% increase</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-currency-dollar fs-2 text-success"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Data dalam Proses</h6>
                            <h4 class="mb-0">$3,264</h4>
                            <small class="text-success">8% increase</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-people-fill fs-2 text-danger"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Data Tertolak</h6>
                            <h4 class="mb-0">1244</h4>
                            <small class="text-danger">12% decrease</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <table id="dataTable" class="table table-striped table-bordered mt-3" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Kompetisi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#2457</td>
                <td>Brandon Jacob</td>
                <td><span class="badge bg-success">Terverifikasi</span></td>
            </tr>
            <tr>
                <td>#2147</td>
                <td>Bridie Kessler</td>
                <td><span class="badge bg-warning text-dark">Proses</span></td>
            </tr>
            <tr>
                <td>#2049</td>
                <td>Ashleigh Langosh</td>
                <td><span class="badge bg-success">Terverifikasi</span></td>
            </tr>
            <tr>
                <td>#2644</td>
                <td>Angus Grady</td>
                <td><span class="badge bg-danger">Ditolak</span></td>
            </tr>
            <tr>
                <td>#2644</td>
                <td>Raheem Lehner</td>
                <td><span class="badge bg-success">Terverifikasi</span></td>
            </tr>
        </tbody>
    </table>
    <br>
    <a href="<?= BASE_URL; ?>auth/logout">Logout</a>
</div>