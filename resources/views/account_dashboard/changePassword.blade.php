@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
              @include('account_dashboard.dashboardSidebar')


        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">
                    Change Password
                </div>

                <div class="card-body">

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

                    <form method="POST" action="{{ route('change.password') }}" id="reset-frm">
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

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
