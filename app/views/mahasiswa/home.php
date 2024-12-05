<main id="main-wrapper" class="main-wrapper">
  <div class="header">
    <!-- page content -->
    <div id="app-content">
      <div class="app-content-area">
        <!-- start card welcome -->
        <div class="container-fluid">
          <div class="bg-primary rounded-3">
            <div class="row mb-5 ">
              <div class="col-lg-12 col-md-12 col-12">
                <div class="p-6 d-lg-flex justify-content-between align-items-center ">
                  <div class="d-md-flex align-items-center">
                    <img src="<?= BASE_URL; ?>public/assets/images/trophy.svg" alt="Image" class="rounded-circle avatar avatar-xl" style="height: 40px;">
                    <div class="ms-md-4 mt-3 mt-md-0 lh-1">
                      <h1 class="text-white mb-0">Welcome, <?= $_SESSION['user']; ?></h1>
                      <small class="text-white"> Here is what's happening with your projects today : </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end card welcome -->

          <!-- card  bottom-->
          <div class="row">
            <div class="col-xl-12 col-md-12 col-12 mb-5">
              <div class="row row-cols-lg-4 row-cols-1 g-5">
                <!-- start card jumlah kompetisi -->
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Jumlah Kompetisi</span>
                        <span><i data-feather="activity" class="text-gray-400"></i></span>
                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">47.74%</h3>
                      </div>
                      <span class="text-danger "><i class="me-1 icon-xs" data-feather="arrow-down"></i>-26.50%</span>
                      <small>vs 66.88(prev.)</small>
                    </div>
                  </div>
                </div>
                <!-- end card jumlah kompetisi-->

                <!-- start card kompetisi terverifikasi -->
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Jumlah Kompetisi Terverifikasi</span>
                        <span><i data-feather="pie-chart" class="text-gray-400"></i></span>
                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">76.40%</h3>
                      </div>
                      <span class=" text-success "><i class="me-1 icon-xs" data-feather="arrow-up"></i>-2.50%</span>
                      <small>vs 74.60(prev.)</small>
                    </div>
                  </div>
                </div>
                <!-- end card kompetisi terverifikasi -->

                <!-- start card kompetisi tertolak -->
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Jumlah Kompetisi Ditolak</span>
                        <span><i data-feather="send" class="text-gray-400"></i></span>
                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">2.15</h3>
                      </div>
                      <span class="text-danger "><i class="me-1 icon-xs" data-feather="arrow-down"></i>-1.83%</span>
                      <small>vs 2.19 (prev.)</small>
                    </div>
                  </div>
                </div>
                <!-- start card kompetisi tertolak -->

                <!-- start card kompetisi pending -->
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Jumlah Kompetisi Pending</span>
                        <span><i data-feather="clock" class="text-gray-400"></i></span>
                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">2m:15s</h3>
                      </div>
                      <span class="text-success "><i class="me-1 icon-xs" data-feather="arrow-up"></i>21.50%</span>
                      <small>vs 2.19 (prev.)</small>
                    </div>
                  </div>
                </div>
                <!-- end card kompetisi pending -->
              </div>
              <!-- row -->
              <div class="row mt-5">
                <!-- col -->
                <div class="col-12">
                  <!-- card -->
                  <!-- table -->
                  <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-centered">
                      <thead class="table-light">
                        <tr>
                          <th>Judul Kompetisi</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h4 class="mb-0 fs-5"><a href="#!" class="text-inherit">Web Application Design</a></h4>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge badge-success-soft text-dark-success">Completed</span>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h4 class="mb-0 fs-5"><a href="#!" class="text-inherit">Web Application Design</a></h4>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge badge-warning-soft text-dark-warning">Pending</span>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h4 class="mb-0 fs-5"><a href="#!" class="text-inherit">Web Application Design</a></h4>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge badge-danger-soft text-dark-danger">Cancel</span>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <h4 class="mb-0 fs-5"><a href="#!" class="text-inherit">Web Application Design</a></h4>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="badge badge-success-soft text-dark-success">Completed</span>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="7">
                            <div class="d-flex align-items-center">
                              <a href="#!" class="text-muted border border-2 rounded-3 card-dashed-hover" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                                <div class="icon-shape icon-lg fs-3 ">
                                  +
                                </div>
                              </a>
                              <div class="ms-3">
                                <h4 class="mb-0 fs-5"><a href="#!" class="text-inherit">New Project</a></h4>
                              </div>
                            </div>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- card bottom -->