@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="container bex-main">
<div class="row">
<div class="col-12 col-sm-12 col-md-12">
<ul class="brunnar">
  <li><a href="#">About us</a></li>
<li>/</li>
<li>About us</li>  
 </ul> 
</div>
</div>

<div class="page-ttl"><h1>About us</h1></div>
<div class="container">
    <div class="row backbg">
        <div class="col-12">
            BusinessEx.com is a networking platform that helps you find solutions for your business problems with proper connections. 
            For more information, get connected with us by filling up the required information below.
        </div>

        <!-- Reach Us Section -->
        <div class="col-12 col-md-6">
            <h2 class="stati2chead">Reach Us</h2>
            <div class="inncblk">
                <div class="fst">
                    <div class="t1">Telephone</div>
                    <div class="t2">
                        <i class="fa fa-phone"></i>
                        <a href="tel:+91 8586891020">+91 8586891020</a> 
                        (Monday - Friday 10am to 6pm, IST)
                    </div>
                </div>
                <div class="fst">
                    <div class="t1">Email</div>
                    <div class="t2">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:support@businessex.com">support@businessex.com</a>
                    </div>
                </div>
                <div class="fst">
                    <div class="t1">Postal Mail</div>
                    <div class="t2">
                        <i class="fa fa-map-marker"></i>
                        Franchise India Holdings Limited, 4th-5th Floor, Charmwood Plaza, Surajkund Road, Faridabad - 121009, Haryana
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="col-12 col-md-6 contbg">
            <h2 class="stati2chead marsetb">Send Us Your Questions and Feedback</h2>
            <form method="POST" action="" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Your Name<span class="text-danger">*</span>:</label>
                    <div class="col-md-7">
                        <input type="text" name="contact_name" class="form-control" placeholder="Enter Your Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Email Address<span class="text-danger">*</span>:</label>
                    <div class="col-md-7">
                        <input type="email" name="contact_email" class="form-control" placeholder="Enter Your Email ID" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Mobile Number<span class="text-danger">*</span>:</label>
                    <div class="col-md-7">
                        <input type="text" name="contact_mobile" class="form-control" placeholder="Enter Your Mobile Number" pattern="[56789][0-9]{9}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Comments<span class="text-danger">*</span>:</label>
                    <div class="col-md-7">
                        <textarea name="contact_comment" class="form-control" rows="3" minlength="15" maxlength="150" placeholder="Enter Your Message" required></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-7 offset-md-4">
                        <div class="form-check">
                            <input type="checkbox" name="subscribe" class="form-check-input">
                            <label class="form-check-label">Subscribe for latest news</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-7 offset-md-4">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

                <div class="termstxt">
                    By Clicking Submit you are Accepting <a href="/terms">Terms &amp; Conditions</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection