@section('title', 'Contact')

@include("frontend.layouts.header")
  <!-- Signup Modal -->

  <div class="body_content">
  <br>
  <br>
  <br>
  <br>

    <!-- History -->
    <section>
      <div class="container">
        <div class="row align-items-md-center wow fadeInRight" data-wow-delay="300ms">
          
          <!-- <div class="col-md-4 col-lg-3 offset-lg-1 wow fadeInLeft" data-wow-delay="500ms">
            <div class="main-title2">
              <h2 class="title" style="color:#355691">Get in Touch</h2>
              </div>
          
          </div> -->
          <div class="col-md-8 col-lg-">
          <h4 class="form-title mb25" style="color:#355691">Have questions? Get in touch!</h4>
          @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          <form class="form-style1" action="{{route('contact.store')}}" method="post">
          @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="mb20">
                    <label class="heading-color ff-heading fw600 mb10" style="color:#355691">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
            </div>
            <!-- Add similar fields for Last Name, Email, and Message -->
            <div class="col-md-12">
                <div class="mb20">
                    <label class="heading-color ff-heading fw600 mb10" style="color:#355691">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb20">
                    <label class="heading-color ff-heading fw600 mb10" style="color:#355691">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb10">
                    <label class="heading-color ff-heading fw600 mb10" style="color:#355691">Your Message</label>
                    <textarea cols="30" rows="4" name="message" placeholder="Type your message here." required></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-grid">
                    <button type="submit" class="ud-btn btn-thm">Submit <i class="fal fa-arrow-right-long"></i></button>
                </div>
            </div>
          </div>
      </form>
          </div>
        </div>
      </div>
    </section>
          <br>
            <br>
          <br>


    <!-- Our Footer --> 
    @include("frontend.layouts.footer")