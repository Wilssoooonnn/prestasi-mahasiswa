<?php
require_once '../app/controllers/MahasiswaController.php';
$controller = new MahasiswaController();
$data = $controller->getLeaderboard();
$dataOff = $controller->getLeaderboardOffset();
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid py-1">
        <!-- Logo on the left -->
        <a href="#">
            <img src="<?= BASE_URL; ?>assets/images/logo-fix.svg" alt="Logo" style="height: 40px;">
        </a>
        <div class="nav-brand"></div>

        <!-- Navbar items on the left (hidden on mobile) -->
        <ul class="navbar-nav me-auto ms-4">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>

        <!-- Navbar Toggle (for mobile view) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar items, Login button on the right -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="auth/login" role="button">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Hero Section -->
<section class="hero-section text-center" style="margin-top: 100px;">
    <div class="container w-100 bg-primary rounded-3 p-5">
        <object data="<?= BASE_URL; ?>assets/images/header.svg" type="image/svg+xml" style="width: 80vh;"></object>
        <p class="lead text-white mt-4">Track your academic and extracurricular achievements and see where you rank!</p>
        <a href="auth/login" class="btn btn-outline-light btn-lg">Start Now</a>
    </div>
</section>



<!-- Leaderboard Section -->
<section id="leaderboard" class="container py-5">
    <h2 class="text-center mb-4">Top Achievers</h2>

    <!-- Display Top 3 Achievers in Cards -->
    <div class="container d-flex justify-content-center gap-5" style="border:none !important">
        <!-- Top 1 Achiever -->
        <div class="card text-center" style="width: 18rem; border: none;">
            <iframe src="https://lottie.host/embed/e737a588-abbf-4972-b82a-208d934d4f4c/EfR1kYDNOT.lottie"></iframe>
            <div class="card-body">
                <h5 class="card-title"><?= $data[0]['Nama']; ?></h5>
                <p class="card-text">Top Achiever in <?= $data[0]['Prodi']; ?> with <?= $data[0]['TotalBerhasil']; ?> achievements.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Achievements : <?= $data[0]['TotalBerhasil']; ?></li>
                <li class="list-group-item">Program Studi : <?= $data[0]['Prodi']; ?></li>
            </ul>
        </div>

        <!-- Top 2 Achiever -->
        <div class="card text-center" style="width: 18rem; border: none;">
            <iframe src="https://lottie.host/embed/e737a588-abbf-4972-b82a-208d934d4f4c/EfR1kYDNOT.lottie"></iframe>
            <div class="card-body">
                <h5 class="card-title"><?= $data[1]['Nama']; ?></h5>
                <p class="card-text">Second place in <?= $data[1]['Prodi']; ?> with <?= $data[1]['TotalBerhasil']; ?> achievements.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Achievements : <?= $data[1]['TotalBerhasil']; ?></li>
                <li class="list-group-item">Program Studi : <?= $data[1]['Prodi']; ?></li>
            </ul>
        </div>

        <!-- Top 3 Achiever -->
        <div class="card text-center" style="width: 18rem; border: none;">
            <iframe src="https://lottie.host/embed/e737a588-abbf-4972-b82a-208d934d4f4c/EfR1kYDNOT.lottie"></iframe>
            <div class="card-body">
                <h5 class="card-title"><?= $data[2]['Nama']; ?></h5>
                <p class="card-text">Ranked third in <?= $data[2]['Prodi']; ?> with <?= $data[2]['TotalBerhasil']; ?> achievements.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Achievements : <?= $data[2]['TotalBerhasil']; ?></li>
                <li class="list-group-item">Program Studi : <?= $data[2]['Prodi']; ?></li>
            </ul>
        </div>
    </div>

    <!-- Leaderboard Table -->
    <table class="table table-hover mt-5">
        <thead class="table-primary">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
                <th class="text-center">Program Studi</th>
                <th class="text-center">Total Achievements</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">4</td>
                <td class="text-center"><?= $dataOff[0]['Nama']; ?></td>
                <td class="text-center"><?= $dataOff[0]['Prodi']; ?></td>
                <td class="text-center"><?= $dataOff[0]['TotalBerhasil']; ?></td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td class="text-center"><?= $dataOff[1]['Nama']; ?></td>
                <td class="text-center"><?= $dataOff[1]['Prodi']; ?></td>
                <td class="text-center"><?= $dataOff[1]['TotalBerhasil']; ?></td>
            </tr>
            <tr>
                <td class="text-center">6</td>
                <td class="text-center"><?= $dataOff[2]['Nama']; ?></td>
                <td class="text-center"><?= $dataOff[2]['Prodi']; ?></td>
                <td class="text-center"><?= $dataOff[2]['TotalBerhasil']; ?></td>
            </tr>
            <tr>
                <td class="text-center">7</td>
                <td class="text-center"><?= $dataOff[3]['Nama']; ?></td>
                <td class="text-center"><?= $dataOff[3]['Prodi']; ?></td>
                <td class="text-center"><?= $dataOff[3]['TotalBerhasil']; ?></td>
            </tr>
            <tr>
                <td class="text-center">8</td>
                <td class="text-center"><?= $dataOff[4]['Nama']; ?></td>
                <td class="text-center"><?= $dataOff[4]['Prodi']; ?></td>
                <td class="text-center"><?= $dataOff[4]['TotalBerhasil']; ?></td>
            </tr>
        </tbody>
    </table>
</section>


<section id="vertical-cards" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Us</h2>
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card vertical-card h-100">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <img src="<?= BASE_URL; ?>public/assets/images/head-logo.svg" alt="Quality" class="img-fluid" style="width: 60px;">
                        </div>
                        <h5 class="card-title">High Quality</h5>
                        <p class="card-text">We deliver top-notch products that meet your expectations with unmatched precision.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card vertical-card h-100">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <img src="icon-support.png" alt="Support" class="img-fluid" style="width: 60px;">
                        </div>
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text">Our team is always available to assist you anytime, ensuring a seamless experience.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card vertical-card h-100">
                    <div class="card-body text-center">
                        <div class="icon mb-3">
                            <img src="icon-value.png" alt="Value" class="img-fluid" style="width: 60px;">
                        </div>
                        <h5 class="card-title">Great Value</h5>
                        <p class="card-text">We offer competitive pricing without compromising on quality and service.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Testimonial Section -->
<section class="testimonial">
    <div class="container">
        <h2 class="text-center mb-4">What Our Users Say</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <p><i class="fas fa-quote-left"></i> "This platform motivates me to keep achieving. Seeing my progress and rankings keeps me on track!" - <strong>John Doe</strong></p>
            </div>
            <div class="col-md-4">
                <p><i class="fas fa-quote-left"></i> "The leaderboard feature is fun. I love competing with my friends to stay on top." - <strong>Jane Smith</strong></p>
            </div>
            <div class="col-md-4">
                <p><i class="fas fa-quote-left"></i> "The certificates I receive for my achievements make me feel valued!" - <strong>Alice Brown</strong></p>
            </div>
        </div>
    </div>
</section>