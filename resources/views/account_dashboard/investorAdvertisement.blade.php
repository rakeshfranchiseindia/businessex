@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')

<div class="row">

        @include('account_dashboard.dashboardSidebar')


    <div class="col-md-9">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white fw-bold">
                MANAGE CONFIDENTIAL INFORMATION
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

                <form action="{{ route('advertisement.save', $user->user_rand_id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="inv_headline" class="form-label">
                            Advertisement Headline
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="inv_headline"
                            name="inv_headline"
                            class="form-control @error('inv_headline') is-invalid @enderror"
                            value="{{ old('inv_headline', $invAdvRecord->inv_headline ?? '') }}"
                            placeholder="Enter Advertisement Headline"
                            required
                        >

                        @error('inv_headline')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inv_intro" class="form-label">
                            Introduction
                        </label>

                        <textarea
                            id="inv_intro"
                            name="inv_intro"
                            class="form-control @error('inv_intro') is-invalid @enderror"
                            rows="5"
                            placeholder="Enter introduction details here..."
                        >{{ old('inv_intro', $invAdvRecord->inv_intro ?? '') }}</textarea>

                        @error('inv_intro')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4">
                            Submit
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection