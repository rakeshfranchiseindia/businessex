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
                    <input type="text" name="inv_headline" class="form-control"
                        value="{{ old('inv_headline', $invAdvRecord->inv_headline ?? '') }}"
                        placeholder="Enter Advertisement Headline" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Introduction</label>
                    <textarea name="inv_intro" class="form-control" rows="4"
                        placeholder="Enter introduction details here...">{{ old('inv_intro', $invAdvRecord->inv_intro ?? '') }}</textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        {{ $invAdvRecord ? 'Update' : 'Submit' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
