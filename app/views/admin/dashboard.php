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
    <table class="table" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Judul Kompetisi</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Brandon Jacob</td>
                <td><span class="badge rounded-pill text-bg-success">Terverifikasi</span></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Bridie Kessler</td>
                <td><span class="badge rounded-pill text-bg-warning">Proses</span></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Ashleigh Langosh</td>
                <td><span class="badge rounded-pill text-bg-success">Terverifikasi</span></td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Angus Grady</td>
                <td><span class="badge rounded-pill text-bg-danger">Ditolak</span></td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>Raheem Lehner</td>
                <td><span class="badge rounded-pill text-bg-success">Terverifikasi</span></td>
            </tr>
        </tbody>
    </table>
</div>