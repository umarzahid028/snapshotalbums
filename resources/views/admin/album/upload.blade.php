
<style>
    #upload-form {
      position: relative;
      background-image: url('{{ asset('public/uploads/' . Auth()->User()->custom_image) }}') !important;
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
  color: #fff;
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
</style>

@section('title', 'Upload')

@include('layouts.admin.header_new')

<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative" id="upload-form">
  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <h4 class="title fz17 mb30" >GUEST PICS & VIDEOS</h4>
  <form method="POST" action="{{route('google.drive.file-upload')}}" enctype="multipart/form-data" class="form-style1">
      @csrf
       <!-- Include the folder ID as a hidden field -->
      <input type="hidden" name="folder_id" value="{{ $folder->folder_id }}">
      <input type="hidden" name="id" value="{{ $folder->id }}">
      <div class="row">
          <div class="col-sm-6 col-xl-12">
              <div class="col-lg-12">
                  <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">
                      <div class="icon mb30"><span class="flaticon-upload"></span></div>
                      <h4 class="title fz17 mb10">UPLOAD PICTURES OR VIDEOS YOU WANT TO SHARE
                          <br> WITH THE COUPLE.</h4>
                      <!-- Hidden file input field with a unique ID -->
                      <input type="file" id="fileInput" name="uploaded_files[]" multiple accept="image/*,video/*" style="display: none;" required>
                      <input type="text" name="folder_id" value="{{$folder->folder_id}}" style="display: none;">
                      <input type="text" name="id" value="{{$folder->id}}" style="display: none;">
                      <!-- Use the label element to style the "Browse Files" button -->
                      <label for="fileInput" class="ud-btn btn-thm">Browse Files<i class="fal fa-arrow-right-long"></i></label>
                      <!-- <img src="{{ asset('public/uploads/' . Auth()->User()->custom_image) }}" alt="Custom Image"> -->
                      <div style="color: #b17f54;" id="selectedFilesContainer"></div>
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
  @if (Auth::user()->id == $payment->user_id)
      <div class="row">
          <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 p20-xs mb30 overflow-hidden position-relative">
                  <div class="row">
                      @if (!empty($folder->images))
                          @foreach (explode(',', $folder->images) as $image)
                              <div class="col-sm-6 col-xl-3">
                                  <div class="listing-style1 style2">
                                      <div class="list-thumb">
                                          <a href="{{ asset('public/uploads/' . trim($image)) }}" data-toggle="modal" data-target="#customImageModal">
                                              <img class="w-100 height" src="{{ asset('public/uploads/' . trim($image)) }}" alt="">
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>
          </div>
      </div>
  @endif
@endforeach
-->


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

@include('layouts.admin.footer_new')
