@section('title', 'Home')

@include("frontend.layouts.header_index")
  <!-- Main Header Nav -->

<style>

  .hide{
    display: none;
  }

  .city-img img{
    object-fit:cover !important;
    width: 100px;
    height:100px;
  }

  .img-1 {
    width: 500px;
    /* height: 700px; */
/*    border-radius: 40px;*/
  }
  .img-banner{
    max-width: 500px;
  }

  @media (max-width: 991.98px)
  {
    .img-1 {
/*    width: 340px;*/
    /* height: 700px; */
/*    border-radius: 40px !important;*/
  }
  }
  .text-clr-blue{
    color: #355691 !important;
  }
  .btn-hover-clr-white:hover{
    color: white !important;
  }
.list-icon{
  color: white !important;
  /*height: 75px !important;
  width: 75px !important;*/
}
.d-on-mob{
  display: none;
}


.hide-on-desktop{
  display: none !important;
}

@media (max-width: 720px)
  {
    .hide-on-desktop{
  display: block !important;
}
.show-on-mob{
  display: block !important;
}
.hide-on-mob{
  display: none !important;
}
.bannerimg-on-mob{
  width: 350px !important;
  }

  .mrgnbtm-20{
    margin-bottom: -20px;
  }
  .text-align-center-on-mob{

    text-align: center !important;
  }
}


</style>

  <!-- Home Banner Style V1 -->
    <section class="home-banner-style3 p0" id="home" style ="background:#C8E2F9">
      <div class="home-style3">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 hide-on-desktop d-xl-block text-center pb20">
                <img class="img-banner bannerimg-on-mob" src="images/frontend/homepage-couple1.png" alt="snapshot albums happy wedding couple">
                <!-- <img class="img-2 spin-right" src="images/about/element-3.png" alt="">
                <img class="img-3 spin-right" src="images/about/element-3.png" alt=""> -->
              
            </div>
            <div class="col-xl-6">
              <div class="inner-banner-style3">
                <h2 class="hero-title mb30">Easily collect guest pictures and videos at your event with Snapshot Albums, for free!</h2>
                
                <div style="margin-left: 0px !important;" class="d-block d-md-flex">
                  <p class="hero-text">Seamless integration with Google Drive&trade; Cloud Storage using an existing or new Google account!</p>
                  
                </div>
                  <div class="funfact_one">
                    <a href="{{ route('google.login') }}" class="ud-btn btn-thm text-clr-blue btn-hover-clr-white">Get started now<i class="fal fa-arrow-right-long"></i></a>
                  </div>
                
              </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block">
                <img class="img-banner" src="{{asset('images/frontend/homepage-couple1.png')}}" alt="snapshot albums happy wedding couple">
                <!-- <img class="img-2 spin-right" src="images/about/element-3.png" alt="">
                <img class="img-3 spin-right" src="images/about/element-3.png" alt=""> -->
              
            </div>
          </div>
        </div>
      </div>
    </section>

     <!-- About Us -->
     <section class="about-us">
      <div class="container">
        <div class="row mt80 mt0-md">
          <div class="col-md-6 col-xl-6 hide-on-mob">
            <img class="img-1 " src="images/frontend/homepage-music-festival1.png" alt="snapshot albums music festival">
          </div>
          <div class="col-md-6 col-xl-6">
            <div class="about-box-1 wow fadeInLeft" data-wow-delay="300ms">
            <h2 class="title mb30" style ="color:#355691"><center>SNAP, SCAN, SHARE</center></h2>
            <p class="text mb20 fz15" style="strong">We Made Collecting Your Event Photos Easy.</p>
              
              <p class="text mb20 fz15" >No more separate apps just to gather pictures and videos from your event. Guests scan your QR code or visit your link, and upload the media they’ve captured. It's that simple!</p>
              <div class="funfact_one">
              
                <a href="{{ route('google.login') }}" class="ud-btn btn-thm text-clr-blue btn-hover-clr-white">Get started now<i class="fal fa-arrow-right-long"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- mobile section -->
        <div class="container show-on-mob hide" style="background:#C8E2F9 !important;">
          <div class="row">
            <div class="col-md-12 col-lg-12 pl30-md pl15-xs wow fadeInRight pt30" data-wow-delay="500ms">

              <img class="pb30" width="350px" src="images/frontend/homepage-couple-viewing-photos.png">
              <div class="mb30">
                <!-- <p>FEATURES</p> -->
               <center> <h2 class="title text-capitalize" style ="color:#355691">Why Snapshot Albums?</h2></center>
              </div>
              <div class="why-chose-list style2">
                <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 fa fa-heart"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <!-- <h6 class="mb-1">What is Lorem Ipsum?</h6> -->
                    <p class="text mb-0 fz15">Snapshot Albums is simple – super simple! 
                    As a host, you’ll find the process of signing up, creating albums and sharing 
                    the album with your guests to be a breeze.
                    </p>
                  </div>
                </div>
                <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 fa fa-arrow-up"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <!-- <h6 class="mb-1">What is Lorem Ipsum?</h6> -->
                    <p class="text mb-0 fz15">Snapshot Albums will work for all your guests. 
                    Other services are cumbersome and require your guests to download specific apps. 
                    Use Snapshot Albums and keep it simple.
                      </p>
                  </div>
                </div>
                <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 flaticon-user"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <!-- <h6 class="mb-1">What is Lorem Ipsum?</h6> -->
                    <p class="text mb-0 fz15">You put a lot of effort into making your event a success. 
                    We think it's important you have ownership of the pictures and videos your guests capture. 
                    That’s why you own 100% of the items uploaded to your album, forever.
                    </p>
                  </div>
                </div>
              </div>
              <!-- <a href="page-property-single-v1.html" class="ud-btn btn-dark">Learn More<i class="fal fa-arrow-right-long"></i></a> -->
            </div>
          </div>
        </div>

<!-- mobile sectin -->


    <!-- CTA Banner -->
    <section class="pt-0 hide-on-mob" id="features" >
      <div class="cta-banner3 bgc-thm-light mx-auto maxw1600 pt100 pt60-lg pb90 pb60-lg  position-relative overflow-hidden mx20-lg" style ="background:#C8E2F9">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-5 pl30-md pl15-xs wow fadeInRight" data-wow-delay="500ms">
              <div class="mb30">
                <!-- <p>FEATURES</p> -->
               <center> <h2 class="title text-capitalize" style ="color:#355691">Why Snapshot Albums </h2></center>
              </div>
              <div class="why-chose-list style2">
                <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 fa fa-heart"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <!-- <h6 class="mb-1">What is Lorem Ipsum?</h6> -->
                    <p class="text mb-0 fz15">Snapshot Albums is simple – super simple! 
                    As a host, you’ll find the process of signing up, creating albums and sharing 
                    the album with your guests to be a breeze.
                    </p>
                  </div>
                </div>
                <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 fa fa-arrow-up"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <!-- <h6 class="mb-1">What is Lorem Ipsum?</h6> -->
                    <p class="text mb-0 fz15">Snapshot Albums will work for all your guests. 
                    Other services are cumbersome and require your guests to download specific apps. 
                    Use Snapshot Albums and keep it simple.
                      </p>
                  </div>
                </div>
                <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 flaticon-user"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <!-- <h6 class="mb-1">What is Lorem Ipsum?</h6> -->
                    <p class="text mb-0 fz15">You put a lot of effort into making your event a success. 
                    We think it's important you have ownership of the pictures and videos your guests capture. 
                    That’s why you own 100% of the items uploaded to your album, forever.</p>
                  </div>
                </div>
              </div>
              <!-- <a href="page-property-single-v1.html" class="ud-btn btn-dark">Learn More<i class="fal fa-arrow-right-long"></i></a> -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Explore Apartment -->
    <section class="pt30 pb90 pb10-md" id="how-to-collect">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <!-- <p>HOW DOES IT WORK</p> -->
              <h2 class="title" style ="color:#355691">HOW IT WORKS</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay="00ms">
            <div class="iconbox-style8 active text-center">
              <div class="icon"><img src="images/icon/album.png" alt="" width="100px" height="100px"></div>
              <div class="iconbox-content">
                <h4 class="title" style ="color:#355691">Create an album</h4>
                <p class="text mb-1">Name your Event & Album, pick your Event date, then Generate your QR code or link.</p>
                
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
            <div class="iconbox-style8 active text-center">
            <div class="icon"><img src="images/icon/share.png" alt="" width="100px" height="100px"></div>
              <div class="iconbox-content">
                <h4 class="title" style ="color:#355691">Share it</h4>
                <p class="text mb-1">Share your QR code and link with your guests. Print it, text it, email it!</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
            <div class="iconbox-style8 active text-center">
            <div class="icon"><img src="images/icon/memories.png" alt="" width="100px" height="100px"></div>
              <div class="iconbox-content">
                <h4 class="title" style ="color:#355691">Enjoy your album!</h4>
                <p class="text mb-1">Watch your pictures and videos come in and share them with everyone that attended.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
                  <div col-md-12 style="text-align: center;">
                  <a href="{{ route('google.login') }}" class="ud-btn btn-thm text-clr-blue btn-hover-clr-white">Get started now<i class="fal fa-arrow-right-long"></i></a>  
                  </div>
        </div>
      </div>
    </section>

    <!-- Explore Apartment -->
    <!--<section class="pb30-md bgc-f7" id="testimonials" style ="background:#C8E2F9">-->
    <!--  <div class="container">-->
    <!--    <div class="row align-items-md-center">-->
    <!--      <div class="col-lg-6 mb30-md wow fadeInUp" data-wow-delay="100ms">-->
    <!--        <div class="main-title">-->
    <!--          <p class="paragraph" >TESTIMONIALS</p>-->
    <!--          <h2 class="title" style ="color:#355691">See What Our Users <br class="d-none d-md-block"> Have To Say About ________</h2>-->
    <!--        </div>-->
            
    <!--      </div>-->
    <!--      <div class="col-lg-6 col-xl-4 offset-xl-2">-->
    <!--        <div class="testimonial-slider2 navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme wow fadeInUp" data-wow-delay="300ms">-->
    <!--          <div class="item">-->
    <!--            <div class="testimonial-style1 position-relative mb25">-->
    <!--              <div class="testimonial-content">-->
    <!--                <h5 class="title">Great Work</h5>-->
    <!--                <span class="icon fas fa-quote-left"></span>-->
    <!--                <p class="text">“Amazing design, easy to customize and a design quality superlative account on its cloud platform for the optimized performance. And we didn’t on our original designs.”</p>-->
    <!--                <div class="testimonial-review">-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a href="#"><i class="fas fa-star"></i></a>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--              <div class="thumb d-flex align-items-center">-->
    <!--                <div class="flex-shrink-0">-->
    <!--                  <img class="wa" src="images/testimonials/testimonial-1.png" alt="">-->
    <!--                </div>-->
    <!--                <div class="flex-grow-1 ms-3">-->
    <!--                  <h6 class="mb-0" style ="color:#355691">Leslie Alexander</h6>-->
    <!--                  <p class="mb-0">Nintendo</p>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          <div class="item">-->
    <!--            <div class="testimonial-style1 position-relative mb25">-->
    <!--              <div class="testimonial-content">-->
    <!--                <h5 class="title">Great Work</h5>-->
    <!--                <span class="icon fas fa-quote-left"></span>-->
    <!--                <p class="text">“Amazing design, easy to customize and a design quality superlative account on its cloud platform for the optimized performance. And we didn’t on our original designs.”</p>-->
    <!--                <div class="testimonial-review">-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a href="#"><i class="fas fa-star"></i></a>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--              <div class="thumb d-flex align-items-center">-->
    <!--                <div class="flex-shrink-0">-->
    <!--                  <img class="wa" src="images/testimonials/testimonial-2.png" alt="">-->
    <!--                </div>-->
    <!--                <div class="flex-grow-1 ms-3">-->
    <!--                  <h6 class="mb-0" style ="color:#355691">Floyd Miles</h6>-->
    <!--                  <p class="mb-0">Bank of America</p>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          <div class="item">-->
    <!--            <div class="testimonial-style1 position-relative mb25">-->
    <!--              <div class="testimonial-content">-->
    <!--                <h5 class="title">Great Work</h5>-->
    <!--                <span class="icon fas fa-quote-left"></span>-->
    <!--                <p class="text">“Amazing design, easy to customize and a design quality superlative account on its cloud platform for the optimized performance. And we didn’t on our original designs.”</p>-->
    <!--                <div class="testimonial-review">-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a href="#"><i class="fas fa-star"></i></a>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--              <div class="thumb d-flex align-items-center">-->
    <!--                <div class="flex-shrink-0">-->
    <!--                  <img class="wa" src="images/testimonials/testimonial-3.png" alt="">-->
    <!--                </div>-->
    <!--                <div class="flex-grow-1 ms-3">-->
    <!--                  <h6 class="mb-0" style ="color:#355691">Dianne Russell</h6>-->
    <!--                  <p class="mb-0">Facebook</p>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          <div class="item">-->
    <!--            <div class="testimonial-style1 position-relative mb25">-->
    <!--              <div class="testimonial-content">-->
    <!--                <h5 class="title">Great Work</h5>-->
    <!--                <span class="icon fas fa-quote-left"></span>-->
    <!--                <p class="text">“Amazing design, easy to customize and a design quality superlative account on its cloud platform for the optimized performance. And we didn’t on our original designs.”</p>-->
    <!--                <div class="testimonial-review">-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a class="me-1" href="#"><i class="fas fa-star"></i></a>-->
    <!--                  <a href="#"><i class="fas fa-star"></i></a>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--              <div class="thumb d-flex align-items-center">-->
    <!--                <div class="flex-shrink-0">-->
    <!--                  <img class="wa" src="images/testimonials/testimonial-3.png" alt="">-->
    <!--                </div>-->
    <!--                <div class="flex-grow-1 ms-3">-->
    <!--                  <h6 class="mb-0" style ="color:#355691">Dianne Russell</h6>-->
    <!--                  <p class="mb-0">Facebook</p>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</section>-->

       <!-- Our Partners --> 
    <!--    <section class="our-partners pt0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 wow fadeInUp" data-wow-delay="100ms">
            <div class="main-title text-center">
            
            </div>
          </div>
          <div class="col-lg-12">
            <div class="dots_none nav_none slider-dib-sm slider-6-grid owl-carousel owl-theme wow fadeInUp" data-wow-delay="300ms">
              <div class="item">
                <div class="partner_item"><img class="wa m-auto" src="images/partners/1.png" alt="1.png"></div>
              </div>
              <div class="item">
                <div class="partner_item"><img class="wa m-auto" src="images/partners/2.png" alt="2.png"></div>
              </div>
              <div class="item">
                <div class="partner_item"><img class="wa m-auto" src="images/partners/3.png" alt="3.png"></div>
              </div>
              <div class="item">
                <div class="partner_item"><img class="wa m-auto" src="images/partners/4.png" alt="4.png"></div>
              </div>
              <div class="item">
                <div class="partner_item"><img class="wa m-auto" src="images/partners/5.png" alt="5.png"></div>
              </div>
              <div class="item">
                <div class="partner_item"><img class="wa m-auto" src="images/partners/6.png" alt="6.png"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

        <!-- UI Elements Sections -->
    <section class="breadcumb-section" id="faqs" style ="background:#C8E2F9">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1" style="text-align: center;">
              <!-- <p style="color:#C8E2F9";>FREQUENTLY ASKED QUESTIONS</p> -->
              <h1 class="title" style="color:#355691";>FAQ's</h1>
              <div class="breadcumb-list">
                <!-- <a href="#">Home</a>
                <a href="#">For Rent</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section Area -->
    <section class="our-faq pb40 pt-0" style="background-color: #C8E2F9;">
      <div class="container">
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-lg-6 mrgnbtm-20">
            <div class="ui-content">
              <!-- <h4 class="title">Question About Selling</h4> -->
              <div class="accordion-style1 faq-page mb-lg-5">
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color:#355691";>How does Snapshot Albums work?</button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="accordion-body">We connect your existing or new Google Drive&trade; account to your Snapshot Albums account. When you create a new album on our dashboard, it creates a new folder within your Google Drive&trade; space. Once your guests upload images 
                        and videos through your album-specific QR code or web link, Snapshot Albums places the files directly into your Google Drive&trade; folder. All for free!</div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color:#355691";>Is Snapshot Albums free?</button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="accordion-body">Yes! Snapshot Albums is free to use. Collect images and videos from your guests for free.
                      <a href="https://snapshot-albums.com/pricing" style="color:#355691"><strong>Paid users</strong></a> have access to 10+ Canva&trade; QR code flyer templates, have access to share the photos and videos guests uploaded in a public gallery, as well as the ability to create more than one album.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item active">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Where do my photos and videos go?</button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="accordion-body"><p>Snapshot Albums connects to your Google Drive&trade; account and stores your pictures and videos safely on the cloud. We do not host any of the files uploaded.</p></div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">How many pictures and videos can my guests upload to my album?</button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="accordion-body">Snapshot Albums uses your connected Google Drive&trade; account to store the uploaded pictures and videos. The only limit is the available space in your Drive account. You can check the amount of space you have available and add space to your Google Drive&trade; account <a href="https://one.google.com/storage" style="color:#355691"><strong>here</strong></a>.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>
          <div class="col-lg-6">
            <div class="ui-content">
              <!-- <h4 class="title">Question About Selling</h4> -->
              <div class="accordion-style1 faq-page mb-4 mb-lg-5">
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseOne" style="color:#355691";>What if I don’t have enough Google Drive&trade; space?</button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="accordion-body">Google Drive&trade; gives you 15 GBs of space for free with each new account. We find that some people decide to <a href="https://accounts.google.com/signup/v2/createaccount?theme=glif&flowName=GlifWebSignIn&flowEntry=SignUp" target="_blank" style="color:#355691"><strong>create a new Google account</strong></a> 
                        for their event. You can also <a href="https://one.google.com/storage" target="_blank" style="color:#355691"><strong>add storage space to an already existing account</strong></a> for $2/month.</div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">Will I be notified if I am out of space in my album?</button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="accordion-body">Google automatically alerts users when they are near or at their assigned storage limit for their individual accounts and shared drives. If you are concerned about space, you can always <a href="https://one.google.com/storage" target="_blank" style="color:#355691"><strong>add storage space to an already existing account</strong></a> for $2/month.</div>
                    </div>
                  </div>
                  <div class="accordion-item active">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseThree">Can I share the album with the guests after my event?</button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="accordion-body"><p>Yes! When you create your album and <a href="https://snapshot-albums.com/pricing" style="color:#355691"><strong>become a paid user</strong></a>, you can enable sharing. This provides you with an album share link that all your guests can use to see the pictures and videos they’ve uploaded. All uploaded files can be reviewed and/or removed by you, the owner of the album. This link can be found on your dashboard, titled: "Gallery"</p></div>
                    </div>
                  </div>
                  <div class="accordion-item active">
                    <h2 class="accordion-header" id="headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseFour">Can I create more than one album?</button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="accordion-body"><p>Yes! As a <a href="https://snapshot-albums.com/pricing" style="color:#355691"><strong>paid user</strong></a> you can create as many albums as you'd like. Simply tap or click "Create Album" on the dashboard once logged in, provide the folder name, event name and date. Then your album-specific QR code and web link will be generated.</br></br>This is perfect for any individual or business that needs to collect images and videos from guests at many events. Party and wedding planners, event coordinators, or even families that have lots of birthday parties or gatherings!</p></div>
                    </div>
                  </div>
                  <div class="accordion-item active">
                    <h2 class="accordion-header" id="headingFive">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseFive">Can I do this myself with Google Drive&trade;?</button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                      <div class="accordion-body"><p>Google Drive&trade; alone doesn't give you an easy way for other people to upload images and videos into a folder you create. Snapshot Albums makes it easy to set up the folder and provide your guests with the link or QR code to upload their images and videos directly to your folder WITHOUT being able to see what others have shared. All on one easy-to-use dashboard for free! <a href="https://snapshot-albums.com/google/login" style="color:#355691"><strong>Try it now</strong></a>.</p></div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
         </div>
        </div>
      </div>
    </section>

    <section class=" pb70 pb30-md">
      <div class="container">
        <div class="row align-items-md-center wow fadeInUp" data-wow-delay="00ms">
          <div class="col-lg-9">
            <div class="main-title2">
              <h2 class="title" style="color:#355691";>Use Snapshot Albums for</h2>
            </div>
          </div>
          <!-- <div class="col-lg-3">
            <div class="text-start text-lg-end mb-3">
              <a class="ud-btn2" href="#">See All Properties<i class="fal fa-arrow-right-long dark-color"></i></a>
            </div>
          </div> -->
        </div>
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/wedding.jpg"  style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Weddings</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
            
          </div>
          <div class="col-sm-6 col-lg-3">
          
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/family.jpg"   style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Family reunions</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
            
          </div>
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/birthday.jpg"  style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Birthday parties</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
          
          </div>
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/5krun.jpg"  style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>5K run / walks</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
            
          </div>
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/town_events.jpg"  style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Town events</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
            
          </div>
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/festivals.jpg"  style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Festivals</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
            
          </div>
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/corporate.jpg"   style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Corporate events</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
          
          </div>
          <div class="col-sm-6 col-lg-3">
            
              <div class="position-relative mb50 mb20-md d-flex align-items-center">
                <div class="city-img flex-shrink-0"><img src="images/listings/baby_shower.jpg"  style="border-radius: 8px;" alt=""></div>
                <div class="flex-shrink-1 ms-3">
                  <h6 class="mb-1" style="color:#355691";>Baby showers</h6>
                  <!-- <p class="mb-0">12 Properties</p> -->
                </div>
              </div>
          </div>
        </div>

        <div class="row align-items-md-center wow fadeInUp" data-wow-delay="00ms">
          <div class="col-lg-12">
            <div class="main-title2" style="text-align: center; border: 2px solid #355691; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; background: linear-gradient(to right, #e3f2fd, #bbdefb);">
              <h6 class="paragraph" style="color: #355691; margin: 0;">If you’re planning an event, Snapshot Albums is perfect for collecting the pictures and videos your guests capture.</h6>
          </div>
          
          </div>
          <div class="row">
                  <div col-md-12 style="text-align: center;">
                  <a href="{{ route('google.login') }}" class="ud-btn btn-thm text-clr-blue btn-hover-clr-white">Get started now<i class="fal fa-arrow-right-long"></i></a>  
                  </div>
        </div>
        </div>
      </div>
    </section>
  <!-- Our CTA --> 
 
  <section class="our-cta2 p0 px20">
      <div class="cta-banner2 bgc-thm maxw1600 mx-auto pt30 pt50-md pb30 pb50-md px30-md  position-relative" style="margin-top: 20px;background-color:#C8E2F9;">
        
        <div class="container ">
          <div class="row text-align-center-on-mob">
            <div class="col-lg-6 col-xl-6 wow fadeInUp text-align-center-on-mob" data-wow-delay="500ms">
              <div class="cta-style2">
              <h2 class="cta-title" style="color:#355691">It’s Free. Start Collecting<br>Your Photos Today!</h2>
        
                <a href="{{ route('google.login') }}" class="ud-btn btn-transparent mr30 mr0-xs text-clr-blue btn-hover-clr-white" >Get started now<i class="fal fa-arrow-right-long"></i></a>
              </div>
            </div>

            <div class="col-lg-6 col-xl-6 wow fadeInUp hide-on-mob" style="text-align:center;" data-wow-delay="500ms">
               <img src="images/frontend/homepage-party1.png" width="450px" alt="snaphot albums party photos">
              
            </div>


          </div>
        </div>
      </div>
    </section>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
  $(document).ready(function() {
    // Smooth scrolling for all anchor links
    $('a[href^="#"]').on('click', function(event) {
      var target = $(this.getAttribute('href'));
      if (target.length) {
        event.preventDefault();
        $('html, body').stop().animate({
          scrollTop: target.offset().top
        }, 1000); // Adjust the scroll speed as needed (in milliseconds)
      }
    });
  });
</script>


    <!-- Our Footer --> 
    @include("frontend.layouts.footer")
