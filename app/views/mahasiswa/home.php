<main id="main-wrapper" class="main-wrapper">
    <div class="header">
	<!-- page content -->
    <div id="app-content">

      <div class="app-content-area">

        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="d-flex justify-content-between align-items-center mb-5">
                <h3 class="mb-0 ">Analytics</h3>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
          <div class="bg-primary rounded-3">
            <div class="row mb-5 ">
              <div class="col-lg-12 col-md-12 col-12">
                <div class="p-6 d-lg-flex justify-content-between align-items-center ">
                  <div class="d-md-flex align-items-center">
                    <img src="<?= BASE_URL; ?>public/assets/images/trophy.svg" alt="Image" class="rounded-circle avatar avatar-xl" style="height: 40px;">
                    <div class="ms-md-4 mt-3 mt-md-0 lh-1">
                      <h3 class="text-white mb-0">Good afternoon, Jitu Chauhan</h3>
                      <small class="text-white"> Here is what’s happening with your projects today:</small>
                    </div>
                  </div>
                  <div class="d-none d-lg-block">
                    <a href="#!" class="btn btn-white">What’s New!</a>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6 col-md-12 col-12 mb-5">
              <div class="row row-cols-lg-2 row-cols-1 g-5  ">
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Bounce Rate [Avg]</span>
                        <span><i data-feather="activity" class="text-gray-400"></i></span>

                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">47.74%</h3>

                      </div>
                      <span class="text-danger "><i class="me-1 icon-xs" data-feather="arrow-down" ></i>-26.50%</span>
                      <small>vs 66.88(prev.)</small>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">New Sessions</span>
                        <span><i data-feather="pie-chart" class="text-gray-400"></i></span>

                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">76.40%</h3>

                      </div>
                      <span class=" text-success "><i class="me-1 icon-xs" data-feather="arrow-up" ></i>-2.50%</span>
                      <small>vs 74.60(prev.)</small>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Pageviews [Avg]</span>
                        <span><i data-feather="send" class="text-gray-400"></i></span>

                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">2.15</h3>

                      </div>
                      <span class="text-danger "><i class="me-1 icon-xs" data-feather="arrow-down" ></i>-1.83%</span>
                      <small>vs 2.19 (prev.)</small>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 card-lift">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semi-bold ">Time on Site [Avg]</span>
                        <span><i data-feather="clock" class="text-gray-400"></i></span>

                      </div>
                      <div class="mt-4 mb-2 ">
                        <h3 class="fw-bold mb-0">2m:15s</h3>

                      </div>
                      <span class="text-success "><i class="me-1 icon-xs" data-feather="arrow-up" ></i>21.50%</span>
                      <small>vs 2.19 (prev.)</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-12 col-12 mb-5">
              <div class="card h-100">
                <div class="card-body">
                  <h4 class="mb-0">Session by Device Type</h4>
                  <div class="row row-cols-lg-3  my-8">
                    <div class="col">
                      <div>
                        <h4 class="mb-3">Desktop</h4>
                        <div class="lh-1">
                          <h4 class="fs-2 fw-bold text-info mb-0 ">51.5%</h4>
                          <span class="text-info">201,434</span>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div>
                        <h4 class="mb-3">Mobile</h4>
                        <div class="lh-1">
                          <h4 class="fs-2 fw-bold text-success mb-0 ">34.4%</h4>
                          <span class="text-success">134,693</span>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div>
                        <h4 class="mb-3">Tablet</h4>
                        <div class="lh-1">
                          <h4 class="fs-2 fw-bold text-warning mb-0 ">20.8%</h4>
                          <span class="text-warning">81,525</span>
                        </div>
                      </div>
                    </div>
                    <div class="mt-6 mb-3">
                    <div class="progress" style="height: 40px;">
                      <div class="progress-bar bg-info" role="progressbar" aria-label="Segment one" style="width: 35%"
                        aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-success" role="progressbar" aria-label="Segment two"
                        style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar bg-warning" role="progressbar" aria-label="Segment three"
                        style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div>
                    <small><span class="mdi mdi-lightbulb-outline me-1"></span>How perfformed over the last 30
                      days?</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

                    