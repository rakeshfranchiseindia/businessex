@extends('account_dashboard.accountDashboardApp')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
@include('account_dashboard.dashboardSidebar')
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Profile</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('user.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Name*</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email*</label>
                            <input type="email" name="email" class="form-control" 
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mobile*</label>
                            <input type="text" name="mobile" class="form-control" 
                                   value="{{ old('mobile', $user->mobile) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location*</label>
                            <input type="text" name="location" class="form-control" 
                                   value="{{ old('location', $user->location) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Designation*</label>
                            <input type="text" name="designation" class="form-control" 
                                   value="{{ old('designation', $user->designation) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company*</label>
                            <input type="text" name="company_name" class="form-control" 
                                   value="{{ old('company_name', $user->company_name) }}" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
