<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">
                            Reset Password
                        </h3>
                        <form method="POST" action="{{ route('reset.password.submit') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label>
                                    New Password
                                </label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter New Password" required>
                            </div>
                            <div class="mb-3">
                                <label>
                                    Confirm Password
                                </label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm Password" required>
                            </div>
                            <button class="btn btn-success w-100">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>