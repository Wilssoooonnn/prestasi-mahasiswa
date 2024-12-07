<!-- Sidebar -->
<div class="bg-light p-3 vh-100" id="sidebar" style="width: 250px; position: fixed; top: 0; left: 0; z-index: 1030; transition: transform 0.3s ease;">
    <div class="sidebar-header border-bottom mb-4">
        <div class="sidebar-brand text-center py-3">
            <img src="<?= BASE_URL; ?>public/assets/images/logo.svg" alt="Logo" class="img-fluid" style="height: 40px;">
        </div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= BASE_URL; ?>mahasiswa/dashboard" class="nav-link d-flex align-items-center custom-nav-link">
                <i class="fi fi-rr-house-blank"></i> <span class="ms-3">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL; ?>mahasiswa/profile" class="nav-link d-flex align-items-center custom-nav-link">
                <i class="fi fi-rr-user"></i> <span class="ms-3">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL; ?>mahasiswa/kompetisi" class="nav-link d-flex align-items-center custom-nav-link">
                <i class="fi fi-rr-trophy-star"></i> <span class="ms-3">Kompetisi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL; ?>mahasiswa/help" class="nav-link d-flex align-items-center custom-nav-link">
                <i class="fi fi-rr-interrogation"></i> <span class="ms-3">Help</span>
            </a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="flex-grow-1" id="main-content" style="margin-left: 250px; padding-top: 70px; transition: margin-left 0.3s ease;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <!-- Sidebar toggle button -->
            <button class="btn btn-outline-primary me-3" id="sidebarToggle">☰</button>
            <!-- Brand logo -->
            <a class="navbar-brand" href="#"><?= $_SESSION['role']; ?> Page</a>
            <!-- Navbar toggler for small screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Notification icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fi fi-rr-bell" style="font-size: 20px;"></i>
                        </a>
                    </li>
                    <!-- Avatar dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= BASE_URL; ?>public/assets/images/profile_dummy.jpg"
                                alt="Avatar"
                                class="rounded-circle me-2"
                                style="width: 30px; height: 30px; object-fit: cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                            <li><a class="dropdown-item" href="<?= BASE_URL; ?>mahasiswa/profile">My Profile</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL; ?>auth/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>