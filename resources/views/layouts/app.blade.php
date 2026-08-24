<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Business for Sale & Investors in India - Business-Ex')</title>

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/user_style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/article-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/article-detail.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/services.styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

    <script>window.BX_IS_LOGGED_IN = @json(auth()->check());</script>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main id="main">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')


    <!-- ========================================================= -->
    <!-- LOGIN / REGISTER MODAL -->
    <!-- ========================================================= -->

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
                                <div class="loginblk">
                                    <div class="h2bg">Welcome Back!</div>
                                    <p class="txt">To keep connected with us, please login with your personal info.</p>
                                </div>
                                <div class="regidterblk">
                                    <div class="h2bg">Why should I register?</div>
                                    <p class="txt">BusinessEx is a platform for everyone in the Business community to move ahead on their expansion path. Register today to unveil the Business opportunity of your dreams! Your basic information will only be used to create Login profile and will never be used for any other purposes.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="poptxtright">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="login-tab" data-toggle="tab" href="#Login" role="tab" aria-controls="Login" aria-selected="true">Login</a></li>
                            <li class="nav-item"><a class="nav-link" id="register-tab" data-toggle="tab" href="#Register" role="tab" aria-controls="Register" aria-selected="false">Register</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="login-tab">
                                @if(session('social_login_error'))
                                    <div class="alert alert-danger">{{ session('social_login_error') }}</div>
                                @endif
                                <div class="soc">
                                    <div class="innsoc"><a href="{{ route('social.redirect', ['provider' => 'google']) }}" aria-label="Login with Google"><img src="{{ asset('assets/img/google.svg') }}" alt="Google"></a></div>
                                    <div class="innsoc"><a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" aria-label="Login with Facebook"><img src="{{ asset('assets/img/fb.svg') }}" alt="Facebook"></a></div>
                                    <div class="innsoc"><a href="{{ route('social.redirect', ['provider' => 'linkedin']) }}" aria-label="Login with LinkedIn"><img src="{{ asset('assets/img/linkedins.svg') }}" alt="LinkedIn"></a></div>
                                </div>
                                <div class="emaishow">Or use your email account</div>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="frmblk">
                                        <div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text"><img src="{{ asset('assets/img/email-iconnew.svg') }}" alt="Email"></span></div><input id="login_email" name="email" type="email" class="form-control @error('login_email') is-invalid @enderror" placeholder="Enter Your Email ID" value="{{ old('email') }}" autocomplete="email" required></div>
                                        @error('login_email')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                        <div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text"><img src="{{ asset('assets/img/lock-icon.svg') }}" alt="Password"></span></div><input id="login_password" type="password" name="password" class="form-control @error('login_password') is-invalid @enderror" placeholder="Enter Your Password" autocomplete="current-password" required></div>
                                        @error('login_password')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                        <div class="ffull"><div class="pleft"><label><input type="checkbox" name="remember" value="1"> Keep me Logged In</label></div><div class="pright"><a href="{{ route('forgot.password') }}">Forgot Password?</a></div></div>
                                        <input type="submit" value="Login" class="popbtn">
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="Register" role="tabpanel" aria-labelledby="register-tab">
                                <div class="soc">
                                    <div class="innsoc"><a href="{{ route('social.redirect', ['provider' => 'google']) }}" aria-label="Register with Google"><img src="{{ asset('assets/img/google.svg') }}" alt="Google"></a></div>
                                    <div class="innsoc"><a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" aria-label="Register with Facebook"><img src="{{ asset('assets/img/fb.svg') }}" alt="Facebook"></a></div>
                                    <div class="innsoc"><a href="{{ route('social.redirect', ['provider' => 'linkedin']) }}" aria-label="Register with LinkedIn"><img src="{{ asset('assets/img/linkedins.svg') }}" alt="LinkedIn"></a></div>
                                </div>
                                <div class="emaishow">Or use your email account</div>
                                <form action="{{ route('user.register') }}" method="POST">
                                    @csrf
                                    @if(session('user_registration_email_error'))
                                        <div class="text-danger mb-3">{{ session('user_registration_email_error') }}</div>
                                    @endif
                                    @if(session('user_registration_success'))
                                        <div class="alert alert-success">{{ session('user_registration_success') }}</div>
                                    @endif
                                    @if($errors->userRegister->any())
                                        <div class="alert alert-danger">Please correct the highlighted fields.</div>
                                    @endif
                                    <div class="frmblk">
                                        <div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text"><img src="{{ asset('assets/img/email-iconnew.svg') }}" alt="Email"></span></div><input id="register_email" type="email" name="email" class="form-control @error('email', 'userRegister') is-invalid @enderror" placeholder="Enter Your Email ID" value="{{ old('email') }}" autocomplete="email" required></div>
                                        @error('email', 'userRegister')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                        <div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text"><img src="{{ asset('assets/img/lock-icon.svg') }}" alt="Password"></span></div><input id="register_password" type="password" name="password" class="form-control @error('password', 'userRegister') is-invalid @enderror" placeholder="Enter Your Password" autocomplete="new-password" required></div>
                                        @error('password', 'userRegister')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                        <div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text"><img src="{{ asset('assets/img/lock-icon.svg') }}" alt="Confirm Password"></span></div><input id="register_password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation', 'userRegister') is-invalid @enderror" placeholder="Enter Your Password Again" autocomplete="new-password" required></div>
                                        @error('password_confirmation', 'userRegister')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                        <div class="ffull"><div class="pleft"><label><input type="checkbox" name="subscribe" value="1"> Subscribe for Daily Updates</label></div></div>
                                        <input type="submit" value="Submit" class="popbtn">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ========================================================= -->

    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- User JS -->
    <script src="{{ asset('assets/js/user_main.js') }}"></script>

    <!-- ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <!-- ========================================================= -->
    <!-- OWL CAROUSEL -->
    <!-- ========================================================= -->

    <script>
        $(document).ready(function () {

            const $clientsSay = $('#clientssay');

            if ($clientsSay.length && typeof $.fn.owlCarousel === 'function') {

                $clientsSay.owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 3000,

                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        }
                    }
                });

            }

        });
    </script>


    <!-- ========================================================= -->
    <!-- LOGIN MODAL / PROFILE URL CHECK -->
    <!-- ========================================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const isLoggedIn = @json(auth()->check());
            const loginFailed = @json(session('login_failed', false));
            const userRegistrationFailed = @json(session('user_registration_failed', false));

            if (loginFailed && !isLoggedIn) {
                $('#login').modal('show');
                $('#login-tab').tab('show');
                return;
            }

            if (userRegistrationFailed && !isLoggedIn) {
                $('#login').modal('show');
                $('#register-tab').tab('show');
                return;
            }

            const currentPath = window.location.pathname.replace(/\/$/, '');

            const profileUrls = [
                '/registration/create-startup-profile',
                '/registration/create-business-profile',
                '/registration/create-investor-profile',
                '/registration/create-mentor-profile'
            ];

            if (!profileUrls.includes(currentPath)) {
                return;
            }

            if (isLoggedIn) {
                return;
            }

            // Bootstrap 4
            $('#login').modal('show');

            // Open Register tab
            $('#register-tab').tab('show');

        });
    </script>


    <!-- ========================================================= -->
    <!-- LOCATION FILTER -->
    <!-- ========================================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
             * Parent checkbox
             */
            document
                .querySelectorAll('.parent-location-filter')
                .forEach(function (parentCheckbox) {

                    parentCheckbox.addEventListener('change', function () {

                        const parentGroup = this.dataset.parentGroup;

                        const childCheckboxes = document.querySelectorAll(
                            '.child-location-filter[data-group="' +
                            parentGroup +
                            '"]'
                        );

                        childCheckboxes.forEach(function (child) {
                            child.checked = parentCheckbox.checked;
                        });

                        if (this.form) {
                            this.form.submit();
                        }

                    });

                });


            /*
             * Child checkbox
             */
            document
                .querySelectorAll('.child-location-filter')
                .forEach(function (childCheckbox) {

                    childCheckbox.addEventListener('change', function () {

                        const group = this.dataset.group;

                        const parentCheckbox = document.querySelector(
                            '.parent-location-filter[data-parent-group="' +
                            group +
                            '"]'
                        );

                        if (!parentCheckbox) {
                            return;
                        }

                        const siblings = document.querySelectorAll(
                            '.child-location-filter[data-group="' +
                            group +
                            '"]'
                        );

                        const anyChecked = Array
                            .from(siblings)
                            .some(function (checkbox) {
                                return checkbox.checked;
                            });

                        parentCheckbox.checked = anyChecked;


                        /*
                         * Expand collapse section
                         */
                        if (anyChecked) {

                            const collapseId =
                                group.replace(
                                    'location-',
                                    'collapseState-'
                                );

                            const collapseElement =
                                document.getElementById(collapseId);

                            if (collapseElement) {
                                $(collapseElement).collapse('show');
                            }

                        }


                        /*
                         * Submit form
                         */
                        if (parentCheckbox.form) {
                            parentCheckbox.form.submit();
                        }

                    });

                });

        });
    </script>


    <!-- ========================================================= -->
    <!-- NEWSLETTER AJAX -->
    <!-- ========================================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('newsletterForm');

            if (!form) {
                return;
            }

            if (form.dataset.newsletterBound === 'true') {
                return;
            }

            form.dataset.newsletterBound = 'true';


            form.addEventListener('submit', function (e) {

                e.preventDefault();


                /*
                 * Remove previous validation messages
                 */
                form.querySelectorAll('.newsletter-error')
                    .forEach(function (element) {
                        element.remove();
                    });

                /*
                 * Remove previous alerts
                 */
                document
                    .querySelectorAll('.newsletter-alert')
                    .forEach(function (element) {
                        element.remove();
                    });


                const formData = new FormData(form);

                const csrfTokenElement =
                    document.querySelector('meta[name="csrf-token"]');

                const csrfToken =
                    csrfTokenElement
                        ? csrfTokenElement.getAttribute('content')
                        : '';


                    fetch(form.action, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': csrfToken,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
    },
    body: formData
})
.then(async response => {
    const data = await response.json().catch(() => null);

    // Return both status and data
    return { status: response.status, data };
})
.then(({ status, data }) => {
    // Validation errors (422)
    if (status === 422 && data.errors) {
        Object.keys(data.errors).forEach(function (key) {
            const input = form.querySelector('[name="' + key + '"]');
            if (!input) return;

                input.parentElement
                    .querySelectorAll('.newsletter-error')
                    .forEach(function (element) {
                        element.remove();
                    });

            const errorElement = document.createElement('small');
            errorElement.className = 'text-danger d-block newsletter-error';
            errorElement.innerText = data.errors[key][0];

            input.insertAdjacentElement('afterend', errorElement);
        });
        return;
    }

    // Success
    if (status === 200 && data.success) {
        const successElement = document.createElement('div');
        successElement.className = 'alert alert-success newsletter-alert mt-3';
        successElement.innerText = data.success;
        form.insertAdjacentElement('beforebegin', successElement);
        form.reset();
        return;
    }

    // Other server-side error
    if (data.error) {
        const errorElement = document.createElement('div');
        errorElement.className = 'alert alert-danger newsletter-alert mt-3';
        errorElement.innerText = data.error;
        form.insertAdjacentElement('beforebegin', errorElement);
    }
})
.catch(error => {
    console.error('Newsletter AJAX error:', error);
    const errorElement = document.createElement('div');
    errorElement.className = 'alert alert-danger newsletter-alert mt-3';
    errorElement.innerText = 'Something went wrong. Please try again.';
    form.insertAdjacentElement('beforebegin', errorElement);
});


            });

        });
    </script>


    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')

</body>

</html>