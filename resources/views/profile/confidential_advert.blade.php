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

            {{-- Agar record hai to update form --}}
            @if($invAdvRecord)
                <form action="{{ route('advertisement.save', $invAdvRecord->inv_profile_str) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- RESTful update --}}
                    <div class="mb-3">
                        <label class="form-label">Advertisement Headline*</label>
                        <input type="text" name="inv_headline" class="form-control"
                            value="{{ old('inv_headline', $invAdvRecord->inv_headline) }}"
                            placeholder="Enter Advertisement Headline" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Introduction</label>
                        <textarea name="inv_intro" class="form-control" rows="4"
                            placeholder="Enter introduction details here...">{{ old('inv_intro', $invAdvRecord->inv_intro) }}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Update</button>
                    </div>
                </form>
            @else
                {{-- Agar record nahi hai to new create form --}}
                <form action="{{ route('advertisement.save', 'new') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Advertisement Headline*</label>
                        <input type="text" name="inv_headline" class="form-control"
                            value="{{ old('inv_headline') }}"
                            placeholder="Enter Advertisement Headline" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Introduction</label>
                        <textarea name="inv_intro" class="form-control" rows="4"
                            placeholder="Enter introduction details here...">{{ old('inv_intro') }}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Submit</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
