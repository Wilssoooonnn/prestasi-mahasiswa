<div class="container bg-primary mt-3 p-5 rounded-3 d-flex">
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
