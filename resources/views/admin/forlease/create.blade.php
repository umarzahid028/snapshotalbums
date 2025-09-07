@include('layouts.admin.header_new')

  <div class="row align-items-center pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>Add New Property For Lease</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
          </div>
          <!-- message -->
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
          <!-- message -->
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
                        <!-- <form method="POST" action="{{ route('admin.forsale.store') }}"  enctype="multipart/form-data"  class="form-style1"> -->
                         <!-- <form action="{{route('admin.forlease.store')}}" id="myform" method="POST" enctype="multipart/form-data"> -->
                         <form id="myform" method="POST">
                          @csrf
                          
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Title</label><span style="color: red;">*</span>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Secondary Type</label>
                                <div class="location-area">
                                  <select class="selectpicker" name="secondary_type">
                                    <option>Multifamily</option>
                                    <option>Industrial</option>
                                    <option>Mixed Use</option>
                                    <option>Retail</option>
                                    <option>Restaurant</option>
                                    <option>Office</option>
                                    <option>Land</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Floor & Suit</label>
                                <input type="text" class="form-control" name="floor_suit" placeholder="Floor & Suit">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Space Available</label>
                                <input type="text" class="form-control" name="space_available" placeholder="Space Available">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Rent</label><span style="color: red;">*</span>
                                <input type="text" class="form-control" name="rent" placeholder="Rent">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                              <div class="mb30">
                                <label class="heading-color ff-heading fw600 mb10">Lease Type</label><span style="color: red;">*</span>
                                <input type="text" class="form-control" name="lease_type" placeholder="Lease Type">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Address</label>
                                <input type="text" name="address" id="autocomplete" class="form-control" placeholder="Choose Location" required>
                              </div>
                              <div class="mb20" id="latitudeArea" hidden>
                                <label class="heading-color ff-heading fw600 mb10">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control">
                              </div>
                              <div class="mb20" id="longtitudeArea" hidden>
                                <label class="heading-color ff-heading fw600 mb10">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control">
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
                      <h4 class="title fz17 mb30">Thumbnail Photo<span style="color: red;">*</span></h4>
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
                       <!-- show thumnail image  -->
                       <div class="col-lg-5">
                        <div class="profile-box position-relative d-md-flex align-items-end mb50">
                          <div id="thumbnailPreview" class="profile-img position-relative overflow-hidden bdrs12 mb20-sm">
                            <img class="w-100" src="images/listings/profile-1.jpg" alt="">
                            <a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Image" aria-label="Delete Item"><span class="fas fa-trash-can"></span></a>
                          </div>
                          <!-- ... Other thumbnail images ... -->
                        </div>
                      </div>
                      <!-- close show thumnail image  -->
                      <h4 class="title fz17 mb30">Upload photos of your property<span style="color: red;">* Min 5 Images Require</span></h4>
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
                      <!-- multiple images  -->
                      
                      <div class="col-lg-12">
                            <div id="imagePreview" class="profile-box position-relative d-md-flex align-items-end mb50">
                              <!-- ... Selected images will be displayed here ... -->
                            </div>
                          </div>
    
                        <div class="col-lg-5">
                          <div class="profile-box position-relative d-md-flex align-items-end mb50">
                            <div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm">
                              <img class="w-100" src="images/listings/profile-1.jpg" alt="">
                              <a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Image" aria-label="Delete Item"><span class="fas fa-trash-can"></span></a>
                            </div>
                            <div class="profile-img position-relative overflow-hidden bdrs12 ml20 ml0-sm">
                              <img class="w-100" src="images/listings/profile-2.jpg" alt="">
                              <a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Image" aria-label="Delete Item"><span class="fas fa-trash-can"></span></a>
                            </div>
                          </div>
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
                                <input type="text" name="building_status" class="form-control" placeholder="Building Status">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">GLA</label>
                                <input type="text" name=gla class="form-control" placeholder="GLA">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Floors</label>
                                <input type="text" name=floors class="form-control" placeholder="Floors">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Year Build</label>
                                <input type="text" name=year_build class="form-control" placeholder="Year Build">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Tenancy</label>
                                <input type="text" name=tenancy class="form-control" placeholder="Tenancy">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Building Height</label>
                                <input type="text" name=building_height class="form-control" placeholder="Building Height">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Sprindlers</label>
                                <input type="text" name=sprindles class="form-control" placeholder="Sprindlers">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Parking</label>
                                <input type="text" name=parking class="form-control" placeholder="Parking">
                              </div>
                            </div>
                            <div class="col-sm-12 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Land Area</label>
                                <input type="text" name=land_area class="form-control" placeholder="Land Area">
                              </div>
                            </div>

                          </div>
                          <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Property Description</label><span style="color: red;">*</span>
                                <textarea cols="30" rows="5" name="property_desc" placeholder="There are many variations of passages."></textarea>
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
                                <input type="text" name="zoaning" class="form-control" placeholder="LI">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Zoning Description</label>
                                <textarea cols="30" rows="5" name="zoaning_desc" placeholder="There are many variations of passages."></textarea>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Year</label>
                                <input type="text" name="year" class="form-control" placeholder="2023">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Taxes</label>
                                <input type="text" name="texes" class="form-control" placeholder="$">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Other Expense</label>
                                <input type="text" name="other_exp" class="form-control" placeholder="$">
                              </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                              <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">Total</label>
                                <input type="text" name="total" class="form-control" placeholder="$">
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
                        <div class="row">
                          @foreach ($amentity_for_sale as $amentity)
                          <div class="col-sm-6 col-lg-3 col-xxl-2">
                            <div class="checkbox-style1">
                              <label class="custom_checkbox">{{$amentity->amentities}}
                                <input type="checkbox" name="amentities[]" value="{{$amentity->amentities}}">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          @endforeach
                        
                          <div class="col-md-12 mt30">
                            <div class="d-sm-flex justify-content-between">
                              <a id="preButtonZoning" class="ud-btn btn-white" href="#">Prev Step<i class="fal fa-arrow-right-long"></i></a>
                              <button type="submit" id="submit_btn" class="ud-btn btn-thm">Submit Property<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                    <!-- amentities close -->
                  </div>
                </div>
              </div>
            </div>
          </div>



@include('layouts.admin.footer_new')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

// thumbnail image name 
$(document).ready(function() {
  // Handle file input change event
  $('#thumbnailFileInput').change(function() {
    var fileName = $(this).val().split('\\').pop(); // Get the file name
    var thumbnailPreview = $('#thumbnailPreview');
    thumbnailPreview.find('img').attr('src', ''); // Clear the existing image (if any)
    thumbnailPreview.find('img').attr('alt', fileName); // Set the alt attribute to the file name
    thumbnailPreview.find('img').attr('src', URL.createObjectURL(this.files[0])); // Display the selected image
  });

  $('#multiFileInput').change(function() {
    var imagePreview = $('#imagePreview');
    imagePreview.empty(); // Clear the existing images

    for (var i = 0; i < this.files.length; i++) {
      var file = this.files[i];
      var fileName = file.name;

      // Create a new image element and set its attributes
      var img = $('<img>').addClass('w-100').attr('src', URL.createObjectURL(file)).attr('alt', fileName);

      // Create a container for the image and the delete icon
      var container = $('<div>').addClass('profile-img position-relative overflow-hidden bdrs12 mb20-sm');

      // Create the delete icon and its click event handler
      var deleteIcon = $('<a>').addClass('tag-del').attr('href', '#').attr('data-bs-toggle', 'tooltip').attr('data-bs-placement', 'top')
        .attr('data-bs-original-title', 'Delete Image').attr('aria-label', 'Delete Item').html('<span class="fas fa-trash-can"></span>')
        .click(function() {
          // Remove the container when the delete icon is clicked
          $(this).parent().remove();
        });

      // Append the image and the delete icon to the container
      container.append(img, deleteIcon);

      // Append the container to the imagePreview element
      imagePreview.append(container);
    }
  });
});


$(document).ready(function() {
  $('#myform').submit(function(event) {
    event.preventDefault(); // Prevent form submission

    const submit_btn = document.getElementById('submit_btn');
    submit_btn.innerText = 'Processing...';

    // Disable the button
    submit_btn.disabled = true;

    // Collect form data
    var formData = new FormData(this);
    // alert(formData);
    
    // Send Ajax request
    $.ajax({
      url: "{{ route('admin.forlease.store') }}",
      type: 'POST',
      data: formData,
      dataType: 'json',
      processData: false, // Prevent jQuery from processing the data
      contentType: false, // Prevent jQuery from setting content type
     success: function(response) {
      // alert('save');
        var successMessage = $('#success-message');
        var errorMessage = $('#error-message');
        
        successMessage.hide(); // Hide error message if displayed
        errorMessage.hide(); // Hide success message if displayed
        
        if (response.message === 'Data saved successfully') {
          successMessage.text('Success: Data Updated successfully').show();

          submit_btn.disabled = true;
          submit_btn.innerText = 'Property Submited';

          setTimeout(function() {
            successMessage.hide();
          }, 5000);
        }
      },
      error: function(xhr, status, error) {
      var successMessage = $('#success-message');
      var errorMessage = $('#error-message');
      
      successMessage.hide(); // Hide success message if displayed
      errorMessage.text('Error: Please fill all required field sign is *').show();
      setTimeout(function() {
        errorMessage.hide();

          submit_btn.disabled = false;
          submit_btn.innerText = 'Submit Property';
      }, 5000);
        },
        complete: function() {
        // This function is triggered after the request is completed, regardless of success or error
        // submit_btn.innerText = 'Property Submited'; // Change the button text back to "Submit"
        
      }
    });
  });
});


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

