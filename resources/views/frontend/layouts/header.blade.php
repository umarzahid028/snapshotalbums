<!DOCTYPE html>
<!-- unsure if used -->
<html dir="ltr" lang="en">

<!-- Mirrored from creativelayers.net/themes/homez-html/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:23:37 GMT -->
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VFP42SKZDY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VFP42SKZDY');
</script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('css/ace-responsive-menu.css')}}">
<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<link rel="stylesheet" href="{{asset('css/slider.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/ud-custom-spacing.css')}}">
<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
<!-- Title -->
<!-- <title>Snapshot Albums</title> -->
<title>Snapshot Albums – @yield('title', '')</title>
<!-- Favicon -->
<!-- <link href="{{asset('front/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" /> -->
<link href="{{asset('images/logo/logo-Albums Black.png')}}" sizes="128x128" rel="shortcut icon" />

      <!--  gsap-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    
      <style>
  


  #map {
  height: 800px;
  z-index: 0;
}



.bg-light{
    background-color:#355691 !important;
    color:white !important;
    font-size:16px !important;
  }

  a.nav-link{
    color:white !important;
    font-weight:500;
  }
  .navbar{
    padding-bottom:0 !important;
    padding-top:0 !important;
  }
      </style>
</head>
<body>
<div class="wrapper ovh">
  <!-- <div class="preloader"></div> -->
  


<header class="header-nav nav-homepage-style at-home5 stricky main-menu" style="background:#355691">
    <!-- Ace Responsive Menu -->
    <nav class="posr"> 
      <div class="container posr menu_bdrt1">
        <div class="row align-items-center justify-content-between">
          <div class="col-auto">
            <div class="d-flex align-items-center justify-content-between">
              <div class="logos mr40">
               
              <a class="header-logo logo1" href="{{ url('/') }}"><img src="{{asset('images/logo/logo-White.png')}}" height="100px" width="100px" alt="Header Logo"></a>
                
                <a class="header-logo logo2" href="{{ url('/') }}"><img src="{{asset('images/logo/logo-White.png')}}" height="100px" width="100px" alt="Header Logo"></a>
              </div>
              <!-- Responsive Menu Structure Menu-->
              <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                <li class="visible_list"> <a class="list-item" href="{{url('/')}}"><span class="title">Home</span></a>
                  
                </li>
                <li class="megamenu_style"> <a  class="list-item" href="{{url('/#how-to-collect')}}"><span class="title">Set Up</span></a>
                 
                </li>
                <li class="visible_list"> <a class="list-item" href="{{url('/#faqs')}}"><span class="title">FAQ</span></a>
                  
                </li>
                <li class="visible_list"> <a class="list-item" href="{{url('pricing')}}"><span class="title">Pricing</span></a>
                </li>
                
              </ul>
            </div>
          </div>
          <div class="col-auto">
            <div class="d-flex align-items-center">
              @if(Auth::check())
                <a class="login-info d-flex align-items-center" style="color: #C8E2F9;" href="{{ url('/dashboard') }}" role="button">
                  <i class="fat fa-user-circle fz30 me-2"></i>
                  <span class="d-none d-xl-block">Dashboard</span>
                </a>
              @else
                <a class="login-info d-flex align-items-center" style="color: #C8E2F9;" href="{{ route('google.login') }}" role="button">
                  <i class="fat fa-user-circle fz30 me-2"></i>
                  <span class="d-none d-xl-block">Sign Up</span>
                </a>
              @endif
              <!-- <a href="tel:18002915820" class="ud-btn btn-dark" style="background-color: transparent; border-color:white;"><span class="flaticon-call vam pe-2"></span>920 851 9087</a> -->
              <!-- <a class="ud-btn add-property menu-btn bdrs60 mx-2 mx-xl-4" href="#">SIGN UP <i class="fal fa-arrow-right-long"></i></a> -->
              <!-- <a class="sidemenu-btn filter-btn-right" href="#"><img class="img-1" src="{{asset('front/images/icon/nav-icon-white.svg')}}" alt=""><img class="img-2" src="images/icon/nav-icon-dark.svg" alt=""></a> -->
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>


  <!-- for mobile view -->


  <div class="hiddenbar-body-ovelay"></div>

<!-- mobile view only -->
  <div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
      <div class="header innerpage-style">
        <div class="menu_and_widgets">
          <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
          <nav class="navbar-light">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          </nav>
          <!-- <a class="menubar" href="#menu"><img src="{{asset('images/mobile-dark-nav-icon.svg')}}" alt=""></a> -->
            <a class="mobile_logo" href="/"><img src="{{asset('images/logo/logo-Albums Black.png')}}" width="100px" height="100px" alt=""></a>
            <a href="{{ route('google.login') }}"><span class="icon fz40 far fa-user-circle"></span></a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.mobile-menu -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Brand</a> -->
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#how-to-collect">Set Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#faqs">FAQ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pricing">Pricing</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

</div>
