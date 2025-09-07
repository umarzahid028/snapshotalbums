<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from creativelayers.net/themes/homez-html/page-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:24:13 GMT -->
<head>
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
<!-- gallery -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<!--  gallerys-->
<!-- Title -->
<title>Snapshot Albums - Guest</title>
<!-- Favicon -->

<link href="{{asset('images/logo/logo-White.png')}}" sizes="128x128" rel="shortcut icon" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- api key for map -->

@php
    $customImage = $folder->custom_image ? asset('uploads/' . $folder->custom_image) : null;
@endphp

<style>
    #upload-form {
        position: relative;
        @if ($customImage)
            background-image: url('{{ $customImage }}') !important;
        @endif
        background-size: cover;
        background-position: center;
        /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); */
        padding: 20px;
        /* color: #000; Ensures text inside the form is black */
    }


  #upload-form::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
      z-index: 1; /* Ensure the overlay appears above the background image */
      /* box-shadow: inset 0 0 0 1000px rgb(243 238 233 / 93%); Adjust the color and opacity as needed */
  }

  #upload-form > * {
  position: relative;
  z-index: 2; /* Ensures the content appears above the overlay */
  color: #fff; Makes the content area white
  padding: 10px;
  border-radius: 5px; /* Optional: Adds a slight border-radius for aesthetics */
}

#upload-form .icon,#upload-form .title{
  color: #fff !important;
}
#upload-form .alert{
  color: black;
}

.bgc-f7{
  background: transparent !important;
}

  .height {
      height: 200px;
  }

    .dashboard__main {
    margin-top: 10px;
    padding-left: 40px;
    width: 100%;
    }

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        align-items: flex-start;
        /* text-align:center; */
    }
}
</style>
</head>
<body>
<div class="wrapper">
  <div class="preloader"></div>

  <div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr30 pr0-xl">

    <div class="dashboard__main pl0-md">
        <div class="dashboard__content bgc-f7">
          <div class="row pb40">

<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative" id="upload-form" >
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="header-container">
        <h4 class="title fz17 mb30" style="color: #355691; z-index: 1000;">
            <span></span> {{$folder->event_title}}
        </h4>
        <h4 class="title fz17 mb30" style="color: #355691; z-index: 1000;">
            <span></span> By uploading image(s) I understand that the host can use the image(s) at their discretion.
        </h4>
    </div>
  
    <form method="POST" action="{{route('google.drive.file-upload-out-side')}}" enctype="multipart/form-data" class="form-style1">
        @csrf
        <div class="row"  >
            <div class="col-sm-6 col-xl-12" >
                <div></div>

                <div class="col-lg-12">
                    <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">
                        <div class="icon mb30"><span class="flaticon-upload"></span></div>
                        <h4 class="title fz17 mb10">UPLOAD PICTURES OR VIDEOS YOU WANT TO SHARE
                            </h4>
                        <!-- Hidden file input field with a unique ID -->
                        <input type="file" id="fileInput" name="uploaded_files[]" multiple accept="image/*,video/*" style="display: none;" required>
                        <input type="text" name="folder_id" value="{{$folder->folder_id}}" style="display: none;">
                        <input type="text" name="id" value="{{$folder->id}}" style="display: none;">
                        <!-- Use the label element to style the "Browse Files" button -->
                        <label for="fileInput" class="ud-btn btn-thm">Browse Files<i class="fal fa-arrow-right-long"></i></label>
                        <div style="color:#fff;" id="selectedFilesContainer"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-end">
                        <button class="ud-btn btn-thm" type="submit">Upload<i class="fal fa-arrow-right-long"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!--
@foreach ($user_payments as $payment)
    @if ($user_id == $payment->user_id)
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 p20-xs mb30 overflow-hidden position-relative">
                    <div class="row">
                        @if ($files->isNotEmpty())
                            @foreach ($files as $file)
                                <div class="col-sm-6 col-xl-3">
                                    <div class="listing-style1 style2">
                                        <div class="list-thumb">
                                            <a href="https://drive.google.com/thumbnail?id={{ $file->id }}&sz=w1000" data-toggle="modal" data-target="#imageModal">
                                                <img class="w-100 height" src="https://drive.google.com/thumbnail?id={{ $file->id }}&sz=w1000" alt="{{ $file->name }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p style="text-align: center;">There are no images in this folder.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
-->
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" class="w-100" id="modalImage">
            </div>
        </div>
    </div>
</div>
<!-- images start -->
 <!-- images close -->
      </div>
    </div>
  </div>
  <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
</div>
<!-- Wrapper End -->
<script src="{{ asset('js/jquery-3.6.4.min.js')}}"></script> 
<script src="{{ asset('js/jquery-migrate-3.0.0.min.js')}}"></script> 
<script src="{{ asset('js/popper.min.js')}}"></script> 
<script src="{{ asset('js/bootstrap.min.js')}}"></script> 
<script src="{{ asset('js/bootstrap-select.min.js')}}"></script> 
<script src="{{ asset('js/jquery.mmenu.all.js')}}"></script> 
<script src="{{ asset('js/ace-responsive-menu.js')}}"></script> 
<script src="{{ asset('js/chart.min.js')}}"></script>
<script src="{{ asset('js/chart-custome.js')}}"></script>
<script src="{{ asset('js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{ asset('js/dashboard-script.js')}}"></script>
<!-- Custom script for all pages --> 
<script src="{{ asset('js/script.js')}}"></script>
<!--gallery  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- gallery -->
</body>

<!-- Mirrored from creativelayers.net/themes/homez-html/page-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:24:15 GMT -->
</html>
<script>
     document.getElementById('fileInput').addEventListener('change', function (event) {
        const selectedFiles = event.target.files;
        const selectedFilesContainer = document.getElementById('selectedFilesContainer');

        // Check if any files were selected
        if (selectedFiles.length > 0) {
            // Create a list to display the selected file names
            const fileList = document.createElement('ul');

            // Iterate through the selected files and add their names to the list
            for (let i = 0; i < selectedFiles.length; i++) {
                const listItem = document.createElement('li');
                listItem.textContent = selectedFiles[i].name;
                fileList.appendChild(listItem);
            }

            // Update the selectedFilesContainer with the list of file names
            selectedFilesContainer.innerHTML = '';
            selectedFilesContainer.appendChild(fileList);
        } else {
            // Clear the container if no files are selected
            selectedFilesContainer.innerHTML = '';
        }
    });
</script>

<script>
    // Handle modal image click event
    $('#imageModal').on('show.bs.modal', function (e) {
        var imageSource = $(e.relatedTarget).attr('href');
        $('#modalImage').attr('src', imageSource);
    });
</script>
@include('layouts.admin.footer_new')
