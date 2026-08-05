@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Manage Confidential Information</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('confidential.update', $user->user_rand_id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Your Name*</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mobile Number*</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email ID*</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location*</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $user->location) }}" placeholder="Enter your city, state" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
