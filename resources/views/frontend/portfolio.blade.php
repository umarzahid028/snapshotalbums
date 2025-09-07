@include("frontend.layouts.header")

  <!-- Signup Modal -->

  <div class="body_content">
    <!-- header heading -->
    <section class="breadcumb-section2 aboutHeader p-0" style="background-image: url('public/images/about/portfolio.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <h2 class="title">Portfolio</h2>
              <div class="breadcumb-list breadcumb">
                <a href="#">Home</a>
                <a href="#">Portfolio</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- close header heading -->
    <!-- Property Half Map V1 -->
    <section class="p-0 bgc-f7">
      <div class="container-fluid">
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-xl-5">
            <div class="half_map_area_content mt30">
              <!-- Filters -->
              <div class="col-lg-12">
                <div class="advance-search-list d-flex justify-content-between">
                  <div class="dropdown-lists">
                    <ul class="p-0 text-center text-xl-start">
                      <li class="list-inline-item position-relative">
                        <button type="button" class="open-btn mb15 dropdown-toggle" data-bs-toggle="dropdown">For Sale/For Lease <i class="fa fa-angle-down ms-2"></i></button>
                        <div class="dropdown-menu">
                        <div class="widget-wrapper bdrb1 pb25 mb0 pl20">
                          <h6 class="list-title">Listing Status</h6>
                          <div class="checkbox-style1">
  <label class="custom_checkbox">All
    <input type="checkbox" id="allCheckbox">
    <span class="checkmark"></span>
  </label>
  <label class="custom_checkbox">For Sale
    <input type="checkbox" class="listing-status-checkbox" data-status="Forsale">
    <span class="checkmark"></span>
  </label>
  <label class="custom_checkbox">For Lease
    <input type="checkbox" class="listing-status-checkbox" data-status="Forlease">
    <span class="checkmark"></span>
  </label>
</div>
                        </div>
                         
                        </div>
                      </li>
                      <li class="list-inline-item position-relative">
                        <button type="button" class="open-btn mb15 dropdown-toggle" data-bs-toggle="dropdown">For Rent <i class="fa fa-angle-down ms-2"></i></button>
                        <div class="dropdown-menu">
                          <div class="widget-wrapper bdrb1 pb25 mb0 pl20">
                            <h6 class="list-title">Property Type</h6>
                            <div class="checkbox-style1">
                              <label class="custom_checkbox">All
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Multifamily
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Industrial
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Mixed Use
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Retail
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Restaurant
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Office
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                              <label class="custom_checkbox">Land
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          
                        </div>
                      </li>
                      <!-- <li class="list-inline-item position-relative">
                        <button type="button" class="open-btn mb15 dropdown-toggle" data-bs-toggle="dropdown">Price <i class="fa fa-angle-down ms-2"></i></button>
                        <div class="dropdown-menu dd3">
                          <div class="widget-wrapper bdrb1 pb25 mb0 pl20 pr20">
                            <h6 class="list-title">Price Range</h6>
                            Range Slider Desktop Version
                            <div class="range-slider-style1">
                              <div class="range-wrapper">
                                <div class="slider-range mt30 mb20"></div>
                                <div class="text-center">
                                  <input type="text" class="amount" placeholder="$20"><span class="fa-sharp fa-solid fa-minus mx-1 dark-color"></span>
                                  <input type="text" class="amount2" placeholder="$70987">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="text-end mt10 pr10">
                            <button type="button" class="done-btn ud-btn btn-thm drop_btn3">Done</button>
                          </div>
                        </div>
                      </li> -->
                      <!-- <li class="list-inline-item">
                        Advance Features modal trigger
                        <button type="button" class="open-btn mb15" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="flaticon-settings me-2"></i> More Filter</button>
                      </li> -->
                    </ul>
                  </div>
                </div>
              </div>
              <!-- filter close -->
              <!-- heading or subheading -->
              <h4 class="mb-1">New York Homes for Sale</h4>
              <div class="row align-items-center mb10">
                <div class="col-sm-6">
                  <div class="text-center text-sm-start">
                    <!-- <p class="pagination_page_count mb-0">Showing 1–10 of 13 results</p> -->
                  </div>
                </div>
                <!-- <div class="col-sm-6">
                  <div class="page_control_shorting d-flex align-items-center justify-content-center justify-content-sm-end">
                    <div class="pcs_dropdown pr10"><span>Sort by</span>
                      <select class="selectpicker show-tick">
                        <option>Newest</option>
                        <option>Best Seller</option>
                        <option>Best Match</option>
                        <option>Price Low</option>
                        <option>Price High</option>
                      </select>
                    </div>
                    <a class="pl15 pr15 bdrl1 bdrr1 d-none d-md-block" href="#">Grid</a>
                    <a class="pl15 d-none d-md-block" href="#">List</a>
                  </div>
                </div> -->
              </div>
              <!-- heading Subheading -->
              <!-- card -->
                <div class="row" id="propertyContainer">
                    @if ($data->isEmpty())
                      <div class="col-sm-12">
                        <h2>Ther is No Property Listed ......</h2>
                      </div>
                    @else
                  @foreach($data as $datas)
                  <div class="col-sm-6 apart" data-latitude="{{ $datas->latitude }}" data-longitude="{{ $datas->longitude }}"  data-property-type="{{ $datas->property_type }}">
                    <div class="listing-style1">
                      <div class="list-thumb">
                      @if ($datas->property_type == 'Forsale')
                        <img class="w-100" src="{{ asset('storage/appforsale/thumbnail/'.$datas->thumbnail_image) }}" alt="">
                      @else ($datas->property_type == 'Forlease')
                      
                        <img class="w-100" src="{{ asset('storage/appforlease/thumbnail/'.$datas->thumbnail_image) }}" alt="">
                      @endif

                      @if ($datas->property_type == 'Forsale')
                        <div class="list-price">${{ number_format($datas->lot_sale_price, 2) }} / <span></span></div>
                      @else ($datas->property_type == 'Forlease')
                      <div class="list-price">${{ number_format($datas->rent, 2) }} / <span>mo</span></div>
                      @endif
                      </div>
                      <div class="list-content">
                      <h6 class="list-title apartment" data-latitude="{{ $datas->latitude }}" data-longitude="{{ $datas->longitude }}">
                          @if ($datas->property_type == 'Forsale')
                          <a href="{{ url('single_page_forsale', $datas->id) }}">{{$datas->title}}</a>
                          @elseif ($datas->property_type == 'Forlease')
                          <a href="{{ url('single_page_forlease', $datas->id) }}">{{$datas->title}}</a>
                          @else
                          {{$datas->title}}
                          @endif
                      </h6>
                        <p class="list-text">{{$datas->address}}</p>
                        <div class="list-meta d-flex align-items-center">
                          <a href="#"><span class="flaticon-bed"></span>3 bed</a>
                          <a href="#"><span class="flaticon-shower"></span>4 bath</a>
                          <a href="#"><span class="flaticon-expand"></span>{{$datas->lot_sale_size}}</a>
                        </div>
                        <hr class="mt-2 mb-2">
                        <div class="list-meta2 d-flex justify-content-between align-items-center">
                          <span class="for-what">{{$datas->secondary_type}}</span>
                          <div class="icons d-flex align-items-center">
                            <a href="#"><span class="flaticon-fullscreen"></span></a>
                            <a href="#"><span class="flaticon-new-tab"></span></a>
                            <a href="#"><span class="flaticon-like"></span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
              </div>
              <!-- card close -->
              <!-- pagination -->
              <!-- <div class="row">
                <div class="mbp_pagination text-center">
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
                </div>
              </div> -->
              <!-- pagination close -->
            </div>
          </div>
          <div class="col-xl-7 overflow-hidden position-relative" id="map">
            <!-- <div class="half_map_area">
                <div class="map-canvas half_style"  data-map-zoom="7" data-map-scroll="true"></div>
                
                </div>
          </div> -->
        </div>
      </div>
    </section>
    
    
    <!-- Our Footer --> 
    @include("frontend.layouts.footer")
  


<script>
$(document).ready(function() {
    // Filter by listing status (For Sale/For Lease)
     // Handle listing status checkboxes
     $('.listing-status-checkbox').change(function() {
    applyListingStatusFilter();
  });

  // Handle "All" checkbox
  $('#allCheckbox').change(function() {
    if ($(this).is(':checked')) {
      $('.listing-status-checkbox').prop('checked', false);
    }
    applyListingStatusFilter();
  });

  function applyListingStatusFilter() {
    var selectedStatuses = [];

    if (!$('#allCheckbox').is(':checked')) {
      $('.listing-status-checkbox:checked').each(function() {
        var status = $(this).data('status');
        selectedStatuses.push(status);
      });
    }

    $('#propertyContainer .apart').hide(); // Hide all properties initially

    if (selectedStatuses.length === 0 || $('#allCheckbox').is(':checked')) {
      $('#propertyContainer .apart').show(); // Show all properties if no options are selected or if "All" is checked
    } else {
      for (var i = 0; i < selectedStatuses.length; i++) {
        var status = selectedStatuses[i];
        $('#propertyContainer .apart[data-property-type="' + status + '"]').show();
      }
    }
  }

    $(document).ready(function() {
    // Filter by secondary type (Property Type)
    $('.checkbox-style1 input[type="checkbox"]').click(function() {
        var selectedTypes = [];
        $('.checkbox-style1 input[type="checkbox"]:checked').each(function() {
            var type = $(this).parent().text().trim();
            if (type !== "All") {
                selectedTypes.push(type);
            }
        });

        $('#propertyContainer .apart').hide(); // Hide all properties initially

        if (selectedTypes.length === 0 || selectedTypes.includes("All")) {
            $('#propertyContainer .apart').show(); // Show all properties if no types are selected or if "All" is selected
        } else {
            $('#propertyContainer .apart').each(function() {
                var propertyType = $(this).find('.for-what').text().trim();
                if (selectedTypes.includes(propertyType)) {
                    $(this).show(); // Show properties with selected secondary types
                }
            });
        }
    });
});
});



var map = L.map('map').setView([40.730610, -73.935242], 12); // Set the initial center and zoom level

var CartoDB_PositronNoLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
	subdomains: 'abcd',
	maxZoom: 20
}).addTo(map);

map.zoomControl.remove();
// Add markers to the map for each apartment
var markers = [];
var apartments = document.getElementsByClassName('apart');
for (var i = 0; i < apartments.length; i++) {
  var apartment = apartments[i];
  var apartmentId = apartment.getAttribute('data-id');
  var latitude = apartment.getAttribute('data-latitude');
  var longitude = apartment.getAttribute('data-longitude');
  var apartmentName = apartment.querySelector('.list-title').innerText;
  var apartmentImage = apartment.querySelector('img').src; // Get the image source

  var iconUrl = 'public/image/3dapartment.png';

  var markerIcon = L.icon({
    iconUrl: iconUrl, // Use the image source as the marker icon
    iconSize: [60, 60], // Set the icon size (adjust as needed)
  });

  var marker = L.marker([latitude, longitude], { icon: markerIcon, apartmentId: apartmentId }).addTo(map);

  marker.bindPopup(apartmentName);

  marker.on('mouseover', function () {
    // Show marker popup on hover
    this.openPopup();

    // Get the corresponding apartment element
    var apartmentElement = document.querySelector('.apart[data-id="' + this.options.apartmentId + '"]');

    // Apply GSAP animation to the apartment element
    gsap.to(apartmentElement, {
      duration: 0.5,
      scale: 1.1,
      backgroundColor: '', // Change the apartment's background color on hover
      ease: 'power2.out',
    });
  });

  

  marker.on('mouseout', function () {
    // Hide marker popup on hover out
    this.closePopup();

    // Get the corresponding apartment element
    var apartmentElement = document.querySelector('.apart[data-id="' + this.options.apartmentId + '"]');

    // Revert GSAP animation on the apartment element
    gsap.to(apartmentElement, {
      duration: 0.5,
      scale: 1,
      backgroundColor: '', // Revert back to the original background color
      ease: 'power2.out',
    });
  });

  apartment.addEventListener('mouseover', function () {
    var apartmentId = this.getAttribute('data-id');
    var apartmentLatitude = this.getAttribute('data-latitude');
    var apartmentLongitude = this.getAttribute('data-longitude');

    // Move the map to the apartment location on hover
    map.flyTo([apartmentLatitude, apartmentLongitude], 15);

    // Get the corresponding marker
    var apartmentMarker = markers.find(function (marker) {
      return marker.options.apartmentId === apartmentId;
    });

    if (apartmentMarker) {
      // Apply GSAP animation to the marker icon
      gsap.to(apartmentMarker._icon, {
        duration: 0.5,
        scale: 1.1,
        backgroundColor: '', // Change the marker's background color on hover
        ease: 'power2.out',
      });
    }
  });

  apartment.addEventListener('mouseout', function () {
    // Reset the map view on hover out
    map.setView([40.730610, -73.935242], 12);

    // Get the corresponding marker
    var apartmentMarker = markers.find(function (marker) {
      return marker.options.apartmentId === apartmentId;
    });

    if (apartmentMarker) {
      // Revert GSAP animation on the marker icon
      gsap.to(apartmentMarker._icon, {
        duration: 0.5,
        scale: 1,
        backgroundColor: '', // Revert back to the original background color
        ease: 'power2.out',
      });
    }
  });

  markers.push(marker);
}

// Create a marker cluster group and add all markers to it
var markerCluster = L.markerClusterGroup();
markerCluster.addLayers(markers);
map.addLayer(markerCluster);

</script>
   