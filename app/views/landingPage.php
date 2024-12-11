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
    <h2 class="text-center mb-4 fw-bold">Top Achievers</h2>

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

<!-- About Us -->
<section id="about-us" class="py-5">
    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">ABOUT US</h2>
        <div class="card text-center">
            <div class="card-header bg-primary">
                <strong class="text-white">Who We Are?</strong>
            </div>
            <div class="card-body py-5">
                <h5 class="card-title">We are a team dedicated to helping individuals track and improve their academic and extracurricular achievements</h5>
                <p class="card-text">Our mission is to provide a platform where students can monitor their growth, set goals, and strive towards becoming top achievers in their fields.</p>
                <a href="#" class="btn btn-outline-primary">Get Started</a>
            </div>
            <div class="card-footer text-muted bg-primary">
                <strong class="text-white">PrestasiGO</strong>
            </div>
        </div>
    </div>
</section>


<!-- Vertical Cards Section : Why Choose Us -->
<section id="vertical-cards" class="py-3 bg-primary">
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold text-white">Why Choose Us</h2>
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="py-5 card vertical-card h-100">
                    <div class="card-body text-center">
                        <div class="container d-flex justify-content-center align-items-center rounded-circle bg-light" style="width: 100px; height: 100px;">
                            <img src="<?= BASE_URL; ?>public/assets/images/trophy.svg" alt="">
                        </div>
                        <h5 class="card-title mt-4">Track Your Achievements</h5>
                        <p class="card-text mt-2">Easily track your academic and extracurricular achievements in one place.</p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="py-5 card vertical-card h-100">
                    <div class="card-body text-center">
                        <div class="container d-flex justify-content-center align-items-center rounded-circle bg-light" style="width: 100px; height: 100px;">
                            <img src="<?= BASE_URL; ?>public/assets/images/level-up.svg" alt="" style="height: 70px; width: 70px;">
                        </div>
                        <h5 class="card-title mt-4">Boost Your Achievements</h5>
                        <p class="card-text mt-2">Enhance your skills and reach new levels of achievement.</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="py-5 card vertical-card h-100">
                    <div class="card-body text-center">
                        <div class="container d-flex justify-content-center align-items-center rounded-circle bg-light" style="width: 100px; height: 100px;">
                            <img src="<?= BASE_URL; ?>public/assets/images/crown.svg" alt="" style="height: 70px; width: 70px;">
                        </div>
                        <h5 class="card-title mt-4">Be a Top Achiever</h5>
                        <p class="card-text mt-2">See how you rank among the top achievers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Our Team -->
<section id="our-team" class="py-5">
    <h2 class="text-center pb-2 fw-bold">OUR TEAM</h2>
    <!-- <div class="container-fluid bg-primary text-center py-3">
        <strong class="text-white">MEET OUR TEAM</strong>
    </div> -->
    <div class="container-fluid my-5">
        <div class="card-group gap-5">
            <!-- Adam -->
            <div class="card" style="border:none">
                <img src="<?= BASE_URL; ?>public/assets/images/Adam.svg" class="card-img-top" alt="..." style="height: 300px;">
                <div class="card-body text-center">
                    <h4 class="card-title"><b>An Naastasya</b></h4>
                    <h6>2341760131</h6>
                    <hr>
                    <div class="btn-group-sm" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Back-End</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Front-End</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Database</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">UI/UX</label>
                    </div>
                    <hr>
                    <a class="btn btn-dark w-100" href="https://github.com/Wilssoooonnn" target="_blank">
                        <img class="img-fluid" src="<?= BASE_URL; ?>public/assets/images/github.svg" alt="">
                    </a>
                </div>
            </div>



            <!-- Titan -->
            <div class="card" style="border:none">
                <img src="<?= BASE_URL; ?>public/assets/images/Adam.svg" class="card-img-top" alt="..." style="height: 300px;">
                <div class="card-body text-center">
                    <h4 class="card-title"><b>An Naastasya</b></h4>
                    <h6>2341760131</h6>
                    <hr>
                    <div class="btn-group-sm" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Back-End</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Front-End</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Database</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">UI/UX</label>
                    </div>
                    <hr>
                    <a class="btn btn-dark w-100" href="https://github.com/Wilssoooonnn" target="_blank">
                        <img class="img-fluid" src="<?= BASE_URL; ?>public/assets/images/github.svg" alt="">
                    </a>
                </div>
            </div>

            <!-- Natha -->
            <div class="card" style="border:none">
                <img src="<?= BASE_URL; ?>public/assets/images/natha.svg" class="card-img-top" alt="..." style="height: 300px;">
                <div class="card-body text-center">
                    <h4 class="card-title"><b>An Naastasya</b></h4>
                    <h6>2341760131</h6>
                    <hr>
                    <div class="btn-group-sm" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Database</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Back-End</label>
                    </div>
                    <hr>
                    <a class="btn btn-dark w-100" href="https://github.com/tasyasss" target="_blank">
                        <img class="img-fluid" src="<?= BASE_URL; ?>public/assets/images/github.svg" alt="">
                    </a>
                </div>
            </div>

            <!-- Alvin -->
            <div class="card" style="border:none">
                <img src="<?= BASE_URL; ?>public/assets/images/Adam.svg" class="card-img-top" alt="..." style="height: 300px;">
                <div class="card-body text-center">
                    <h4 class="card-title"><b>An Naastasya</b></h4>
                    <h6>2341760131</h6>
                    <hr>
                    <div class="btn-group-sm" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Back-End</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Front-End</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">Database</label>

                        <input type="checkbox" class="btn-check" id="" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="">UI/UX</label>
                    </div>
                    <hr>
                    <a class="btn btn-dark w-100" href="https://github.com/Wilssoooonnn" target="_blank">
                        <img class="img-fluid" src="<?= BASE_URL; ?>public/assets/images/github.svg" alt="">
                    </a>
                </div>
            </div>
        </div>

</section>