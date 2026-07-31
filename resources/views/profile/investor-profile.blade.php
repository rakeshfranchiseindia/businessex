@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
body{
    background:#f3f3f3;
    font-family:Arial, Helvetica, sans-serif;
}

.sidebar,
.profile-card{
    background:#fff;
    border:1px solid #ddd;
}

.sidebar{
    padding-bottom:20px;
}

.profile-image{
    width:110px;
    height:110px;
    border-radius:50%;
    background:#e5e5e5;
    margin:auto;
    display:block;
    object-fit:cover;
}

.sidebar-top{
    text-align:center;
    padding:25px 15px;
    border-bottom:1px solid #eee;
}

.sidebar-top h4{
    margin-top:10px;
    font-weight:bold;
}

.location{
    color:#0d6efd;
    font-size:14px;
}

.sidebar-info{
    padding:20px;
    font-size:15px;
}

.sidebar-info p{
    margin-bottom:8px;
}

.plan-btn{
    width:100%;
    background:#18a689;
    color:#fff;
    border:none;
    padding:12px;
    font-weight:bold;
}

.plan-btn:hover{
    background:#13856d;
}

.profile-title{
    padding:18px 25px;
    font-size:28px;
    font-weight:bold;
    color:#444;
    border-bottom:1px solid #eee;
}

.profile-body{
    padding:35px;
}

.big-image{
    width:100%;
    height:340px;
    background:#efefef;
    border:1px solid #ddd;
    display:flex;
    justify-content:center;
    align-items:center;
}

.big-image i{
    font-size:120px;
    color:#bdbdbd;
}

.name{
    font-size:34px;
    font-weight:bold;
}

.right-location{
    float:right;
    color:#666;
}

.label{
    margin-top:15px;
    color:#555;
    font-weight:bold;
}

.value{
    color:#222;
    font-size:18px;
}

select{
    margin-bottom:15px;
}
</style>
<div class="container py-5">

    <div class="row">

        <!-- Sidebar -->

        <!-- <div class="col-md-3">

            <div class="sidebar">

                <div class="sidebar-top">

                    <img src="https://via.placeholder.com/110" class="profile-image">

                    <div class="location">
                        <i class="fa-solid fa-location-dot"></i> North Delhi
                    </div>

                    <h4>Billiehi...</h4>

                </div>

                <div class="sidebar-info">

                    <p>
                        <i class="fa-regular fa-envelope"></i>
                        techsupport@franchiseindia.com
                    </p>

                    <p>
                        <i class="fa-solid fa-phone"></i>
                        9899811050
                    </p>

                    <hr>

                    <label><strong>PROFILE</strong></label>

                    <select class="form-select">
                        <option>Investor</option>
                    </select>

                    <button class="plan-btn">
                        MY PLAN
                    </button>

                </div>

            </div>

        </div> -->

        <!-- Right Section -->

        <div class="col-md-9">

            <div class="profile-card">

                <div class="profile-title">
                    INVESTOR PROFILE
                </div>

                <div class="profile-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="big-image">
                                <i class="fa-solid fa-user"></i>
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="right-location">
                                <i class="fa-solid fa-location-dot"></i>
                               {{ $user->location ?? 'Location Not Set' }}
                            </div>

                            <div class="name">
                                {{ $user->name ?? 'N/A' }}
                            </div>

                            <div class="label">MOBILE</div>
                            <div class="value">{{ $user->mobile ?? 'Not Provided' }}</div>

                            <div class="label">EMAIL</div>
                            <div class="value">{{ $user->email ?? 'Not Provided' }}</div>

                            <div class="label">Investor Type</div>
                            <div class="value">Individual Investor</div>
                            
                            <div class="label">Company Name</div>
                            <div class="value">
                                {{ $user->company_name ?? 'Not Set' }}
                            </div>

                            <div class="label">Company Sector</div>
                            <div class="value">Information Technology</div>

                            <div class="label">Company Summary</div>
                            <div class="value">
                                Investing in startup businesses with scalable models.
                            </div>

                            <div class="label">Professional Summary</div>
                            <div class="value">
                                10+ years of experience in investment and finance.
                            </div>

                            <div class="label">Investment Size</div>
                            <div class="value">
                                ₹10,00,000 - ₹50,00,000
                            </div>

                            <div class="label">Investment Stake Preference</div>
                            <div class="value">
                                20%
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection