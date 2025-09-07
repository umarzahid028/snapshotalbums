@include('layouts.admin.header_new')

<div class="row align-items-center pb40">
            <div class="col-xxl-3">
              <div class="dashboard_title_area">
                <h2>Albums</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
            <div class="col-xxl-9">
              <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
             
            </div>
            </div>
          </div>
          <div class="container">
    <h2>Google Drive Files</h2>

    @if (!empty($images) && is_array($images))
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $image['name'] }}</h5>
                            <!-- You can add more information or actions here -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No image files found.</p>
    @endif
</div>
@include('layouts.admin.footer_new')