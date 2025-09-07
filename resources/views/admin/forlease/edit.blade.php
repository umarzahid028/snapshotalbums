@include('layouts.admin.header_new')

  <div class="row align-items-center pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>Edit Property For Lease</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ui-content">
              <div class="message-alart-style1">
                <div class="alert alart_style_three alert-dismissible fade show mb20" role="alert" id="error-message" style="display: none;">
                  
                  <i class="far fa-xmark btn-close" data-bs-dismiss="alert" aria-label="Close"></i>
                </div>
                <div class="alert alart_style_four alert-dismissible fade show mb20" role="alert" id="success-message" style="display: none;">
                 
                  <i class="far fa-xmark btn-close" data-bs-dismiss="alert" aria-label="Close"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 pt30 mb30 overflow-hidden position-relative">
                <div class="navtab-style1">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab2" role="tablist">
                    <button class="nav-link active fw600 ms-3" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">1. Description</button>
                    <button class="nav-link fw600" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">2. Media</button>
                    <button class="nav-link fw600" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">3. Lot Sale Detail</button>
                    <button class="nav-link fw600" id="nav-item4-tab" data-bs-toggle="tab" data-bs-target="#nav-item4" type="button" role="tab" aria-controls="nav-item4" aria-selected="false">4. Zoning & Taxes</button>
                    <button class="nav-link fw600" id="nav-item5-tab" data-bs-toggle="tab" data-bs-target="#nav-item5" type="button" role="tab" aria-controls="nav-item5" aria-selected="false">5. Amenities</button>
                  </div>
                </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                      <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Property Description</h4>
                        @foreach($forleases as $forlease)
                      
                          <form id="myform">
                          @csrf
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" name="id" value="{{ $forlease->id }}">
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Title</label>
                                <input type="text" name="title" class="form-control" value="{{$forlease->title}}" placeholder="Title">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Secondary Type</label>
                                <div class="location-area">
                                <select class="selectpicker" name="secondary_type">
                                    <option value="Multifamily" {{ $forlease->secondary_type == 'Multifamily' ? 'selected' : '' }}>Multifamily</option>
                                    <option value="Industrial" {{ $forlease->secondary_type == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                                    <option value="Mixed Use" {{ $forlease->secondary_type == 'Mixed Use' ? 'selected' : '' }}>Mixed Use</option>
                                    <option value="Retail" {{ $forlease->secondary_type == 'Retail' ? 'selected' : '' }}>Retail</option>
                                    <option value="Restaurant" {{ $forlease->secondary_type == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                                    <option value="Office" {{ $forlease->secondary_type == 'Office' ? 'selected' : '' }}>Office</option>
                                    <option value="Land" {{ $forlease->secondary_type == 'Land' ? 'selected' : '' }}>Land</option>
                                </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Floor & Suit</label>
                                <input type="text" class="form-control" name="floor_suit" value="{{$forlease->floor_suit}}" placeholder="Floor & Suit">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Space Available</label>
                                <input type="text" class="form-control" name="space_available" value="{{$forlease->space_available}}" placeholder="Space Available">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Rent</label>
                                <input type="text" class="form-control" name="rent" value="{{$forlease->rent}}" placeholder="Rent">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Lease Type</label>
                                <input type="text" class="form-control" name="lease_type" value="{{$forlease->lease_type}}" placeholder="Lease Type">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Address</label>
                                <input type="text" name="address" id="autocomplete" class="form-control" value="{{$forlease->address}}" placeholder="Choose Location" required>
                              </div>
                              <div class="mb20" id="latitudeArea" hidden>
                                <label class="heading-color ff-heading fw600 mb10">Latitude</label>
                                <input type="text" id="latitude" name="latitude" value="{{$forlease->latitude}}" class="form-control">
                              </div>
                              <div class="mb20" id="longtitudeArea" hidden>
                                <label class="heading-color ff-heading fw600 mb10">Longitude</label>
                                <input type="text" name="longitude" id="longitude" value="{{'$forlease->longitude'}}" class="form-control">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="d-sm-flex justify-content-between">
                                  <a id="nextButtonMedia" class="ud-btn btn-dark" href="#">Next Step<i class="fal fa-arrow-right-long"></i></a>
                                </div>
                              </div>
                            </div>
                        </div>

                      </div>
                    </div>
                    <!-- media -->
                    <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">                      
                      <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                      <h4 class="title fz17 mb30">Thumbnail Photo</h4>
                      <div class="col-lg-12">
                        <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">
                          <div class="icon mb30"><span class="flaticon-upload"></span></div>
                          <h4 class="title fz17 mb10">Upload photos of your property</h4>
                          <p class="text mb25">Photos must be JPEG or PNG format and at least 2048x768</p>
                          <label class="ud-btn btn-white" for="thumbnailFileInput">Browse File
                            <input type="file" name="thumbnail_image" id="thumbnailFileInput" accept=".jpg, .jpeg, .png" style="display: none;">
                            <i class="fal fa-arrow-right-long"></i>
                          </label>
                        </div>
                      </div>
                      <!-- thumbnail image -->
                      <div class="col-lg-5">
                          <div class="profile-box position-relative d-md-flex align-items-end mb50">
                            <div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm">
                              <img class="w-100" src="{{ asset('storage/appforlease/thumbnail/'.$forlease->thumbnail_image) }}" alt="">
                              <!-- <a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Image" aria-label="Delete Item"><span class="fas fa-trash-can"></span></a> -->
                            </div>
                          </div>
                        </div>
                        <!-- thumbnail image close -->
                      <h4 class="title fz17 mb30">Upload photos of your property</h4>
                      <div class="col-lg-12">
                        <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">
                          <div class="icon mb30"><span class="flaticon-upload"></span></div>
                          <h4 class="title fz17 mb10">Upload multiple photos of your property</h4>
                          <p class="text mb25">Photos must be JPEG or PNG format and at least 2048x768</p>
                          <label class="ud-btn btn-white" for="multiFileInput">Browse Files
                            <input type="file" name="image[]" id="multiFileInput" accept=".jpg, .jpeg, .png" multiple style="display: none;">
                            <i class="fal fa-arrow-right-long"></i>
                          </label>
                        </div>
                      </div>
                      @php
                        $images = explode(',', $forlease->image);
                      @endphp

                      <div class="row" id="image-container">
                        @foreach($images as $index => $image)
                          <div class="col-lg-4">
                            <div class="profile-box position-relative d-md-flex align-items-end mb50">
                              <div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm">
                                <img class="w-100" src="{{ asset('storage/appforlease/multiimage/'.$image) }}" alt="">
                                <a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="" aria-label="Delete Item" onclick="deleteImage(event, '{{ $forlease->id }}', {{ $index }})"><span class="fas fa-trash-can"></span></a>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                            <!-- next pre -->
                          <div class="row">
                            <div class="col-md-12">
                              <div class="d-sm-flex justify-content-between">
                                <a id="preButtonDesc" class="ud-btn btn-white" href="#">Prev Step<i class="fal fa-arrow-right-long"></i></a>
                                <a id="nextButtonLot" class="ud-btn btn-dark" href="#">Next Step<i class="fal fa-arrow-right-long"></i></a>
                              </div>
                            </div>
                          </div>

                      </div>
                    </div>
                    <!-- media close -->
                    <!-- Lot Sale -->
                    <div class="tab-pane fade" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                      <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Lot Sale Detail</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Building Status</label>
                                <input type="text" name="building_status" class="form-control" value="{{$forlease->building_status}}" placeholder="Building Status">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">GLA</label>
                                <input type="text" name=gla class="form-control" value="{{$forlease->gla}}" placeholder="GLA">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Floors</label>
                                <input type="text" name=floors class="form-control" value="{{$forlease->floors}}" placeholder="Floors">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Year Build</label>
                                <input type="text" name=year_build class="form-control" value="{{$forlease->year_build}}" placeholder="Year Build">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Tenancy</label>
                                <input type="text" name=tenancy class="form-control" value="{{$forlease->tenancy}}" placeholder="Tenancy">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Building Height</label>
                                <input type="text" name=building_height class="form-control" value="{{$forlease->building_height}}" placeholder="Building Height">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Sprindlers</label>
                                <input type="text" name=sprindles class="form-control" value="{{$forlease->sprindles}}" placeholder="Sprindlers">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Parking</label>
                                <input type="text" name=parking class="form-control" value="{{$forlease->parking}}" placeholder="Parking">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Land Area</label>
                                <input type="text" name=land_area class="form-control" value="{{$forlease->land_area}}" placeholder="Land Area">
                              </div>
                            </div>

                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Lot Description</label>
                                <textarea cols="30" rows="5" name="property_desc"  placeholder="There are many variations of passages.">{{$forlease->property_desc}}</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="d-sm-flex justify-content-between">
                                <a id="preButtonMedia" class="ud-btn btn-white" href="#">Prev Step<i class="fal fa-arrow-right-long"></i></a>
                                <a id="nextButtonZoning" class="ud-btn btn-dark" href="#">Next Step<i class="fal fa-arrow-right-long"></i></a>
                              </div>
                            </div>
                          </div>
                        
                      </div>
                    </div>
                    <!-- close Lot Sale --> 
                    <!-- zoning tax -->
                    <div class="tab-pane fade" id="nav-item4" role="tabpanel" aria-labelledby="nav-item4-tab">
                      <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Zoning & Taxation</h4>
                          <div class="row">
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Zoning</label>
                                <input type="text" name="zoaning" class="form-control" value="{{$forlease->zoaning}}" placeholder="LI">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Zoning Description</label>
                                <textarea cols="30" rows="5" name="zoaning_desc" value="" placeholder="There are many variations of passages.">{{$forlease->zoaning_desc}}</textarea>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Year</label>
                                <input type="text" name="year" class="form-control" value="{{$forlease->year}}" placeholder="2023">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Taxes</label>
                                <input type="text" name="texes" class="form-control" value="{{$forlease->texes}}" placeholder="$">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Other Expense</label>
                                <input type="text" name="other_exp" class="form-control" value="{{$forlease->other_exp}}" placeholder="$">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Total</label>
                                <input type="text" name="total" class="form-control" value="{{$forlease->total}}" placeholder="$">
                              </div>
                            </div>
                            
                            <div class="col-md-12">
                              <div class="d-sm-flex justify-content-between">
                                <a id="preButtonLot" class="ud-btn btn-white" href="#">Prev Step<i class="fal fa-arrow-right-long"></i></a>
                                <a id="nextButtonAmentities" class="ud-btn btn-dark" href="#">Next Step<i class="fal fa-arrow-right-long"></i></a>
                              </div>
                            </div>
                          </div>
                      
                      </div>
                    </div>
                    <!-- close zoning tax -->
                    <!-- amentities -->
                    <div class="tab-pane fade" id="nav-item5" role="tabpanel" aria-labelledby="nav-item5-tab">
                      <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Select Amenities</h4>
                        @php
                          $amentities = [];
                          if (isset($forlease->amentities)) {
                            $amentities = explode(',', $forlease->amentities);
                          }
                        @endphp
                            
                        <div class="row">
                          <div class="col-sm-6 col-lg-3 col-xxl-2">
                            <div class="checkbox-style1">
                              <label class="custom_checkbox">Attic
                              <input type="checkbox" name="amentities[]" value="Attic" {{ in_array('Attic', $amentities) ? 'checked="checked"' : '' }}>
                                
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Basketball court
                                <input type="checkbox" name="amentities[]" value="Basketball court"  {{ in_array('Basketball court', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Air Conditioning
                                <input type="checkbox" name="amentities[]" value="Air Conditioning" {{ in_array('Air Conditioning', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Lawn
                                <input type="checkbox" name="amentities[]" value="Lawn" {{ in_array('Lawn', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Swimming Pool
                                <input type="checkbox" name="amentities[]" value="Swimming Pool" {{ in_array('Swimming Pool', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Barbeque
                                <input type="checkbox" name="amentities[]" value="Barbeque" {{ in_array('Barbeque', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Microwave
                                <input type="checkbox" name="amentities[]" value="Microwave" {{ in_array('Microwave', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-3 col-xxl-2">
                            <div class="checkbox-style1">
                              <label class="custom_checkbox">TV Cable
                                <input type="checkbox" name="amentities[]" value="TV Cable" {{ in_array('TV Cable', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Dryer
                                <input type="checkbox" name="amentities[]" value="Dryer" {{ in_array('Dryer', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Outdoor Shower
                                <input type="checkbox" name="amentities[]" value="Outdoor Shower" {{ in_array('Outdoor Shower', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Washer
                                <input type="checkbox" name="amentities[]" value="Washer" {{ in_array('Washer', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Gym
                                <input type="checkbox" name="amentities[]" value="Gym" {{ in_array('Gym', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Ocean view
                                <input type="checkbox" name="amentities[]" value="Ocean view" {{ in_array('Ocean view', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Private space
                                <input type="checkbox" name="amentities[]" value="Private space" {{ in_array('Private space', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-3 col-xxl-2">
                            <div class="checkbox-style1">
                              <label class="custom_checkbox">Lake view
                                <input type="checkbox" name="amentities[]" value="Lake view" {{ in_array('Lake view', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Wine cellar
                                <input type="checkbox" name="amentities[]" value="Wine cellar" {{ in_array('Wine cellar', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Front yard
                                <input type="checkbox" name="amentities[]" value="Front yard" {{ in_array('Front yard', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Refrigerator
                                <input type="checkbox" name="amentities[]" value="Refrigerator" {{ in_array('Refrigerator', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">WiFi
                                <input type="checkbox" name="amentities[]" value="WiFi" {{ in_array('WiFi', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Laundry
                                <input type="checkbox" name="amentities[]" value="Laundry" {{ in_array('Laundry', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Sauna
                                <input type="checkbox" name="amentities[]" value="Sauna" {{ in_array('Sauna', $amentities) ? 'checked="checked"' : '' }}>
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>

                          <div class="col-md-12 mt30">
                            <div class="d-sm-flex justify-content-between">
                              <a id="preButtonZoning" class="ud-btn btn-white" href="#">Prev Step<i class="fal fa-arrow-right-long"></i></a>
                              <button type="submit" class="ud-btn btn-thm">Submit Property<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  @endforeach
                    <!-- amentities close -->
                  </div>
                </div>
              </div>
            </div>
          </div>


@include('layouts.admin.footer_new')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- for address field geo code  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDJCCEzrfV6IwqDezE54eSnXkrverg4afk&libraries=places"></script>
    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>



<script>


$(document).ready(function() {
  $('#myform').submit(function(event) {
    event.preventDefault(); // Prevent form submission

    // Collect form data
    var formData = new FormData(this);

    // Get the data-id value from the hidden input field
    var dataId = $(this).find('input[name="id"]').val();

    // Send Ajax request
    $.ajax({
      url: "{{ route('admin.forlease.update', ['forlease' => ':forlease']) }}".replace(':forlease', dataId),
      type: 'POST',
      data: formData,
      dataType: 'json',
      processData: false, // Prevent jQuery from processing the data
      contentType: false, // Prevent jQuery from setting the content type
      success: function(response) {
        var successMessage = $('#success-message');
        var errorMessage = $('#error-message');
        
        successMessage.hide(); // Hide error message if displayed
        errorMessage.hide(); // Hide success message if displayed
        
        if (response.message === 'Data updated successfully') {
          successMessage.text('Success: Data Updated successfully').show();

          setTimeout(function() {
            successMessage.hide();
          }, 5000);
        }
        // Update the thumbnail image source
        var thumbnailImageUrl = "{{ asset('storage/appforlease/thumbnail/') }}/" + response.thumbnail_image;
        $('.profile-img img').first().attr('src', thumbnailImageUrl);
        
        // Update multi images
        var images = response.imageUrl.split(','); // Remove the leading comma and then split
        var imageContainer = $('#image-container');
        imageContainer.empty(); // Clear previous images
        
        for (var i = 0; i < images.length; i++) {
          var imageUrl = "{{ asset('storage/appforlease/multiimage/') }}/" + images[i];
          var imageElement = $('<div class="col-lg-4"><div class="profile-box position-relative d-md-flex align-items-end mb50"><div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm"><img class="w-100" src="' + imageUrl + '" alt=""><a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="" aria-label="Delete Item" onclick="deleteImage(event, \'' + dataId + '\', ' + i + ')"><span class="fas fa-trash-can"></span></a></div></div></div>');
          imageContainer.append(imageElement);
        }

        // alert(images.length);
      },
      error: function(xhr, status, error) {
      var successMessage = $('#success-message');
      var errorMessage = $('#error-message');
      
      successMessage.hide(); // Hide success message if displayed
      errorMessage.text('Error: Internal Server Error').show();
      setTimeout(function() {
        errorMessage.hide();
      }, 5000);
    }
    });
  });
});

// delete image 
function deleteImage(event, dataId, index) {
    event.preventDefault();

    var url = "{{ route('admin.forlease.deleteimage', ['forlease' => ':forlease', 'index' => ':index']) }}";
    url = url.replace(':forlease', dataId).replace(':index', index);

    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
          // show message
          var successMessage = $('#success-message');
          var errorMessage = $('#error-message');
          
          successMessage.hide(); // Hide error message if displayed
          errorMessage.hide(); // Hide success message if displayed
          
          if (response.message === 'Image deleted successfully') {
            successMessage.text('Success: Image deleted successfully').show();
            setTimeout(function() {
              successMessage.hide();
            }, 5000);
          }
            // console.log("Response Success: ", response);
            if (response.message === 'Image deleted successfully') {
                var updatedImages = response.updatedeleteimage.split(',');

                var imageContainer = $('#image-container');
                imageContainer.empty();

                for (var i = 0; i < updatedImages.length; i++) {
                    var imageUrl = "{{ asset('storage/appforlease/multiimage/') }}/" + updatedImages[i];
                    var imageElement = $('<div class="col-lg-4"><div class="profile-box position-relative d-md-flex align-items-end mb50"><div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm"><img class="w-100" src="' + imageUrl + '" alt=""><a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="" aria-label="Delete Item" onclick="deleteImage(event, \'' + dataId + '\', ' + i + ')"><span class="fas fa-trash-can"></span></a></div></div></div>');
                    imageContainer.append(imageElement);
                }
            }
        },
        error: function(xhr, status, error) {
      var successMessage = $('#success-message');
      var errorMessage = $('#error-message');
      
      successMessage.hide(); // Hide success message if displayed
      errorMessage.text('Error: Error Image not found').show();
      setTimeout(function() {
          errorMessage.hide();
        }, 5000);
    }
    });
}

$(document).ready(function() {
  $('#nextButtonMedia').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item2-tab').trigger('click');
  });
  $('#preButtonDesc').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item1-tab').trigger('click');
  });
  $('#nextButtonLot').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item3-tab').trigger('click');
  });
  $('#preButtonMedia').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item2-tab').trigger('click');
  });
  $('#nextButtonZoning').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item4-tab').trigger('click');
  });
  $('#preButtonLot').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item3-tab').trigger('click');
  });
  $('#nextButtonAmentities').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item5-tab').trigger('click');
  });
  $('#preButtonZoning').click(function(e) {
    e.preventDefault();
    
    // Trigger the click event on the "Media" tab button
    $('#nav-item4-tab').trigger('click');
  });
});

</script>