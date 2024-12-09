<div class="container mt-3">

    <!-- Cards Section -->
    <div class="row mb-12">
        <div class="col-md-12">
            <div class="card mb-3 position-relative">
                <!-- Background Image -->
                <div class="background-image position-relative bg-primary" style="height: 40vh;">
                    <!-- Profile Section -->
                    <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="z-index: 1;">
                        <!-- Avatar with Hover Effect -->
                        <div class="profile-img-container">
                            <img id="profileImage" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=2574&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Profile"
                                class="rounded-circle img-fluid border profile-img"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        </div>

                        <button class="btn btn-light rounded-circle position-absolute" id="profileImageUpload" style="width: 40px; height: 40px; left: 52%;">
                            <i class="fi fi-rr-edit"></i>
                        </button>
                        <!-- Name and Role -->
                        <div class="text-white text-center mt-3">
                            <h2 class="mb-1"><?= $dataAdmin[0]['nama']; ?></h2>
                            <p class="mb-0 fw-light"><?= $_SESSION['role']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="row mb-12 mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title mt-3">Profile Details</h5>

                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 label ">ID Pegawai </div>
                                <div class="col-lg-9 col-md-8">: <?= $dataAdmin[0]['no_pegawai'];     ?></div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 label ">Nama</div>
                                <div class="col-lg-9 col-md-8">: <?= $dataAdmin[0]['nama'];     ?></div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">: <?= $dataAdmin[0]['email'];    ?> </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                                <div class="col-lg-9 col-md-8">: <?= $dataAdmin[0]['phone_number'];    ?> </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8">: <?= $dataAdmin[0]['address'];    ?> </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 label">Username</div>
                                <div class="col-lg-9 col-md-8">: <?= $dataAdmin[0]['username'];     ?></div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form action="profileUpdate" method="post" id="form-edit">

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $dataAdmin[0]['nama']; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="text" class="form-control" id="Email" value="<?= $dataAdmin[0]['email']; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newusername" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newusername" type="text" class="form-control" id="newusername" value="<?= $dataAdmin[0]['username']; ?>">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form action="changePassword" method="post" id="form-changepassword">

                                <input name="user" type="hidden" class="form-control" id="user" value="<?= $_SESSION['user']; ?>">
                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Sekarang</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
        </div>
    </div>

</div>