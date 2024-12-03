    <div class="container">
        <h1 class="mt-5">Welcome, <?= $_SESSION['user']; ?></h1>
        <p>This is the <?= $_SESSION['role']; ?> dashboard.</p>
        <a href="<?= BASE_URL; ?>auth/logout">Logout</a>
    </div>