<!-- Container fluid -->
<div class="app-content-area">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->
        <div
          class="pt-20 rounded-top"
          style="
            background: url(../assets/images/background/profile-cover.jpg)
              no-repeat;
            background-size: cover;
          "></div>
        <div class="card rounded-bottom rounded-0 smooth-shadow-sm mb-5">
          <div
            class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
            <div class="d-flex align-items-center">
              <!-- avatar -->
              <div
                class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                <img src="<?= BASE_URL; ?>public/assets/images/logo-2.svg" alt="Image" class="rounded-circle avatar avatar-xl" style="height: 40px;">
                <a href="#!" class="position-absolute top-0 right-0 me-2">
                  <img src="../assets/images/svg/checked-mark.svg" alt="Image"
                    class="icon-sm">
                </a>
              </div>
              <!-- text -->
              <div class="lh-1">
                <h2 class="mb-0">
                  Jitu Chauhan
                  <a
                    href="#!"
                    class="text-decoration-none">
                  </a>
                </h2>
                <p class="mb-0 d-block">@imjituchauhan</p>
              </div>
            </div>
            <div>
              <a
                href="#!"
                class="btn btn-outline-primary d-none d-md-block">Edit Profile</a>
            </div>
          </div>
          <!-- nav -->
          <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="profile-overview.html">Overview</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile-project.html">Project</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="profile-files.html">Files</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile-team.html">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile-followers.html"> Followers </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile-activity.html">Activity</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- content -->
    <div>
      <!-- row -->
      <div class="row">
        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-5">
          <!-- card -->
          <div class="card h-100">
            <!-- card body -->
            <div class="card-header">
              <h4 class="mb-0">About Me</h4>
            </div>
            <div class="card-body">
              <!-- card title -->

              <h5 class="text-uppercase">Bio</h5>
              <!-- text -->
              <p class="mt-2 mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Suspen disse var ius enim in eros elementum tristique.
                Duis cursus, mi quis viverra ornare, eros dolor interdum
                nulla, ut commodo diam libero vitae erat.
              </p>
              <!-- row -->
              <div class="row">
                <div class="col-12 mb-5">
                  <!-- text -->
                  <h5 class="text-uppercase">Position</h5>
                  <p class="mb-0">Theme designer at Gumroad.</p>
                </div>
                <div class="col-6 mb-5">
                  <h5 class="text-uppercase">Phone</h5>
                  <p class="mb-0">+32112345689</p>
                </div>
                <div class="col-6 mb-5">
                  <h5 class="text-uppercase">
                    Date of Birth
                  </h5>
                  <p class="mb-0">01.10.1997</p>
                </div>
                <div class="col-6">
                  <h5 class="text-uppercase">Email</h5>
                  <p class="mb-0">Dashui@gmail.com</p>
                </div>
                <div class="col-6">
                  <h5 class="text-uppercase">Location</h5>
                  <p class="mb-0">Ahmedabad, India</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-5">
          <!-- card -->
          <div class="card">
            <div class="card-header">
              <h4 class="mb-0">Projects Contributions</h4>
            </div>
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->

              <div
                class="d-md-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                  <div>
                    <div>
                      <img
                        src="../assets/images/svg/brand-logo-1.svg"
                        alt="Image">
                    </div>
                  </div>
                  <!-- text -->
                  <div class="ms-3">
                    <h5 class="mb-1">
                      <a href="#!" class="text-inherit">Slack Figma Design UI</a>
                    </h5>
                    <p class="mb-0 fs-5 text-muted">
                      Project description and details about...
                    </p>
                  </div>
                </div>
                <div
                  class="d-flex align-items-center ms-10 ms-md-0 mt-3">
                  <!-- avatar group -->
                  <div class="avatar-group me-2">
                    <!-- img -->
                    <span class="avatar avatar-sm">
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-11.jpg"
                        class="rounded-circle">
                    </span>
                    <!-- img -->
                    <span class="avatar avatar-sm">
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-2.jpg"
                        class="rounded-circle">
                    </span>
                    <!-- img -->
                    <span class="avatar avatar-sm">
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-3.jpg"
                        class="rounded-circle">
                    </span>
                  </div>
                  <div>
                    <!-- dropdown -->
                    <div class="dropdown dropstart">
                      <a
                        href="#!"
                        class="btn btn-ghost btn-icon btn-sm rounded-circle"
                        id="dropdownprojectOne"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i
                          data-feather="more-vertical"
                          class="icon-xs"></i>
                      </a>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownprojectOne">
                        <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="d-md-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                  <div>
                    <!-- icon shape -->
                    <div>
                      <img
                        src="../assets/images/svg/brand-logo-2.svg"
                        alt="Image">
                    </div>
                  </div>
                  <!-- text -->
                  <div class="ms-3">
                    <h5 class="mb-1">
                      <a href="#!" class="text-inherit">Design 3d Character</a>
                    </h5>
                    <p class="mb-0 fs-5 text-muted">
                      Project description and details about...
                    </p>
                  </div>
                </div>

                <div
                  class="d-flex align-items-center ms-10 ms-md-0 mt-3">
                  <!-- avatar group -->
                  <div class="avatar-group me-2">
                    <span class="avatar avatar-sm">
                      <!-- img -->
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-4.jpg"
                        class="rounded-circle">
                    </span>
                    <span class="avatar avatar-sm">
                      <!-- img -->
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-5.jpg"
                        class="rounded-circle">
                    </span>
                    <span class="avatar avatar-sm">
                      <!-- img -->
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-6.jpg"
                        class="rounded-circle">
                    </span>
                  </div>
                  <div>
                    <!-- dropdown -->
                    <div class="dropdown dropstart">
                      <a
                        href="#!"
                        class="btn btn-ghost btn-icon btn-sm rounded-circle"
                        id="dropdownprojectTwo"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i
                          data-feather="more-vertical"
                          class="icon-xs"></i>
                      </a>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownprojectTwo">
                        <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="d-md-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                  <div>
                    <!-- icon shape -->
                    <div>
                      <img
                        src="../assets/images/svg/brand-logo-3.svg"
                        alt="Image">
                    </div>
                  </div>
                  <!-- text -->
                  <div class="ms-3">
                    <h5 class="mb-1">
                      <a href="#!" class="text-inherit">Github Development</a>
                    </h5>
                    <p class="mb-0 fs-5 text-muted">
                      Project description and details about...
                    </p>
                  </div>
                </div>
                <div
                  class="d-flex align-items-center ms-10 ms-md-0 mt-3">
                  <!-- avatar group -->
                  <div class="avatar-group me-2">
                    <span class="avatar avatar-sm">
                      <!-- img -->
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-7.jpg"
                        class="rounded-circle">
                    </span>
                    <span class="avatar avatar-sm">
                      <!-- img -->
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-8.jpg"
                        class="rounded-circle">
                    </span>
                    <span class="avatar avatar-sm">
                      <!-- img -->
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-9.jpg"
                        class="rounded-circle">
                    </span>
                  </div>
                  <div>
                    <!-- dropdown -->
                    <div class="dropdown dropstart">
                      <a
                        href="#!"
                        class="btn btn-ghost btn-icon btn-sm rounded-circle"
                        id="dropdownprojectThree"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i
                          data-feather="more-vertical"
                          class="icon-xs"></i>
                      </a>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownprojectThree">
                        <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="d-md-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                  <!-- icon shape -->
                  <div>
                    <div>
                      <img
                        src="../assets/images/svg/brand-logo-4.svg"
                        alt="Image">
                    </div>
                  </div>
                  <!-- text -->
                  <div class="ms-3">
                    <h5 class="mb-1">
                      <a href="#!" class="text-inherit">Dropbox Design System</a>
                    </h5>
                    <p class="mb-0 fs-5 text-muted">
                      Project description and details about...
                    </p>
                  </div>
                </div>
                <div
                  class="d-flex align-items-center ms-10 ms-md-0 mt-3">
                  <!-- avatar group -->
                  <div class="avatar-group me-2">
                    <!-- img -->
                    <span class="avatar avatar-sm">
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-10.jpg"
                        class="rounded-circle">
                    </span>
                    <!-- img -->
                    <span class="avatar avatar-sm">
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-11.jpg"
                        class="rounded-circle">
                    </span>
                    <!-- img -->
                    <span class="avatar avatar-sm">
                      <img
                        alt="avatar"
                        src="../assets/images/avatar/avatar-12.jpg"
                        class="rounded-circle">
                    </span>
                  </div>
                  <div>
                    <!-- dropdown -->
                    <div class="dropdown dropstart">
                      <a
                        href="#!"
                        class="btn btn-ghost btn-icon btn-sm rounded-circle"
                        id="dropdownprojectFour"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i
                          data-feather="more-vertical"
                          class="icon-xs"></i>
                      </a>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownprojectFour">
                        <a class="dropdown-item d-flex align-items-center" href="#!">Action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Another action</a>
                        <a class="dropdown-item d-flex align-items-center" href="#!">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>