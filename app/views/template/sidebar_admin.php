<div class="d-flex">
    <!-- Sidebar -->

    <div id="sidebar" class="sidebar expanded">

        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between mt-5 px-3">
            <div class="d-flex align-items-center">
                <img src="<?= BASE_URL; ?>public/assets/images/head-logo.svg" alt="Logo" class="img-fluid" style="height: 40px;">
                <a href="#" class="navbar-brand ml-2 font-weight-bold">PRESMA</a>
            </div>
        </div>

        <!-- Navigasi Links -->
        <nav class="nav flex-column mt-5">
            <a href="#" class="nav-link mt-2">
                <i class="material-icons">home</i> <span>Home</span>
            </a>

            <a href="#" class="nav-link mt-2">
                <i class="material-icons">person</i> <span>Profile</span>
            </a>

            <a href="#" class="nav-link mt-2">
                <i class="material-icons">settings</i> <span>Settings</span>
            </a>

            <a href="#" class="nav-link mt-2">
                <i class="material-icons">emoji_events</i> <span>Kompetisi</span>
            </a>

            <a href="#" class="nav-link mt-2">
                <i class="material-icons">help</i> <span>Help</span>
            </a>
        </nav>

    </div>
    <button id="toggleBtn" class="btn btn-primary mt-5 py-3 px-3">
        <i class="material-icons" id="arrowIcon">play_arrow</i>
    </button>
</div>