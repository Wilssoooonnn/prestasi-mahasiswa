

<div class="container">
    <h1 class="mt-5">HALO, <?= $_SESSION['user']; ?></h1>
    <p>Ini Halaman Dashboard <?= $_SESSION['role']; ?>.</p>
    <a href="<?= BASE_URL; ?>auth/logout">Logout</a>
</div>
