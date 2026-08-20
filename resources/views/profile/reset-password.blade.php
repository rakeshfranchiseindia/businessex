@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<style>
    .auth-wrap { padding-top: 130px; padding-bottom: 60px; min-height: 70vh; }
    .auth-card { background: #fff; border-radius: 12px; box-shadow: 0 8px 30px rgba(30,41,59,0.08); border: 1px solid #eef1f6; padding: 40px; }
    .auth-card h3 { color: #1f4e79; font-weight: 700; }
    .auth-card .form-control { min-height: 44px; border-radius: 7px; border: 1px solid #dcdfe3; }
    .auth-card .form-control:focus { border-color: #1f4e79; box-shadow: 0 0 0 3px rgba(31,78,121,.10); }
    .btn-auth { background: #1f4e79; color: #fff; border: none; border-radius: 7px; padding: 12px; font-weight: 700; width: 100%; }
    .btn-auth:hover { background: #163a5c; color: #fff; }
</style>
<div class="container auth-wrap">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="auth-card">
                <h3 class="text-center mb-3">Reset Password</h3>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reset.password.submit') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter New Password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn-auth">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
