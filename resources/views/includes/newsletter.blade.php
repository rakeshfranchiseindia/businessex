<!-- ========== NEWSLETTER SECTION ========== -->
  <section id="newslettersection" class="newsletter-section">
    <div class="container-fluid newsletter-inner">
      <div class="row align-items-start">
        <div class="col-lg-5 newsletter-content mb-4 mb-lg-0">
          <h3>Get Industry First Insights</h3>
          <p>Sign up for our exclusive Newsletter</p>
        </div>
        
        <div class="col-lg-7 newsletter-form-column">
          @if(!request()->routeIs(['register.create-investor-profile', 'register.create-lender-profile', 'register.create-startup-profile', 'register.create-business-profile', 'register.create-mentor-profile']))
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
          @endif
          <form id="newsletterForm" name="newsletterForm" method="POST" action="{{ route('newsLetterSubscribe') }}" class="newsletter-form row">
            @csrf
            <div class="col-sm-6">
              <input name="newsletter_name" type="text" class="form-control" placeholder="Name">
              @error('newsletter_name')
                <small class="text-danger d-block newsletter-error">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-sm-6">
              <input name="newsletter_email" type="email" class="form-control" placeholder="Email">
              @error('newsletter_email')
                <small class="text-danger d-block newsletter-error">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-sm-6 mt-3">
              <input name="newsletter_phone" type="tel" class="form-control" placeholder="Contact No.">
              @error('newsletter_phone')
                  <small class="text-danger d-block newsletter-error">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-sm-6 mt-3">
              <input name="newsletter_city" type="text" class="form-control" placeholder="City">
              @error('newsletter_city')
                <small class="text-danger d-block newsletter-error">{{ $message }}</small>
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

  <div class="newsletter-social-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-6 newsletter-follow">
          <span>Follow <strong>BusinessEx</strong></span>
          <div class="social-links-footer" aria-label="BusinessEx social media links">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div class="col-md-6 newsletter-stay-tuned">Stay tuned &amp; get updated</div>
      </div>
    </div>
  </div>
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