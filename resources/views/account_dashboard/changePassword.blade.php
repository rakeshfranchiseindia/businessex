@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
<style>
    .change-password-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 3px 15px rgba(0,0,0,0.06); border: 1px solid #eef1f6; }
    .change-password-card .card-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .change-password-card .form-control { min-height: 44px; border-radius: 7px; border: 1px solid #dcdfe3; }
    .change-password-card .form-control:focus { border-color: #1f4e79; box-shadow: 0 0 0 3px rgba(31,78,121,.10); }
    .btn-change-password { background: #1f4e79; color: #fff; border: none; border-radius: 7px; padding: 11px 30px; font-weight: 700; }
    .btn-change-password:hover { background: #163a5c; color: #fff; }
</style>
<div class="container-fluid py-4">
    <div class="row">
              @include('account_dashboard.dashboardSidebar')


        <div class="col-md-9 col-lg-8 dashboard-main-content">
            <div class="change-password-card">
                <h5 class="card-title">CHANGE PASSWORD</h5>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('update.password') }}" id="reset-frm">
                    @csrf

                    <!-- Old Password -->
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password <span class="text-danger">*</span></label>
                        <input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Enter old password">
                        @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter new password">
                    </div>

                    <button type="submit" class="btn-change-password">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
