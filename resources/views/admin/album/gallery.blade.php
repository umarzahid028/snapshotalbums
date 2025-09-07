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

<title>Snapshot Albums - Gallery</title>

<!-- Favicon -->
<link href="{{asset('images/logo/logo-White.png')}}" sizes="128x128" rel="shortcut icon" />



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

<!-- api key for map -->



<style>

      #upload-form {

        position: relative;

        background-size: cover;

        background-position: center;

        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);

        padding: 20px;

    }



    #upload-form::before {

        content: "";

        position: absolute;

        top: 0;

        left: 0;

        width: 100%;

        height: 100%;

        box-shadow: inset 0 0 0 1000px rgb(243 238 233 / 93%); /* Adjust the color and opacity as needed */

    }



    .dashboard__main {

    margin-top: 90px;

    padding-left: 40px;

    width: 100%;

    }



    .dashboard__content{

        padding:0px !important;

    }

    .height {

        height: 200px;

    }

    body{

        background:#355691;

    }

    .responsive-image {
        width: 100%;
        height: auto;
        object-fit: contain; /* or cover, depending on your preference */
    }

</style>

</head>

<body>

<div class="wrapper">

  <div class="preloader"></div>



  <div class="dashboard_content_wrapper">

    <div class="dashboard dashboard_wrapper pr30 pr0-xl">



    <div class="dashboard__main pl0-md">

        <div class="dashboard__content ">



        <h1 class="title mb30" style="color:#fff; font-weight:600; text-align:center">{{$folder->event_title}}</h1>

          <div class="row ">

@foreach ($user_payments as $payment)
    @if ($user_id == $payment->user_id)
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p20 p20-xs mb30 overflow-hidden position-relative">
                    <div class="row">
                        @if ($files->isNotEmpty())
                            @foreach ($files as $file)
                                @if (strpos($file->mimeType, 'image/') === 0) <!-- Ensure the file is an image -->
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="listing-style1 style2">
                                            <div class="list-thumb">
                                                <a href="https://drive.google.com/thumbnail?id={{ $file->id }}&sz=w1000" data-toggle="modal" data-target="#imageModal" data-image="https://drive.google.com/uc?export=view&id={{ $file->id }}">
                                                    <img class="responsive-image" src="https://drive.google.com/thumbnail?id={{ $file->id }}&sz=w1000" alt="{{ $file->name }}" onerror="this.src='{{ asset('path/to/placeholder-image.jpg') }}'">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

<!-- <script>
    // JavaScript to handle image modal
    document.querySelectorAll('.list-thumb a').forEach(link => {
        link.addEventListener('click', function() {
            var img = document.getElementById('modalImage');
            img.src = this.getAttribute('data-image');
        });
    });
</script> -->



<!-- 
@foreach ($user_payments as $payment)

    @if ($user_id == $payment->user_id)

        <div class="row">

            <div class="col-xl-12">

                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p20 p20-xs mb30 overflow-hidden position-relative">

                    <div class="row">

                        @if (!empty($folder->images))

                            @foreach (explode(',', $folder->images) as $image)

                                <div class="col-sm-6 col-xl-3">

                                    <div class="listing-style1 style2">

                                        <div class="list-thumb">

                                            <a href="{{ asset('uploads/' . trim($image)) }}" data-toggle="modal" data-target="#imageModal">

                                                <img class="responsive-image" src="{{ asset('uploads/' . trim($image)) }}" alt="">

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

@endforeach -->

<!-- Image Modal -->
<!-- 
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-body">

                <img src="" class="w-100" id="modalImage">

            </div>

        </div>

    </div>

</div> -->

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







<footer class="dashboard_footer" style="position:fixed; bottom: 0; left: 0; width: 100%; height: 20px; z-index: 100; background-color: #fff; box-sizing: border-box;">

      <div class="col-auto" style="text-align: center; padding: 0;">

        <div class="copyright-widget" style="">

          <p class="text" style="margin: 0; font-size: 14px; ">Snapshot - © All rights reserved</p>

        </div>

      </div>

</footer>



</body>



<!-- Mirrored from creativelayers.net/themes/homez-html/page-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 May 2023 13:24:15 GMT -->

</html>

<!-- 

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
</script> -->


<!-- 
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

</script> -->



<script>

    // Handle modal image click event

    $('#imageModal').on('show.bs.modal', function (e) {

        var imageSource = $(e.relatedTarget).attr('href');

        $('#modalImage').attr('src', imageSource);

    });

</script>

