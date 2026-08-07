@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="headblk">The page you requested is not available</h1>
                <p>
                    Sorry, we are having a problem executing your request. It is possible your bookmark is old or you just hit a broken link. Please refer to updated links for information.
                    <br><br>
                    <a href="{{ url()->previous() }}">Go back</a> | Return to the <a href="{{ url('/') }}">homepage</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection