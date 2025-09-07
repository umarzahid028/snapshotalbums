@include('layouts.admin.header_new')

<div class="row align-items-center pb40">
            <div class="col-xxl-3">
              <div class="dashboard_title_area">
                <h2>Albums</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
            <div class="col-xxl-9">
              <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
             
            </div>
            </div>
          </div>
          <div class="row">
              @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                  <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Folder</th>
                        <th scope="col">Date</th>
                        <th scope="col">Gallery</th>
                        <th scope="col">Album</th>
                        <th scope="col">Web Link</th>
                        <th scope="col">QR Code</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      <tr>
                        <td class="vam">Event Title</td>
                        <td class="vam">Google Drive&trade; Folder Name</td>
                        <td class="vam">2023-07-26</td>
                        <td> <b> <a href="{{route('admin.stripe')}}"  style="color: #A88156;">Enabled</a></b></td>
                        <td><a href="{{route('admin.album.show', 1)}}" class="ud-btn btn-thm">GO</a></td>
                        <td><a href="#" class="ud-btn btn-thm">Copy</a></td>
                        <td><a href="#" class="ud-btn btn-thm">View</a></td>
                        <td> <b> <a href=""  style="color: red;">Delete</a></b></td>
                      </tr>
                    </tbody>
                  </table>
         
                </div>
              </div>
            </div>
          </div>


@include('layouts.admin.footer_new')