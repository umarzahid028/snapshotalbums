@section('title', 'Create Album')

@include('layouts.admin.header_new')

<style>

   .bgc-f7{

    background:transparent !important;

   }

</style>





<div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">

<div class="modal" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="modal-body" style="background-color:#355691; color:white">
                    <p id="modalMessage" style="color:#fff !important"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color:#355691; color:white" onclick="window.location.href='/stripe'">Upgrade</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
</div>



@if(session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

@endif

                <h4 class="title fz17 mb30" style="color:#355691; font-weight:600">CREATE ALBUM</h4>

                <!-- <form class="form-style1"> -->

                  <form method="POST" action="{{ route('google.drive.create.folder') }}" enctype="multipart/form-data"  class="form-style1">

                  @csrf

                  

                  <div class="row">

                    <div class="col-sm-6 col-xl-12">

                      <div class="mb20">

                        <label class="heading-color ff-heading fw600 mb10">Event Title:</label>

                        <input type="text" name="event_title" placeholder="William & Jenny's Wedding" class="form-control" required>

                      </div>

                      <div class="mb20">

                        <label class="heading-color ff-heading fw600 mb10">Google Drive&trade; Folder Name:</label>

                        <input type="text" name="folder_name" placeholder="Our Wedding Pictures" class="form-control" required>

                      </div>

                      <div class="mb20">

                        <label class="heading-color ff-heading fw600 mb10">Date of Event:</label>

                        <input type="date" name="date_of_event" class="form-control" required>

                      </div>

                    </div>

                    <div class="col-md-12">

                      <div class="text-end">

                        <button class="ud-btn btn-thm" type="submit">Create<i class="fal fa-arrow-right-long"></i></button>

                      </div>

                    </div>

                  </div>

                </form>

              </div>





@include('layouts.admin.footer_new')



<script>
        // If there is an error message in the session, show the modal
        @if (session('error'))
            document.getElementById('modalMessage').innerText = "{{ session('error') }}";
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
</script>