<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>@yield('title', 'Business for Sale & Investors in India - Business-Ex')</title>
   <!-- Favicons -->
   <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
   <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- Vendor CSS Files -->
   <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/user_style.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <!-- Template Main CSS File -->
   <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/article-style.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/article-detail.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/services.styles.css') }}" rel="stylesheet">
   @stack('styles')
</head>

<body>
   <!-- Navbar -->
   @include('partials.navbar')
   <!-- Main Content -->
   <main id="main">
      @yield('content')
   </main>
   <!-- Footer -->
   @include('partials.footer')
   <!-- Registration/Login Modal -->
   <!-- login -->
   <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">
               <div class="popimgleft">
                  <div class="textblk">
                     <div class="innertextblk">
                        <div class="loginblk" style="display:none;">
                           <div class="h2bg">Welcome Back!</div>
                           <p class="txt">To keep connected with us,
                              please login with your personal info</p>
                        </div>
                        <div class="regidterblk">
                           <div class="h2bg">Why should I register?</div>
                           <p class="txt">BusinessEx is a platform for everyone in the Business community to move ahead
                              on their expansion path. Register today to unveil the Business opportunity of your dreams!
                              Your basic information will only be used to create Login profile and will never be used
                              for any other purposes.</p>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="poptxtright">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Login">Login</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Register">Register</a>
                     </li>
                  </ul>
                  <!-- Tab strat her  -->
                  <div class="tab-content">
                     <div class="tab-pane container active" id="Login">
                        <div class="soc">
                           <div class="innsoc">
                              <a href="#"><img src={{ asset('assets/img/google.svg') }}></a>
                           </div>
                           <div class="innsoc">
                              <a href="#"><img src={{ asset('assets/img/fb.svg') }}></a>
                           </div>
                           <div class="innsoc">
                              <a href="#"><img src={{ asset('assets/img/linkedins.svg') }}></a>
                           </div>
                        </div>
                        <div class="emaishow">Or use your email account</div>

                        <form action="{{ route('login') }}" method="POST">
                           @csrf
                           <div class="frmblk">
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><img
                                          src={{ asset('assets/img/email-iconnew.svg') }}></span>
                                 </div>
                                 <input id="email" name="email" type="email" class="form-control"
                                    placeholder="Enter Your Email ID" aria-label="Username"
                                    aria-describedby="basic-addon1">
                                 @error('login_email')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>

                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><img
                                          src={{ asset('assets/img/lock-icon.svg') }}></span>
                                 </div>
                                 <input type="password" name="password" class="form-control"
                                    placeholder="Enter Your Password" aria-label="Username"
                                    aria-describedby="basic-addon1">
                                 @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                              </div>
                              <div class="ffull">
                                 <div class="pleft"><input type="checkbox"> Keep me Logged In</div>
                                 <div class="pright"><a href="{{ route('forgot.password') }}">Forgot Password?</a></div>
                              </div>
                              <input type="submit" value="Login" class="popbtn">
                           </div>
                        </form>
                     </div>
                     <div class="tab-pane container fade" id="Register">
                        <div class="soc">
                           <div class="innsoc">
                              <a href="#"><img src="{{ asset('assets/img/google.svg') }}"></a>
                           </div>
                           <div class="innsoc">
                              <a href="#"><img src="{{ asset('assets/img/fb.svg') }}"></a>
                           </div>
                           <div class="innsoc">
                              <a href="#"><img src="{{ asset('assets/img/linkedins.svg') }}"></a>
                           </div>
                        </div>
                        <div class="emaishow">Or use your email account</div>
                        <form>
                           <div class="frmblk">
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><img
                                          src="{{ asset('assets/img/email-iconnew.svg') }}"></span>
                                 </div>
                                 <input type="email" class="form-control" placeholder="Enter Your Email ID"
                                    aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><img
                                          src="{{ asset('assets/img/lock-icon.svg') }}"></span>
                                 </div>
                                 <input type="password" class="form-control" placeholder="Enter Your Password"
                                    aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                              <div class="input-group mb-4">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><img
                                          src="{{ asset('assets/img/lock-icon.svg') }}"></span>
                                 </div>
                                 <input type="password" class="form-control" placeholder="Enter Confirm Password"
                                    aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                              <div class="ffull">
                                 <div class="pleft"><input type="checkbox"> Subscribe for Daily Updates</div>
                              </div>
                              <input type="submit" value="Submit" class="popbtn">
                           </div>
                        </form>

                     </div>
                  </div>
                  <!-- tab end her  -->
               </div>
            </div>

         </div>
      </div>
   </div>
   <!-- Vendor JS Files -->
   <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/js/user_main.js') }}"></script>
   <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
   <!-- Add ScrollReveal -->
   <script src="https://unpkg.com/scrollreveal"></script>
   <!-- Your custom JS -->
   <script>
$(document).ready(function(){
    $('#clientssay').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:true,
        autoplay:true,
        autoplayTimeout:3000,
        responsive:{
            0:{ items:1 },
            600:{ items:2 },
            1000:{ items:3 }
        }
    });
});
</script>
   <script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    // Laravel auth check exposed to JS
    const isLoggedIn = @json(auth()->check());

    document.addEventListener("DOMContentLoaded", function() {
        // Get current URL path
        const path = window.location.pathname;

        // Profile registration URLs
        const profileUrls = [
            "/registration/create-startup-profile",
            "/registration/create-business-profile",
            "/registration/create-investor-profile",
            "/registration/create-mentor-profile"
        ];

        if (profileUrls.includes(path)) {
            // If not logged in, show login modal
            if (!isLoggedIn) {
                const loginModal = new bootstrap.Modal(document.getElementById('login'));
                loginModal.show();

                // Switch to Register tab
                const registerTab = document.querySelector('a[href="#Register"]');
                if (registerTab) {
                    const tab = new bootstrap.Tab(registerTab);
                    tab.show();
                }
            }
        }
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // When parent state checkbox is toggled
    document.querySelectorAll('.parent-location-filter').forEach(function (parentCheckbox) {
        parentCheckbox.addEventListener('change', function () {
            const parentGroup = this.dataset.parentGroup;
            const childCheckboxes = document.querySelectorAll('.child-location-filter[data-group="' + parentGroup + '"]');

            childCheckboxes.forEach(function (child) {
                child.checked = parentCheckbox.checked;
            });

            this.form.submit();
        });
    });

    // Keep parent in sync when children are toggled
    document.querySelectorAll('.child-location-filter').forEach(function (childCheckbox) {
        childCheckbox.addEventListener('change', function () {
            const group = this.dataset.group;
            const parentCheckbox = document.querySelector('.parent-location-filter[data-parent-group="' + group + '"]');
            if (!parentCheckbox) return;

            const siblings = document.querySelectorAll('.child-location-filter[data-group="' + group + '"]');
            const anyChecked = Array.from(siblings).some(cb => cb.checked);

            // Parent is checked if ANY child is checked
            parentCheckbox.checked = anyChecked;

            // Expand (show) the collapse when a child is checked
            if (anyChecked) {
                const collapseEl = document.querySelector('#' + group.replace('location-', 'collapseState-'));
                if (collapseEl) {
                    $(collapseEl).collapse('show'); // requires Bootstrap JS
                }
            }

            parentCheckbox.form && parentCheckbox.form.submit();
        });
    });
});
</script>
@stack('scripts')
</body>
</html>