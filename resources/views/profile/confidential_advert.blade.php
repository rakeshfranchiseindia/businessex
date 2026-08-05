@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Manage Advertisement Information</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('advertisement.save', $user->user_rand_id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Advertisement Headline*</label>
                    <input type="text" name="headline" class="form-control" placeholder="Enter Advertisement Headline" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Introduction</label>
                    <textarea name="introduction" class="form-control" rows="4" placeholder="Enter introduction details here..."></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
