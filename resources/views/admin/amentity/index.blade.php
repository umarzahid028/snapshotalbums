@include('layouts.admin.header_new')

<div class="row align-items-center pb40">
            <div class="col-xxl-3">
              <div class="dashboard_title_area">
                <h2>My Leads</h2>
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
                        <th scope="col">Amentity title</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      @foreach($amentity as $amentities)
                      <tr>
                        
                        <td class="vam">{{$amentities->amentities}}</td>
                        <td class="vam">
                          <div class="d-flex">
                           
                            

                            <form action="{{route('admin.amentity.destroy', $amentities->id)}}" method="POST" class="">
														@method('delete')
														@csrf
														<button class="icon"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></button>
                          </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
         
                </div>
              </div>
            </div>
          </div>


@include('layouts.admin.footer_new')