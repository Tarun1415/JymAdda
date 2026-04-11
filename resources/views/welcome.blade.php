   
   @extends('partner.layouts.app')
@section('content')
   
   <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
       
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-body position-relative">
                  <div class="text-center">
                    <div class="chat-avtar d-inline-flex mx-auto">
                      <img class="rounded-circle img-fluid wid-120" src="../assets/images/user/avatar-5.jpg"
                        alt="User image">
                    </div>
                    <h5 class="mt-3">Stebin Ben</h5>
                    <p class="text-muted">Full Stack Developer</p>
                    <ul class="list-inline ms-auto mb-0">
                      <li class="list-inline-item">
                        <a href="#" class="avtar avtar-xs btn-light-facebook">
                          <i class="ti ti-brand-facebook f-18"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="avtar avtar-xs btn-light-twitter">
                          <i class="ti ti-brand-twitter f-18"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="avtar avtar-xs btn-light-linkedin">
                          <i class="ti ti-brand-linkedin f-18"></i>
                        </a>
                      </li>
                    </ul>
                    <div class="row g-3 my-4">
                      <div class="col-4">
                        <h5 class="mb-0">86</h5>
                        <small class="text-muted">Post</small>
                      </div>
                      <div class="col-4 border border-top-0 border-bottom-0">
                        <h5 class="mb-0">40</h5>
                        <small class="text-muted">Project</small>
                      </div>
                      <div class="col-4">
                        <h5 class="mb-0">4.5K</h5>
                        <small class="text-muted">Members</small>
                      </div>
                    </div>
                  </div>
                  <div class="nav flex-column nav-pills list-group list-group-flush user-sett-tabs" id="user-set-tab"
                    role="tablist" aria-orientation="vertical">
                    <a class="nav-link list-group-item list-group-item-action active" id="user-tab-1"
                      data-bs-toggle="pill" href="#user-cont-1" role="tab">
                      <span class="f-w-500"><i class="ti ti-user m-r-10"></i>Personal Information</span>
                    </a>
                    <a class="nav-link list-group-item list-group-item-action" id="user-tab-2" data-bs-toggle="pill"
                      href="#user-cont-2" role="tab">
                      <span class="f-w-500"><i class="ti ti-credit-card m-r-10"></i>Payment</span>
                    </a>
                    <a class="nav-link list-group-item list-group-item-action" id="user-tab-3" data-bs-toggle="pill"
                      href="#user-cont-3" role="tab">
                      <span class="f-w-500"><i class="ti ti-lock m-r-10"></i>Change Password</span>
                    </a>
                    <a class="nav-link list-group-item list-group-item-action" id="user-tab-4" data-bs-toggle="pill"
                      href="#user-cont-4" role="tab">
                      <span class="f-w-500"><i class="ti ti-settings m-r-10"></i>settings</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="tab-content" id="user-set-tabContent">
                <div class="tab-pane fade show active" id="user-cont-1" role="tabpanel">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <h5>Personal Information</h5>
                          <hr class="mb-4">
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" value="Stebin">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" value="Ben">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" value="stebin.ben@gmail.com">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Date of Birth (+18)</label>
                            <input type="date" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Phone Number">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Designation</label>
                            <input type="text" class="form-control" placeholder="Designation">
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-12">
                          <h5 class="mt-4">Address</h5>
                          <hr class="mb-4">
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Address 01</label>
                            <textarea
                              class="form-control">3801 Chalk Butte Rd, Cut Bank, MT 59427, United States</textarea>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Address 02</label>
                            <textarea class="form-control">301 Chalk Butte Rd, Cut Bank, NY 96572, New York</textarea>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">Country</label>
                            <select class="form-select">
                              <option>United States</option>
                              <option>United States 1</option>
                              <option>United States 2</option>
                              <option>United States 3</option>
                              <option>United States 4</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" value="California">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h5 class="mt-4">Skills</h5>
                          <hr class="mb-4">
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <select class="form-control" name="pc_product_tag3" id="pc_product_tag3" multiple>
                              <option value="Choice 1" selected>Adobe XD</option>
                              <option value="Choice 2" selected>Angular</option>
                              <option value="Choice 3" selected>Corel Draw</option>
                              <option value="Choice 4" selected>Figma</option>
                              <option value="Choice 5" selected>HTML</option>
                              <option value="Choice 6" selected>Illustrator</option>
                              <option value="Choice 7" selected>Javascript</option>
                              <option value="Choice 8" selected>Logo Design</option>
                              <option value="Choice 9" selected>Material UI</option>
                              <option value="Choice 10" selected>NodeJS</option>
                              <option value="Choice 11" selected>npm</option>
                              <option value="Choice 12" selected>Photoshop</option>
                              <option value="Choice 13" selected>React</option>
                              <option value="Choice 14" selected>Reduxjs - tooltit</option>
                              <option value="Choice 15" selected>SASS</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <h5 class="mt-4">Note</h5>
                          <hr class="mb-4">
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <textarea
                              class="form-control">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <div class="btn btn-primary">Save</div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="user-cont-2" role="tabpanel">
                  <div class="card">
                    <div class="card-body">
                      <h5>Payment</h5>
                      <hr class="mb-4">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                            role="tab" aria-controls="pills-home" aria-selected="true">Card</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                            role="tab" aria-controls="pills-profile" aria-selected="false">Paypal</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                          aria-labelledby="pills-home-tab">
                          <div class="row mb-2">
                            <div class="col-lg-6">
                              <div class="border card p-3">
                                <div class="form-check">
                                  <input type="radio" name="radio1" class="form-check-input input-primary"
                                    id="customCheckdef1">
                                  <label class="form-check-label d-block" for="customCheckdef1">
                                    <span class="d-flex align-items-center justify-content-between">
                                      <span>
                                        <span class=" mb-2 text-muted d-block">Selena Litten</span>
                                        <span class="h5 mb-0">**** **** **** 3456</span>
                                      </span>
                                      <span class="d-inline-flex align-items-center">
                                        <span class="mx-3"
                                          style="background: url('../assets/images/application/card.png'); width: 33px; height: 20px;"></span>
                                        <a href="#" class="avtar avtar-xs btn-link-danger">
                                          <i class="ti ti-trash f-18"></i>
                                        </a>
                                      </span>
                                    </span>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="border card p-3">
                                <div class="form-check">
                                  <input type="radio" name="radio1" class="form-check-input input-primary"
                                    id="customCheckdef2">
                                  <label class="form-check-label d-block" for="customCheckdef2">
                                    <span class="d-flex align-items-center justify-content-between">
                                      <span>
                                        <span class=" mb-2 text-muted d-block">Stebin Ben</span>
                                        <span class="h5 mb-0">**** **** **** 7654</span>
                                      </span>
                                      <span class="d-inline-flex align-items-center">
                                        <span class="mx-3"
                                          style="background: url('../assets/images/application/card.png'); width: 33px; height: 20px; background-position: right;"></span>
                                        <a href="#" class="avtar avtar-xs btn-link-danger">
                                          <i class="ti ti-trash f-18"></i>
                                        </a>
                                      </span>
                                    </span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" value="stebin.ben@gmail.com">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <div class="btn btn-primary">Save</div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="user-cont-3" role="tabpanel">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <h5>Change Password</h5>
                          <hr class="mb-4">
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control">
                          </div>
                          <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control">
                          </div>
                          <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <h5>New password must contain:</h5>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="ti ti-minus me-2"></i> At least 8 characters</li>
                            <li class="list-group-item"><i class="ti ti-minus me-2"></i> At least 1 lower letter (a-z)</li>
                            <li class="list-group-item"><i class="ti ti-minus me-2"></i> At least 1 uppercase letter (A-Z)</li>
                            <li class="list-group-item"><i class="ti ti-minus me-2"></i> At least 1 number (0-9)</li>
                            <li class="list-group-item"><i class="ti ti-minus me-2"></i> At least 1 special characters</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <div class="btn btn-primary">Save</div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="user-cont-4" role="tabpanel">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <h5>Settings</h5>
                          <hr class="mb-4">
                        </div>
                        <div class="col-sm-12">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-file-invoice me-3 f-36 text-primary"></i>
                                  <div>
                                    <h5 class="mb-1">Order Confirmation</h5>
                                    <p class="text-muted text-sm mb-0">You will be notified when customer order any product</p>
                                  </div>
                                </div>
                                <div class="form-check form-switch p-0">
                                  <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch" checked>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-mail me-3 f-36 text-primary"></i>
                                  <div>
                                    <h5 class="mb-1">Setup Email Notification</h5>
                                    <p class="text-muted text-sm mb-0">Turn on email notification to get updates through email</p>
                                  </div>
                                </div>
                                <div class="form-check form-switch p-0">
                                  <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch">
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-notification me-3 f-36 text-primary"></i>
                                  <div>
                                    <h5 class="mb-1">Update System Notification</h5>
                                    <p class="text-muted text-sm mb-0">You will be notified when customer order any product</p>
                                  </div>
                                </div>
                                <div class="form-check form-switch p-0">
                                  <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch" checked>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                  <i class="ti ti-writing-sign me-3 f-36 text-primary"></i>
                                  <div>
                                    <h5 class="mb-1">Language Change</h5>
                                    <p class="text-muted text-sm mb-0">You will be notified when customer order any product</p>
                                  </div>
                                </div>
                                <div class="form-check form-switch p-0">
                                  <input class="form-check-input h4 position-relative m-0" type="checkbox" role="switch" checked>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end btn-page">
                      <div class="btn btn-outline-secondary">Cancel</div>
                      <div class="btn btn-primary">Save</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>

      @endsection