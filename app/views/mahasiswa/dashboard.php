<?php
require_once '../app/controllers/MahasiswaController.php';
require_once '../app/models/KompetisiModel.php';

$controller = new MahasiswaController();
$data = $controller->getKompetisiCounts_Mhs();
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

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-header bg-transparent border-primary" style="text-align: center;">Total Kompetisi</div>
                <div class="card-body">
                    <h4 class="text-center"><?= $data['totalKompetisi'] ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-header bg-transparent border-success" style="text-align: center;">Kompetisi Berhasil</div>
                <div class="card-body">
                    <h4 class="text-center"><?= $data['kompetisiBerhasil'] ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-header bg-transparent border-warning" style="text-align: center;">Kompetisi Proses</div>
                <div class="card-body">
                    <h4 class="text-center"><?= $data['kompetisiProses'] ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-header bg-transparent border-danger" style="text-align: center;">Kompetisi Gagal</div>
                <div class="card-body">
                    <h4 class="text-center"><?= $data['kompetisiGagal'] ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$controller->kompetisi();
?>