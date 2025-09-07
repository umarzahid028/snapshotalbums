@section('title', 'Upload Image')

@include('layouts.admin.header_new')





<style>

  .bgc-f7{

    background:transparent !important;

  }



  .dashboard__content {

    padding: 0px 30px 10px !important;

}

</style>

<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">

@if(session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

@endif

                <h4 class="title fz17 mb30" style="font-weight:600">Upload Background Image</h4>

                <!-- <form class="form-style1"> -->

                  <form method="POST" action="{{route('album.update',Auth()->User()->id )}}"  enctype="multipart/form-data"  class="form-style1">

                  @csrf

                  @method('PUT')

                  

                  <div class="row">

                    <div class="col-sm-6 col-xl-12">

                    <div class="col-lg-12">

                          <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">

                            <div class="icon mb30"><span class="flaticon-upload" style:"color:#355691"></span></div>

                            <h4 class="title fz17 mb10">UPLOAD A CUSTOM BACKGROUND IMAGE

                            <br>(15MB size limit)</h4>

                            

                            <!-- <input type="file" id="fileInput" name="custom_image"  accept="image/*"style="display: none;" required> -->
                            <input type="file" id="fileInput" name="custom_image" accept="image/jpeg, image/png, image/jpg" style="display: none;" required>

                            <label for="fileInput" class="ud-btn btn-thm">Browse Files<i class="fal fa-arrow-right-long"></i></label>

                            <div style="color: #b17f54;" id="selectedImageContainer"></div>

                          </div>

                        </div>

                        

                    <div class="col-md-12">

                          <select name="folder_id" class="form-select" required>
                              <option value="" selected disabled>Select an album</option>
                              @foreach($folders as $folder)
                                  <option value="{{ $folder->id }}">{{ $folder->event_title }}</option>
                              @endforeach
                          </select>
                        <div class="text-end mt-1">
                        
                          <button class="ud-btn btn-thm" type="submit">Upload<i class="fal fa-arrow-right-long"></i></button>
                        
                        </div>
                      <!-- <div class="text-end">

                        <button class="ud-btn btn-thm" type="submit">Upload<i class="fal fa-arrow-right-long"></i></button>

                      </div> -->

                    </div>

                  </div>

                </form>

              </div>







              <script>

    // Add an event listener to the file input

    document.getElementById('fileInput').addEventListener('change', function (event) {

        const selectedFile = event.target.files[0];

        const selectedImageContainer = document.getElementById('selectedImageContainer');



        // Check if a file was selected

        if (selectedFile) {

            // Display the file name

            selectedImageContainer.textContent = selectedFile.name;

        } else {

            // Clear the container if no file is selected

            selectedImageContainer.textContent = '';

        }

    });

</script>



@include('layouts.admin.footer_new')

