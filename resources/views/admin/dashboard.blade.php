@section('title', 'Dashboard')

@include('layouts.admin.header_new')

<head>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.3.2/dist/html2canvas.min.js"></script>


</head>

<style>


  .modal-backdrop {

    position: fixed;

    top: 0;

    left: 0;

    z-index: auto !important;

    width: 100vw;

    height: 100vh;

    background-color: #000;

}

</style>



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



  .bgc-f7{

    background:transparent !important;

  }

  td,th{
    vertical-align: middle !important;
  }

  </style>





<div class="row align-items-center" >

            <div class="col-xxl-12" >

              <div class="dashboard_title_area">

                <h2 style="color:#355691">Hi {{explode(' ', $user->name)[0]}}!</h2>

                <!-- <h2>Albums</h2> -->

                <p class="text">Create new albums or view your existing albums below.</p>

              </div>

            </div>

            <!-- <div class="col-xxl-9">

              <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">

             

            </div>

            </div> -->

          </div>

          <div class="row">

              @if(session('error'))

                  <div class="alert alert-danger">{{ session('error') }}</div>

              @endif

              @if(session('success'))

                  <div class="alert alert-success">{{ session('success') }}</div>

              @endif

              <!-- Trial Status Banner -->
              @if($user->plan === 'trial' && $user->trial_ends_at)
                <div class="alert alert-info mb-4">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong>🎉 You're on a 7-day free trial!</strong>
                      <br>
                      <small>Trial expires on {{ $user->trial_ends_at->format('M d, Y \a\t g:i A') }}</small>
                    </div>
                    <div>
                      <a href="/pricing" class="btn btn-primary btn-sm">Upgrade to Premium</a>
                    </div>
                  </div>
                </div>
              @elseif($user->plan === 'free')
                <div class="alert alert-warning mb-4">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong>📸 You're on the Free Plan</strong>
                      <br>
                      <small>Upgrade to Premium for unlimited albums and advanced features</small>
                    </div>
                    <div>
                      <a href="/pricing" class="btn btn-primary btn-sm">Upgrade to Premium</a>
                    </div>
                  </div>
                </div>
              @elseif($user->plan === 'premium' && $user->subscription_active)
                <div class="alert alert-success mb-4">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong>⭐ Premium Active</strong>
                      <br>
                      <small>You have access to all premium features</small>
                    </div>
                    <div>
                      <a href="/pricing" class="btn btn-outline-primary btn-sm">Manage Subscription</a>
                    </div>
                  </div>
                </div>
              @endif

            <div class="col-xl-12">

              <div class="ps-widget bgc-white bdrs12 mb30 overflow-hidden position-relative" >

                <div class="packages_table table-responsive">

<table class="table-style3 table at-savesearch table table-hover table-bordered ">

                    <thead class="t-head">

                      <tr>

                        <th scope="col">Title</th>

                        <th scope="col">Folder</th>

                        <th scope="col">Date</th>

                        <th scope="col">Gallery</th>

                        <th scope="col">Drive&trade; Album</th>

                        <th scope="col">Guest Link</th>

                        <th scope="col">Guest QR Code</th>

                        <!-- <th scope="col">QR Code</th> -->

                        <th scope="col">Delete</th>

                      </tr>

                    </thead>

                    <tbody class="t-body">

                    @if ($folders->isEmpty())

                        <tr>

                            <td colspan="7" class="text-center">Album not found</td>

                        </tr>

                    @else

                    @foreach ($folders as $folder)

                      <tr>

                        <td class="vam">{{$folder->event_title}}</td>

                        <td class="vam">{{$folder->folder_name}}</td>

                        <td class="vam">{{ \Carbon\Carbon::parse($folder->date_of_event)->format('m-d-Y') }}</td>

                       

                        @if ($user_payments->contains('user_id', Auth::user()->id))

                        <td><b><a href="{{ route('gallery', ['folder_id' => $folder->folder_id, 'user_id' => auth()->user()->id]) }}" target="_blank" style="color: #A88156;" class="ud-btn btn-thm">Gallery</a></b></td>

                        @else

                        <td> <b> <a href="{{route('admin.stripe')}}"  style="color: #A88156;">Enable</a></b></td>

                        @endif
                        <td>
                        <a href="https://drive.google.com/drive/folders/{{ $folder->folder_id }}" class="ud-btn btn-thm" target="_blank">GO</a>

                        </td>

                        <td><a href="{{ route('upload', ['folder_id' => $folder->folder_id, 'user_id' => auth()->user()->id]) }}" class="ud-btn btn-thm copy-btn">Copy</a></td>

                      


                      <div id="qrCodeDiv-{{ $folder->folder_id }}" style="padding:8px; background-color: transparent; border: 3px solid black; text-align: center; display: none; width:300px">
                          <!-- <h5 style="color: black; font-weight: 600; text-align: center;">Scan QR Code to access Folder</h5> -->
                          <!-- This is a placeholder for the QR code -->
                          {!! QrCode::size(255)->generate(route('upload', ['folder_id' => $folder->folder_id, 'user_id' => auth()->user()->id])) !!}
                      </div>
                      
                      <td>
                          <a type="button" class="ud-btn btn-thm" data-bs-toggle="modal" data-bs-target="#qrCodeModal-{{ $folder->folder_id }}" onclick="downloadQRCode('{{ $folder->folder_id }}')">
                              Download
                          </a>
                      </td> 

                      

                      <div class="modal fade" id="qrCodeModalContent-{{ $folder->folder_id }}" tabindex="-1" aria-labelledby="qrCodeModalLabel-{{ $folder->folder_id }}" aria-hidden="true">

                        <h2>Ok</h2>


                      </div>
                        {{-- {!! QrCode::size(255)->generate(route('upload', ['folder_id' => $folder->folder_id, 'user_id' => auth()->user()->id])) !!} --}}

                        <!-- <div class="modal fade" id="qrCodeModal-{{ $folder->folder_id }}" tabindex="-1" aria-labelledby="qrCodeModalLabel-{{ $folder->folder_id }}" aria-hidden="true">

                          <div class="modal-dialog modal-dialog-centered" id="mod">

                              <div class="modal-content" style="background-color: #c8e2f9; border:3px solid black;">

                                  <div class="modal-header d-flex justify-content-center" style="position: relative;">

                                      <h5 class="modal-title" id="qrCodeModalLabel-{{ $folder->folder_id }}" style="color: black; font-weight: 600; text-align: center; width: 100%;">Scan QR Code to access Folder</h5>

                                      {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 1rem; top: 1rem;"></button> --}}

                                  </div>

                                  <div class="modal-body text-center" style="padding:0px 0px 30px 0px ">

                                      {!! QrCode::size(255)->generate(route('upload', ['folder_id' => $folder->folder_id, 'user_id' => auth()->user()->id])) !!}

                                  </div>

                              </div>

                          </div>

                      </div> -->

                      

                      

                      

                        <td>  

                            <form action="{{ route('album.destroy', $folder->id) }}" method="POST" style="display: inline;">

                            @csrf

                            @method('DELETE')

                            <b>

                              <a href="#" class="ud-btn btn-thm" style="color: white !important; background-color:red" onclick="if(confirm('Are you sure you want to delete?')) { event.preventDefault(); this.closest('form').submit(); }">

                              Delete

                            </a>

                          </b>

                          </form>

                        </td>

                      </tr>

                      @endforeach

                      @endif

                    </tbody>

</table>

         

                </div>

              </div>

            </div>

          </div>






<!-- HTML2Canvas CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  function downloadQRCode(folderId) {
      var elementToCapture = document.getElementById('qrCodeDiv-' + folderId);

      // Temporarily display the element if it's hidden
      var wasHidden = elementToCapture.style.display === 'none';
      if (wasHidden) {
          elementToCapture.style.display = 'block';
      }

      html2canvas(elementToCapture).then(function(canvas) {
          if (wasHidden) {
              elementToCapture.style.display = 'none';
          }

          var dataURL = canvas.toDataURL('image/png');

          var downloadLink = document.createElement('a');
          downloadLink.href = dataURL;
          downloadLink.download = 'qr_code_' + folderId + '.png';

          document.body.appendChild(downloadLink);
          downloadLink.click();
          document.body.removeChild(downloadLink);
      }).catch(function(error) {
          console.error('Error capturing QR code:', error);
      });
  }
</script>


@include('layouts.admin.footer_new')



<script>

  document.addEventListener('DOMContentLoaded', function() {

    var copyButtons = document.querySelectorAll('.copy-btn');



    copyButtons.forEach(function(button) {

      button.addEventListener('click', function(event) {

        event.preventDefault(); // Prevent the default behavior of the link

        var url = button.getAttribute('href'); // Get the URL value



        // Create a temporary input element to copy the URL to the clipboard

        var tempInput = document.createElement('input');

        tempInput.value = url;

        document.body.appendChild(tempInput);

        tempInput.select();

        document.execCommand('copy');

        document.body.removeChild(tempInput);



        // Provide some feedback to the user (optional)

        alert('URL copied to clipboard: ' + url);

      });

    });

  });

</script>