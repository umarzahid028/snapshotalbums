@section('title', 'Pricing')

@include("frontend.layouts.header")

  <!-- Main Header Nav -->

<style>



.ud-btn:hover,

.btn-gray:hover,

.btn-dark:hover,

.btn-thm:hover,

.btn-thm2:hover,

.btn-thm3:hover,

.btn-thm-border:hover,

.btn-white:hover,

.btn-light-gray:hover,

.btn-transparent:hover,

.btn-transparent2:hover {

  color: white !important;

}

.btn-thm,.ud-btn{

  color: #355691 !important;

}



</style>





   <!-- UI Elements Sections -->

   <section class="breadcumb-section" style="background-color: #C8E2F9">

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="breadcumb-style1">

              <!-- <h2 class="title">Membership Plans</h2> -->

              <div class="breadcumb-list">

                <!-- <a href="#">Home</a> -->

                <!-- <a href="#">For Rent</a> -->

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

    

    <!-- Pricing Section Area -->

    <section class="our-pricing pb90 pt-0" style="background-color: #C8E2F9; padding-top:80px !important">

      <div class="container">

        <div class="row wow">

          <div class="col-lg-6 offset-lg-3">

            <div class="main-title text-center mb30">

              <h2 style="color:#355691">Pricing</h2>

              <p>Whether you're using Snapshot Albums for one event or every event, we've got you covered! Check out or pricing and features to learn more.</p>

            </div>

          </div>

        </div>

        <div class="row wow">

          <div class="col-lg-12">

            <div class="pricing_packages_top d-flex align-items-center justify-content-center mb60">

              <div class="toggle-btn">

                

              </div>

            </div>

          </div>

        </div>

        <div class="row wow" style="background-color: #C8E2F9; border-color:black";>

          <div class="col-md-6 col-xl-6">

            <div class="pricing_packages">

              <div class="heading mb60">

                <h4 class="">Basic</h4>

                <h1 class="text1">$0</h1>
                
                <p  class="text">The basic level allows for full functionality of Snapshot Albums, but limits album creation to one.
                If you need access to create more than one album, consider the Premium level.</p>

                <!-- <p class="text">Forever</p> -->

                <img class="price-icon" src="images/icon/pricing-icon-2.svg" alt="">

              </div>

              <div class="details" style="margin-top: -30px">

               

                <div class="list-style1 mb40">

                  <ul>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Create one album</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Custom album background image</li>
                    
                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Unlimited guest uploaders</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Downloadable QR code generated for guests</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>User-friendly dashboard</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Album never expires</li>

                  </ul>

                </div>

                <div class="row">

                  <div col-md-12 style="text-align: center;">

                  <a href="{{ route('google.login') }}" class="ud-btn btn-thm" >Get started now<i class="fal fa-arrow-right-long"></i></a>  

                  </div>

               </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xl-6">

            <div class="pricing_packages active">

              <div class="heading mb60">

                <h4 class="">Premium</h4>

                <h1 class="text2">$99/year</h1>

                <p class="text">Perfect for users that want to create albums for all of their events, or need different QR codes to keep their guest's uploads organized.
                A must have for Event Planners, Venues, Churches or anyone that hosts events.
                Collect guest's photos and videos and keep them organized!</p>

                <img class="price-icon" src="images/icon/pricing-icon-1.svg" alt="">

              </div>

              <div class="details" style="margin-top: -30px">

             

                <div class="list-style1 mb40">

                  <ul>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i><b>Create unlimited albums</b></li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i><b>Make your albums public for guests to see</b></li>
                    
                    <li><i class="far fa-check text-white bgc-dark fz15"></i><b>10+ Printable Canva&trade; QR code templates</b></li>
                    
                    <li><i class="far fa-check text-white bgc-dark fz15"></i><b>Cancel anytime</b></li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Unlimited guest uploaders</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Custom album background images</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Downloadable QR code generated for guests</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>User-friendly dashboard</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Albums never expire</li>

                  </ul>

                </div>

                <div class="row">

                  <div col-md-12 style="text-align: center;">

                  <a href="{{ route('google.login') }}" class="ud-btn btn-thm" >Get started now<i class="fal fa-arrow-right-long"></i></a>  

                  </div>

                </div>


               

              </div>

            </div>

          </div>

          <!-- <div class="col-md-6 col-xl-4">

            <div class="pricing_packages">

              <div class="heading mb60">

                <h4 class="package_title">Business</h4>

                <h1 class="text2">$399.95</h1>

                <h1 class="text1">$999.95</h1>

                <p class="text">per month</p>

                <img class="price-icon" src="images/icon/pricing-icon-3.svg" alt="">

              </div>

              <div class="details">

                <p class="text mb35">Standard listing submission, active for 30 dayss</p>

                <div class="list-style1 mb40">

                  <ul>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>All Operating Supported</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Great Interface</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Allows encryption</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Face recognized system</li>

                    <li><i class="far fa-check text-white bgc-dark fz15"></i>24/7 Full support</li>

                  </ul>

                </div>

                <div class="d-grid">

                  <a href="#" class="ud-btn btn-thm-border text-thm">Join<i class="fal fa-arrow-right-long"></i></a>

                </div>

              </div>

            </div>

          </div> -->

        </div>

      </div>

    </section>



        <!-- Our CTA --> 




<!--
    <section class="our-cta2 p0 px20" style="background-color: #C8E2F9;">

      <div class="cta-banner2 bgc-thm maxw1600 mx-auto pt100 pt50-md pb85 pb50-md px30-md bdrs12 position-relative" style="background-color: #C8E2F9;" >

        <div class="cta-style2 d-none d-lg-block wow fadeInRight" data-wow-delay="300ms" >

          <img src="images/frontend/homepage-party1.png" style="width: 600px; height: auto; border-radius: 50px; top: -105px !important" alt="snapshot albums party photos">

        </div>

        <div class="container">

          <div class="row">

            <div class="col-lg-7 col-xl-5 wow fadeInUp" data-wow-delay="500ms">

              <div class="cta-style2">

                <h2 class="cta-title" style="color:#355691">It’s Free. Start Collecting</h2>

                <h2 class="cta-title" style="color:#355691">Your Photos

                  Today!

                </h2>

                <a href="{{ route('google.login') }}" class="ud-btn btn-transparent mr30 mr0-xs" >SIGN UP<i class="fal fa-arrow-right-long"></i></a>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>
    
    -->

<!-- Our Footer --> 

@include("frontend.layouts.footer")

