<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from creativelayers.net/themes/homez-html/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:24:39 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="advanced search, agency, agent, classified, directory, house, listing, property, real estate, real estate agency, real estate agent, realestate, realtor, rental">
<meta name="description" content="Homez - Real Estate HTML Template">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/ace-responsive-menu.css')}}">
<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('css/ud-custom-spacing.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
<!-- Title -->
<title>Lorem - Lorem Ispum</title>
<!-- Favicon -->
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />
<!-- Apple Touch Icon -->
<link href="images/apple-touch-icon-60x60.png" sizes="60x60" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
<link href="images/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
<link href="images/apple-touch-icon-180x180.png" sizes="180x180" rel="apple-touch-icon">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="bgc-f7">
<div class="wrapper ovh">
  <div class="preloader"></div>
  <div class="body_content">
    <!-- Our Compare Area -->
    <section class="our-compare pt60 pb60">
      <img src="{{asset('images/icon/login-page-icon.svg')}}" alt="" class="login-bg-icon wow fadeInLeft" data-wow-delay="300ms">
      <div class="container">
        <div class="row wow fadeInRight" data-wow-delay="300ms">
          <div class="col-lg-6">
            <div class="log-reg-form signup-modal form-style1 bgc-white p50 p30-sm default-box-shadow2 bdrs12">
              <div class="text-center mb40">
                <img class="mb25" src="{{asset('images/logo.png')}}" width="100px" height="100px" alt="">
                <h2>Sign in</h2>
                <p class="text">Sign in with this account across the following sites.</p>
              </div>
              <form method="POST" action="{{ route('login') }}" class="signin-form">
              @csrf
              <div class="mb25">
                <label class="form-label fw600 dark-color">Email</label>
                <!-- <input type="email" class="form-control" placeholder="Enter Email"> -->
                <input name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" required>
                                @error('email')
                                <span class="invalid-feedback-black" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div class="mb15">
                <label class="form-label fw600 dark-color">Password</label>
                <!-- <input type="text" class="form-control" placeholder="Enter Password"> -->
                <input name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb10">
                <label class="custom_checkbox fz14 ff-heading">Remember me
                  <input type="checkbox" checked="checked">
                  <span class="checkmark"></span>
                </label>
                <!-- <a class="fz14 ff-heading" href="#">Lost your password?</a> -->
              </div>
              <div class="d-grid mb20">
                <button class="ud-btn btn-thm" type="submit">Sign in <i class="fal fa-arrow-right-long"></i></button>
              </div>
              </form>
              <!-- <div class="hr_content mb20"><hr><span class="hr_top_text">OR</span></div>
              <div class="d-grid mb10">
                <button class="ud-btn btn-white fw400" type="button"><i class="fab fa-google"></i> Continue Google</button>
              </div>
              <div class="d-grid mb10">
                <button class="ud-btn btn-fb fw400" type="button"><i class="fab fa-facebook-f"></i> Continue Facebook</button>
              </div>
              <div class="d-grid mb20">
                <button class="ud-btn btn-apple fw400" type="button"><i class="fab fa-apple"></i> Continue Apple</button>
              </div>
              <p class="dark-color text-center mb0 mt10">Not signed up? <a class="dark-color fw600" href="page-register.html">Create an account.</a></p> -->
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
<script src="{{asset('js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<!-- Custom script for all pages --> 
<script src="{{asset('js/script.js')}}"></script>
</body>

<!-- Mirrored from creativelayers.net/themes/homez-html/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:24:40 GMT -->
</html>