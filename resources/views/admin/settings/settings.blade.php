@include('layouts.admin.header_new')

<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
              @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif
                <h4 class="title fz17 mb30">Change password</h4>
                <!-- <form class="form-style1"> -->
                  <form method="POST" action="{{ route('admin.myprofile.store') }}"  enctype="multipart/form-data"  class="form-style1">
                  @csrf
                  <!-- <div class="row">
                    <div class="col-sm-6 col-xl-4">
                      <div class="mb20">
                        <label class="heading-color ff-heading fw600 mb10">Old Password</label>
                        <input type="text" class="form-control" placeholder="Your Name">
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-sm-6 col-xl-4">
                      <div class="mb20">
                        <label class="heading-color ff-heading fw600 mb10">New Password</label>
                        <input type="password" id="newPassword" name="password" class="form-control" required>
                      </div>
                    </div>
                   
                    <div class="col-md-12">
                      <div class="text-end">
                        <button class="ud-btn btn-dark" type="submit">Change Password<i class="fal fa-arrow-right-long"></i></button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>


@include('layouts.admin.footer_new')
