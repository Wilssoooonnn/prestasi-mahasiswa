<div class="container-fluid">
    <!-- PAGE HEADER -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="mb-5">
                <h3 class="mb-0 ">Invoice</h3>
            </div>
        </div>
    </div>
    <!-- PAGE HEADER -->

    <!-- CARD HEADER -->
    <div class="card-header">
        <div class="row g-2">
            <div class="col-lg-6 col-md-5 d-grid d-lg-block">
                <a href="invoice-generator.html" class="btn btn-primary">+ Create New Invoice</a>
            </div>
            <div class="col-md-7 col-lg-4">
                <input type="search" class="form-control w-100" placeholder="Search for Invoice Number, Customer Name">
            </div>
            <div class="col-lg-2 d-flex">
                <select class="form-select">
                    <option selected="">Status</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <a href="#!" class="btn btn-danger-soft  btn-icon ms-2 texttooltip" data-template="trashOne">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon-xs">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    <div id="trashOne" class="d-none">
                        <span>Delete</span>
                    </div>
                </a>

            </div>
        </div>
    </div>
    <!-- CARD HEADER -->
    
    <!-- CARD BODY -->
    <div class="card-body">
                      <div class="table-responsive table-card">
                        <table class="table text-nowrap mb-0 table-centered">
                          <thead class="table-light">
                            <tr>
                              <th class="ps-0">Invoices</th>
                              <th>Status</th>
                              <th>Customer Info</th>
                              <th>Date</th>
                              <th>Email</th>
                              <th>Amount</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="ps-0">
                                <a href="#!">#88120</a>
                              </td>
                              <td>
                                <span class="badge badge-warning-soft text-warning">Pending</span>
                              </td>
                              <td class="ps-1">
                                <div class="d-flex align-items-center">
                                  <div class="ms-2">
                                    <h5 class="mb-0"> <a href="#!" class="text-inherit">Jan Harmon</a></h5>
                                  </div>
                                </div>
                              </td>
                              <td>19 Apr 2023</td>

                              <td>michaelbaggett@dayrep.com</td>
                              <td>$35.99</td>
                              
                            </tr>
                            <tr>
                              <td class="ps-0">
                                <a href="#!">#88119</a>
                              </td>
                              <td>
                                <span class="badge badge-success-soft text-success">Paid</span>
                              </td>
                              <td class="ps-1">
                                <div class="d-flex align-items-center">
                                  <div class="ms-2">
                                    <h5 class="mb-0"> <a href="#!" class="text-inherit">Helen Mullins</a></h5>
                                  </div>
                                </div>
                              </td>
                              <td>18 Apr 2023</td>

                              <td>helenmullins@dayrep.com</td>
                              <td>$135.99</td>
                              <td>
                                <div>
                                  <div class="dropdown">
                                    <a class="btn btn-ghost btn-icon btn-sm rounded-circle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye me-2 icon-xs"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>View
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit me-2 icon-xs"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download me-2 icon-xs"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>Download
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 me-2 icon-xs"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete
                                        </a>

                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="ps-0">
                                <a href="#!">#88118</a>
                              </td>
                              <td>
                                <span class="badge badge-success-soft text-success">Paid</span>
                              </td>
                              <td class="ps-1">
                                <div class="d-flex align-items-center">
                                  <div class="ms-2">
                                    <h5 class="mb-0"> <a href="#!" class="text-inherit">Agnes Addison</a></h5>
                                  </div>
                                </div>
                              </td>
                              <td>16 Apr 2023</td>

                              <td>agnesaddison@gmail.com</td>
                              <td>$235.99</td>
                              <td>
                                <div>
                                  <div class="dropdown">
                                    <a class="btn btn-ghost btn-icon btn-sm rounded-circle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye me-2 icon-xs"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>View
                                        </a>



                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit me-2 icon-xs"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit
                                        </a>



                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download me-2 icon-xs"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>Download
                                        </a>


                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 me-2 icon-xs"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete
                                        </a>

                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="ps-0">
                                <a href="#!">#88117</a>
                              </td>
                              <td>
                                <span class="badge badge-success-soft text-success">Paid</span>
                              </td>
                              <td class="ps-1">
                                <div class="d-flex align-items-center">
                                  <div class="ms-2">
                                    <h5 class="mb-0"> <a href="#!" class="text-inherit">Justin Holtz</a></h5>
                                  </div>
                                </div>
                              </td>
                              <td>16 Apr 2023</td>

                              <td>justinholtz@gmail.com</td>
                              <td>$235.23</td>
                              <td>
                                <div>
                                  <div class="dropdown">
                                    <a class="btn btn-ghost btn-icon btn-sm rounded-circle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye me-2 icon-xs"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>View
                                        </a>



                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit me-2 icon-xs"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit
                                        </a>



                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download me-2 icon-xs"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>Download
                                        </a>


                                        <a class="dropdown-item d-flex align-items-center" href="#!">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 me-2 icon-xs"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete
                                        </a>

                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
    <!-- CARD BODY -->

    <!-- CARD FOOTER -->
    <div class="card-footer d-md-flex justify-content-between align-items-center ">
                      <span>Showing 1 to 8 of 12 entries</span>
                      <nav class="mt-2 mt-md-0">
                        <ul class="pagination mb-0 ">
                          <li class="page-item">
                            <a class="page-link" href="#!">Previous</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link active" href="#!">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#!">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#!">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#!">Next</a>
                          </li>
                          </ul>

                      </nav>
                    </div>
    <!-- CARD FOOTER -->

