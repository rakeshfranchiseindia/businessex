@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
<style>
    .profile-edit-card { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 3px 15px rgba(0,0,0,0.06); border: 1px solid #eef1f6; }
    .profile-edit-card .card-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .profile-edit-card .form-label { font-weight: 600; color: #333; }
    .profile-edit-card .form-control { min-height: 44px; border-radius: 7px; border: 1px solid #dcdfe3; }
    .profile-edit-card .form-control:focus { border-color: #1f4e79; box-shadow: 0 0 0 3px rgba(31,78,121,.10); }
    .profile-edit-card .form-control.is-invalid { border-color: #dc3545; }
    .btn-profile-save { background: #1f4e79; color: #fff; border: none; border-radius: 7px; padding: 11px 30px; font-weight: 700; }
    .btn-profile-save:hover { background: #163a5c; color: #fff; }
</style>
<div class="container-fluid py-4">
    <div class="row">
        @include('account_dashboard.dashboardSidebar')

        <div class="col-md-9 col-lg-8 dashboard-main-content">
            <div class="profile-edit-card">
                <h5 class="card-title">EDIT PROFILE</h5>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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

                <form action="{{ route('user.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mobile <span class="text-danger">*</span></label>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                               value="{{ old('mobile', $user->mobile) }}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                               value="{{ old('location', $user->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"
                               value="{{ old('designation', $user->designation) }}" required>
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                               value="{{ old('company_name', $user->company_name) }}" required>
                        @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-profile-save">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
