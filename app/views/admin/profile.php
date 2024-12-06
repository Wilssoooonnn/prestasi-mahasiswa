<div class="container mt-5">

    <!-- Cards Section -->
    <div class="row mb-12">
      <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?= BASE_URL; ?>public/assets/images/head-logo.svg" alt="Profile" class="rounded-circle mb-4">
                    <h2 class="mb-2"><?= $_SESSION['user'];?></h2>
                    <h3 class="mb-4"><?= $_SESSION['role'];?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-cart4 fs-2 text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Overview</h6>
                            <h4 class="mb-0">145</h4>
                            <small class="text-success">12% increase</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>