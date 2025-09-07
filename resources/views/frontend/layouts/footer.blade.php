<section class="footer-style1 pt60 pb-0" style="background:#355691">
      <div class="container">
     
        <div class="row">

           <div class="col-md-6 col-lg-4 col-sm-12 text-align-center-on-mob">
                  <div class="logos">
               
                <a class="header-logo logo1" href="{{ url('/') }}"><img src="{{asset('images/logo/logo-White.png')}}" height="200px" width="200px" alt="Header Logo"></a>
                
               
        </div>
            
          </div>
          <div class="col-md-6 offset-lg-2">
            <div class="row justify-content-between">
              <div class="col-auto">
                <div class="link-style1 mb-3">
                  <!--<h6 class="text-white mb25">Company</h6>-->
                  <div class="link-list">
                    <a href="/#home">Home</a>
                    <a href="/#how-to-collect">Set Up </a>
                     <a href="/#faqs">FAQ</a>
                    <a href="{{url('pricing')}}">Pricing</a>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="link-style1 mb-3">
                  <!--<h6 class="text-white mb25">Support</h6>-->
                  <ul class="ps-0">
                    
                    <!-- <li><a href="{{url('terms')}}">TERMS OF USE</a></li> -->
                    <li><a href="{{url('contact-us')}}">Contact</a></li>
                    <li><a href="{{url('tutorial')}}">Tutorial</a></li>
                    <li><a href="{{url('privacy_policy')}}">Privacy Policy</a></li>
                  </ul>
                </div>
              </div>
           </div>
          </div>
         
        </div>
      </div>
      <div class="container white-bdrt1 py-4">
        <div class="row">
          <div class="col-sm-6">
            <div class="text-center text-lg-start">
              <p class="copyright-text text-gray ff-heading">Snapshot - © All rights reverved</p>
            </div>
          </div>
          
        </div>
      </div>
    </section>
    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
  </div>
</div>
<!-- Wrapper End --> 
<script src="{{asset('js/jquery-3.6.4.min.js')}}"></script> 
<script src="{{asset('js/jquery-migrate-3.0.0.min.js')}}"></script> 
<script src="{{asset('js/popper.min.js')}}"></script> 
<script src="{{asset('js/bootstrap.min.js')}}"></script> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('js/jquery.mmenu.all.js')}}"></script> 
<script src="{{asset('js/ace-responsive-menu.js')}}"></script> 
<script src="{{asset('js/jquery-scrolltofixed-min.js')}}"></script> 
<script src="{{asset('js/wow.min.js')}}"></script> 
<script src="{{asset('js/owl.js')}}"></script>
<script src="{{asset('js/parallax.js')}}"></script> 
<script src="{{asset('js/pricing-table.js')}}"></script> 
<script src="{{asset('js/pricing-slider.js')}}"></script>
<script src="{{ asset('js/chart.min.js')}}"></script>
<!-- Custom script for all pages --> 
<script src="{{asset('js/script.js')}}"></script>

<!-- Google Maps --> 
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM&amp;callback=initMap"></script>
<script src="js/infobox.min.js"></script>
<script src="js/markerclusterer.js"></script>
<script src="js/maps.js"></script> -->
<!-- Google Maps --> 

<!-- Leaf Let Maps --> 
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     
     <!-- close leaf let -->
     <!-- wrld -->

     <!-- <script src="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script> -->

<script src="{{ asset('js/chart-custome.js')}}"></script>
<script src="{{ asset('js/isotop.js')}}"></script>
<script src="{{ asset('js/scrollbalance.js')}}"></script>

<!-- Hide Content OnScroll -->
<script>
  $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
      $('#HideImg').addClass('hideimg');
    } else {
      $('#HideImg').removeClass('hideimg');
    }
  });




</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuLinks = document.querySelectorAll('#menu a');
        var menu = document.getElementById('menu');
        var body = document.body;

        // Function to close the menu
        function closeMenu() {
            menu.classList.remove('mm-menu--opened');
            body.classList.remove('mm-wrapper--opened');
            var blockerLink = document.getElementById('mm-0');
            if (blockerLink) {
                blockerLink.parentNode.removeChild(blockerLink); // Remove the blocker link
            }
        }

        // Event listener for menu links
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                // event.preventDefault(); // Prevent default link behavior
                var targetId = link.getAttribute('href').substring(1); // Remove leading '#'
                closeMenu(); // Close the menu when link is clicked
                setTimeout(function() {
                    // Scroll to the section after a short delay (to ensure menu closes first)
                    var targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.scrollIntoView({ behavior: 'smooth' });
                    }
                }, 100); // Adjust delay as needed
            });
        });

        // Event listener for the body to prevent unintended link-like behavior
        body.addEventListener('click', function(event) {
            // Check if the click target is within the menu
            var isMenuClick = event.target.closest('#menu');
            if (!isMenuClick) {
                closeMenu(); // Close the menu if the click is outside the menu
            }
        });
        body.style.zIndex = '1000';
        // Optional: Adjust z-index of menu to ensure it appears below body content
        menu.style.zIndex = '999';

    });
</script>


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>


</body>

</html>