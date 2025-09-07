<!DOCTYPE html>
<!-- dashboard header nav -->
<html dir="ltr" lang="en">

<!-- Mirrored from creativelayers.net/themes/homez-html/page-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:24:13 GMT -->
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
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/ace-responsive-menu.css')}}">
<link rel="stylesheet" href="{{ asset('css/menu.css')}}">
<link rel="stylesheet" href="{{ asset('css/fontawesome.css')}}">
<link rel="stylesheet" href="{{ asset('css/flaticon.css')}}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/ud-custom-spacing.css')}}">
<link rel="stylesheet" href="{{ asset('css/animate.css')}}">
<link rel="stylesheet" href="{{ asset('css/slider.css')}}">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/dashbord_navitaion.css')}}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
<!-- Title -->
<!-- gallery -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<!--  gallerys-->
<title>Snapshot Albums – @yield('title', '')</title>
<!-- Favicon -->
<link href="{{asset('images/logo/logo-Albums Black.png')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />


</head>
<body>
<div class="wrapper">
  <div class="preloader"></div>
  
  <!-- Main Header Nav -->
  <header class="header-nav nav-innerpage-style menu-home4 dashboard_header main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr"> 
      <div class="container-fluid pr30 pr15-xs pl30 posr menu_bdrt1">
        <div class="row align-items-center justify-content-between">
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-start d-flex align-items-center">
              <div class="dashboard_header_logo position-relative me-2 me-xl-5">
                <a href="/dashboard" class="logo"><img src="{{asset('images/logo/logo-Albums Black.png')}}" width="70px" height="70px" alt=""></a>
              </div>
              <div class="fz20 ms-2 ms-xl-5">
                <a href="#" class="dashboard_sidebar_toggle_icon text-thm1 vam"><img src="{{ asset('images/dark-nav-icon.svg')}}" alt=""></a>
              </div>
            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  
  <div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr30 pr0-xl">
      <div class="dashboard__sidebar d-none d-lg-block">
        <div class="dashboard_sidebar_list">
          <div class="sidebar_list_item">
            <a href="/dashboard" class="items-center"><i class="flaticon-discovery mr15"></i>Dashboard</a>
          </div>
          <!-- <div class="sidebar_list_item ">
            <a href="page-dashboard-message.html" class="items-center"><i class="flaticon-chat-1 mr15"></i>Message</a>
          </div> -->
          <!-- For Sale -->
          <p class="fz15 fw400 ff-heading mt30">ALBUM</p>
          <div class="sidebar_list_item ">
            <a href="/album/create" class="items-center"><i class="flaticon-new-tab mr15"></i>Create Album</a>
          </div>
          <!-- <div class="sidebar_list_item ">
            <a href="{{route('album.index')}}" class="items-center"><i class="flaticon-new-tab mr15"></i>All Albums</a>
          </div> -->
          <p class="fz15 fw400 ff-heading mt30">CUSTOM IMAGE</p>
          <div class="sidebar_list_item ">
            <a href="/album/1/edit" class="items-center"><i class="flaticon-new-tab mr15"></i>Upload Image</a>
          </div>

          <p class="fz15 fw400 ff-heading mt30">HELPFUL LINKS & TIPS</p>
         

          <div class="sidebar_list_item ">
            <a href="{{url('tutorial')}}" class="items-center"><i class="flaticon-new-tab mr15"></i>Tutorials</a>
          </div>

          <div class="sidebar_list_item ">
            <a href="/user/account" class="items-center"><i class="flaticon-new-tab mr15"></i>Account</a>
          </div>
          <!-- <div class="sidebar_list_item ">
            <a href="#" class="items-center"><i class="flaticon-new-tab mr15"></i>check Drive Quota</a>
          </div> -->
          <div class="sidebar_list_item ">
            <a href="{{url('logout')}}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="items-center"><i class="flaticon-new-tab mr15"></i>Logout</a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
        
        </div>
      </div>
      <div class="dashboard__main pl0-md">
        <div class="dashboard__content bgc-f7">
          <div class="row pb40">
            <div class="col-lg-12">
              <div class="dashboard_navigationbar d-block d-lg-none">
                <div class="dropdown">
                  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i> Dashboard Navigation</button>
                  <ul id="myDropdown" class="dropdown-content">
                    <li class=""><a href="/dashboard"><i class="flaticon-discovery mr10"></i>Dashboard</a></li>
                    <li><a href="/album/create"><i class="flaticon-user mr10"></i> Create Album</a></li>
                    <li><p class="fz15 fw400 ff-heading mt30 pl30">CUSTOM IMAGE</p></li>
                    <li><a href="/album/1/edit"><i class="flaticon-new-tab mr10"></i>Upload Image</a></li>
                    <li><p class="fz15 fw400 ff-heading mt30 pl30">HELPFUL LINKS & TIPS</p></li>
                    <li><a href="{{url('tutorial')}}"><i class="flaticon-protection mr10"></i>Tutorials</a></li>
                    <li><a href="/user/account"><i class="flaticon-user mr10"></i>Account</a></li>
                    <li><a class="" href="{{url('logout')}}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="flaticon-exit mr10"></i>Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current path
    const currentPath = window.location.pathname;
// alert(currentPath);
    // Select all <li> elements within the <ul class="nav">
    const navItems = document.querySelectorAll('li');

    // Loop through each <li> element
    navItems.forEach(function(li) {
        // Get the <a> tag within the <li>
        const link = li.querySelector('a');
        if (link && link.getAttribute('href') === currentPath) {
            li.classList.add('active'); // Add 'active' class to <li> if href matches current path
        }
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current path
    const currentPath = window.location.pathname;

    // Select all anchor tags with class 'items-center'
    const navLinks = document.querySelectorAll('.items-center');

    // Loop through each anchor tag
    navLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('-is-active'); // Add 'is-active' class to anchor tag if href matches current path
        }
    });
});
</script>
