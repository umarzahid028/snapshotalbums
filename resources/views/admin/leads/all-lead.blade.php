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
                <!-- <div class="item1 mb15-sm">
                  <div class="search_area">
                    <input type="text" class="form-control bdrs12" placeholder="Search">
                    <label><span class="flaticon-search"></span></label>
                  </div>
                </div> -->
                <!-- <div class="page_control_shorting bdr1 bdrs12 py-2 ps-3 pe-2 mx-1 mx-xxl-3 bgc-white mb15-sm maxw140">
                  <div class="pcs_dropdown d-flex align-items-center"><span class="title-color">Sort by:</span>
                    <select class="selectpicker show-tick">
                      <option>New</option>
                      <option>Best Seller</option>
                      <option>Best Match</option>
                      <option>Price Low</option>
                      <option>Price High</option>
                    </select>
                  </div>
                </div> -->
                <!-- <a href="#" class="ud-btn btn-thm">Add New Property<i class="fal fa-arrow-right-long"></i></a> -->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                  <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                      <tr>
                        <th scope="col">Listing title</th>
                        <th scope="col">Property Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      @foreach($leads as $lead)
                      <tr>
                        <td scope="row">
                          <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
                            <!-- <div class="list-thumb">
                            @if($lead->lead_property_type === 'Forsale')
                              <img class="w-100" src="{{ asset('storage/appforsale/thumbnail/'.$lead->forsale->thumbnail_image) }}" alt="">
                            @elseif($lead->lead_property_type === 'Forlease')
                              <img class="w-100" src="{{ asset('storage/appforlease/thumbnail/'.$lead->forlease->thumbnail_image) }}" alt="">
                            @endif

                            </div> -->
                            <div class="list-content py-0 p-0 mt-2 mt-xxl-0 ps-xxl-4">
                              <div class="h6 list-title">
                                @if($lead->lead_property_type === 'Forsale')
                                    <a>{{$lead->forsale->title}}</a>
                                @elseif($lead->lead_property_type === 'Forlease')
                                    <a>{{$lead->forlease->title}}</a>
                                @endif
                              </div>

                              <!-- @if($lead->lead_property_type === 'Forsale')
                              <p class="list-text mb-0">{{$lead->forsale->address}}</p>
                              @elseif($lead->lead_property_type === 'Forlease')
                              <p class="list-text mb-0">{{$lead->forlease->address}}</p>
                              @endif -->

                              <!-- @if($lead->lead_property_type === 'Forsale')
                              <div class="list-price"><a>$14,000/<span>mo</span></a></div>
                              @elseif($lead->lead_property_type === 'Forlease')
                              <div class="list-price"><a>$14,000/<span>mo</span></a></div>
                              @endif -->
                            </div>
                          </div>
                        </td>
                        <td class="vam">{{$lead->lead_property_type}}</td>
                        <td class="vam">{{$lead->name}}</td>
                        <td class="vam">{{$lead->phone}}</td>
                        <td class="vam">{{$lead->email}}</td>
                        <td class="vam"> <span class="pending-style style1">{{$lead->message}}</span></td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- <div class="mbp_pagination text-center mt30">
                    <ul class="page_navigation">
                      <li class="page-item">
                        <a class="page-link" href="#"> <span class="fas fa-angle-left"></span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item"><a class="page-link" href="#">20</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
                      </li>
                    </ul>
                    <p class="mt10 pagination_page_count text-center">1 – 20 of 300+ property available</p>
                  </div> -->
                </div>
              </div>
            </div>
          </div>


@include('layouts.admin.footer_new')