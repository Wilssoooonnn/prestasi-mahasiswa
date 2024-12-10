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
        <a href="#signupSection" class="btn btn-outline-light btn-lg">Start Now</a>
    </div>
</section>



<!-- Leaderboard Section -->
<section id="leaderboard" class="container py-5">
    <h2 class="text-center mb-4">Top Achievers</h2>

    <!-- Display Top 3 Achievers in Cards -->
    <div class="container d-flex justify-content-center gap-5" style="border:none !important">
        <!-- Top 1 Achiever -->
        <div class="card" style="width: 18rem; border: none;">
            <iframe src="https://lottie.host/embed/e737a588-abbf-4972-b82a-208d934d4f4c/EfR1kYDNOT.lottie"></iframe>
            <div class="card-body">
                <h5 class="card-title">John Doe</h5>
                <p class="card-text">Top Achiever in Computer Science with 50 achievements.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Achievements : 50</li>
                <li class="list-group-item">Program Studi : Computer Science</li>
            </ul>
        </div>

        <!-- Top 2 Achiever -->
        <div class="card" style="width: 18rem; border: none;">
            <iframe src="https://lottie.host/embed/e737a588-abbf-4972-b82a-208d934d4f4c/EfR1kYDNOT.lottie"></iframe>
            <div class="card-body">
                <h5 class="card-title">Jane Smith</h5>
                <p class="card-text">Second place in Engineering with 47 achievements and 280 points.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Achievements : 47</li>
                <li class="list-group-item">Program Studi : Engineering</li>
            </ul>
        </div>

        <!-- Top 3 Achiever -->
        <div class="card" style="width: 18rem; border: none;">
            <iframe src="https://lottie.host/embed/e737a588-abbf-4972-b82a-208d934d4f4c/EfR1kYDNOT.lottie"></iframe>
            <div class="card-body">
                <h5 class="card-title">Bob Johnson</h5>
                <p class="card-text">Ranked third in Biology with 45 achievements and 260 points.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Achievements : 45</li>
                <li class="list-group-item">Program Studi : Biology</li>
            </ul>
        </div>
    </div>

    <!-- Leaderboard Table -->
    <table class="table table-hover mt-5">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Program Studi</th>
                <th>Total Achievements</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>Computer Science</td>
                <td>50</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>Engineering</td>
                <td>47</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Bob Johnson</td>
                <td>Biology</td>
                <td>45</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Alice Brown</td>
                <td>Mathematics</td>
                <td>43</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Sarah White</td>
                <td>Physics</td>
                <td>42</td>
            </tr>
        </tbody>
    </table>
</section>


<!-- Advantages Section -->
<section id="advantages" class="container py-5">
    <h2 class="text-center mb-4">Why Choose Us?</h2>
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card bg-transparent border-primary">
                <div class="card-body">
                    <h5 class="card-title">Comprehensive Tracking</h5>
                    <p class="card-text">Track all your achievements across academics and extracurriculars in one place.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-transparent border-primary">
                <div class="card-body">
                    <h5 class="card-title">Competitive Leaderboard</h5>
                    <p class="card-text">See where you rank among your peers and strive to be at the top.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-transparent border-primary">
                <div class="card-body">
                    <h5 class="card-title">Instant Recognition</h5>
                    <p class="card-text">Earn badges and certificates as you reach milestones in your achievements.</p>
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