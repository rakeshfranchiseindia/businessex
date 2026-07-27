@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container bex-main">
    <div class="row">
        <div class="col-12">
            <ul class="brunnar">
                <li><a href="#">About Us</a></li>
                <li>/</li>
                <li>About Us</li>
            </ul>
        </div>
    </div>

    <div class="page-ttl">
        <h1>About Us</h1>
    </div>

    <!-- Intro Section -->
    <div class="row">
        <div class="col-12 col-md-7">
            <strong>Business Exchange is a flagship business initiative of Franchise India, headquartered at Faridabad, Haryana.</strong>
            <br><br>
            BusinessEx is thoughtfully conceived and created to address selling and exchanging of businesses across industry verticals...
            <br><br>
            Businessex.com is emerging as the fastest growing marketplace for business consultation services...
        </div>

        <div class="col-12 col-md-5">
            <div class="viright">
                <iframe class="respo" width="420" height="300"
                        src="https://www.youtube.com/embed/wY4DidbzUek?loop=1;&amp;playlist=wY4DidbzUek">
                </iframe>
            </div>
        </div>
    </div>

    <div class="clr"></div>

    <!-- Mission & Vision -->
    <div class="row setbttop">
        <div class="col-12 col-md-5 modf">
            <h4 class="mhvt">Mission & Vision</h4>
            <p class="tybys">
                To provide the best online platform to connect the Businesses & Start-ups with the Investors, Lenders, Mentors and Incubator companies.
                <span>To be a single stop Business Exchange platform for the Businesses for all the business support systems & business requirements</span>
            </p>
        </div>
        <div class="col-12 col-md-7 modf">
            <div class="imgabt">
                <img src="{{ asset('assets/img/mission.png') }}" alt="Mission">
            </div>
        </div>
    </div>

    <div class="clr"></div>

    <!-- How It Works -->
    <div class="row">
        <div class="col-12">
            <h4 class="mhvt">How It Works?</h4>
            <ul class="ncn">
                <li>
                    <img src="{{ asset('assets/img/img_1.jpg') }}" alt="Register">
                    <div class="shotxt">
                        <span>Register</span>
                        Create a profile to become a member of BusinessEx.com...
                    </div>
                </li>
                <li>
                    <img src="{{ asset('assets/img/img_2.jpg') }}" alt="Create Profile">
                    <div class="shotxt">
                        <span>Create Profile</span>
                        Create a profile to become a member of BusinessEx.com...
                    </div>
                </li>
                <li>
                    <img src="{{ asset('assets/img/img_3.jpg') }}" alt="Review">
                    <div class="shotxt">
                        <span>Review</span>
                        Sit back while our team reviews your submission...
                    </div>
                </li>
                <li>
                    <img src="{{ asset('assets/img/img_4.jpg') }}" alt="Publish">
                    <div class="shotxt">
                        <span>Publish</span>
                        Visit the marketplace and send/receive top structured deals...
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Consumer Problem & Solution -->
    <div class="row">
        <div class="col-12">
            <div class="divncnbtm">
                <div class="divncnbtminner">
                    <h4 class="mhvt mdfy">Consumer Problem</h4>
                    <ul class="listnav">
                        <li>You will be asked to submit your details</li>
                        <li>You will be asked to submit your details</li>
                        <li>You will be asked to submit your details</li>
                        <li>You will be asked to submit your details</li>
                    </ul>
                </div>
                <div class="divncnbtminner">
                    <h4 class="mhvt mdfy">Business-ex Solution</h4>
                    <ul class="listnav">
                        <li>You will be asked to submit your details</li>
                        <li>You will be asked to submit your details</li>
                        <li>You will be asked to submit your details</li>
                        <li>You will be asked to submit your details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection