<!-- ========== NEWSLETTER SECTION ========== -->
  <section id="newslettersection" class="newsletter-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 newsletter-content mb-4 mb-lg-0">
          <h3>Get Industry First Insights</h3>
          <p>Sign up for our exclusive Newsletter</p>
        </div>
        
        <div class="col-lg-6">
          <!-- Success Message -->
          @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <form id="newsletterForm" name="newsletterForm" method="POST" action="{{ route('newsLetterSubscribe') }}" class="newsletter-form row">
            @csrf
            <div class="col-sm-6">
              <input name="newsletter_name" type="text" class="form-control" placeholder="Name">
              @error('newsletter_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-sm-6">
              <input name="newsletter_email" type="email" class="form-control" placeholder="Email">
              @error('newsletter_email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-sm-6 mt-3">
              <input name="newsletter_phone" type="tel" class="form-control" placeholder="Contact No.">
              @error('newsletter_phone')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-sm-6 mt-3">
              <input name="newsletter_city" type="text" class="form-control" placeholder="City">
              @error('newsletter_city')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-12 mt-3">
              <button type="submit" class="btn-subscribe">Subscribe Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  {{-- Scroll to newsletter section if session flag is set --}}
@if(session('scrollTo') === 'newslettersection')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const section = document.getElementById("newslettersection");
            if(section){
                section.scrollIntoView({ behavior: "smooth" });
            }
        });
    </script>
@endif