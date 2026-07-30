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

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
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
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Close Button -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body">
                <div class="popimgleft">
                    <div class="textblk">
                        <div class="innertextblk">
                            <!-- Login Info Block -->
                            <div class="loginblk" style="display:none;">
                                <div class="h2bg">Welcome Back!</div>
                                <p class="txt">To keep connected with us, please login with your personal info</p>
                            </div>

                            <!-- Register Info Block -->
                            <div class="regidterblk">
                                <div class="h2bg">Why should I register?</div>
                                <p class="txt">
                                    BusinessEx is a platform for everyone in the Business community to move ahead on their expansion path.
                                    Register today to unveil the Business opportunity of your dreams! Your basic information will only be used
                                    to create a Login profile and will never be used for any other purposes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="poptxtright">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Register">Register</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Login Tab -->
                        <div class="tab-pane container active" id="Login">
                            <div class="soc">
                                <div class="innsoc"><a href="#"><img src="./assets/img/google.svg" alt="Google"></a></div>
                                <div class="innsoc"><a href="#"><img src="./assets/img/fb.svg" alt="Facebook"></a></div>
                                <div class="innsoc"><a href="#"><img src="./assets/img/linkedins.svg" alt="LinkedIn"></a></div>
                            </div>
                            <div class="emaishow">Or use your email account</div>
                            @error('login_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <form id="login-form" name="login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                                <div class="frmblk">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="./assets/img/email-iconnew.svg" alt="Email"></span>
                                        </div>
                                        <input name="email" type="email" class="form-control" placeholder="Enter Your Email ID" required>
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="./assets/img/lock-icon.svg" alt="Password"></span>
                                        </div>
                                        <input name="password" type="password" class="form-control" placeholder="Enter Your Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    <div class="ffull">
                                        <div class="pleft"><input type="checkbox"> Keep me Logged In</div>
                                        <div class="pright"><a href="#">Forgot Password?</a></div>
                                    </div>

                                    <input type="submit" value="Login" class="popbtn">
                                </div>
                            </form>
                        </div>

                        <!-- Register Tab -->
                        <div class="tab-pane container fade" id="Register">
                            <div class="soc">
                                <div class="innsoc"><a href="#"><img src="./assets/img/google.svg" alt="Google"></a></div>
                                <div class="innsoc"><a href="#"><img src="./assets/img/fb.svg" alt="Facebook"></a></div>
                                <div class="innsoc"><a href="#"><img src="./assets/img/linkedins.svg" alt="LinkedIn"></a></div>
                            </div>
                            <div class="emaishow">Or use your email account</div>

                            <form id="registration-form" name="registration-form" method="POST" action="">
                                <div class="frmblk">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="./assets/img/email-iconnew.svg" alt="Email"></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Enter Your Email ID" required>
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="./assets/img/lock-icon.svg" alt="Password"></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Enter Your Password" required>
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="./assets/img/lock-icon.svg" alt="Confirm Password"></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Enter Confirm Password" required>
                                    </div>

                                    <div class="ffull">
                                        <div class="pleft"><input type="checkbox"> Subscribe for Daily Updates</div>
                                    </div>

                                    <input type="submit" value="Submit" class="popbtn">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
        </div>
    </div>
  </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- Add ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Your custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#login').modal('show');
                $('#login .nav-link[href="#Login"]').tab('show');
            });
        </script>
    @endif

</body>
</html>