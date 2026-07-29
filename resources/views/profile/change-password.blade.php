<style>
    .bdr {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .cat-list {
        background: #1d4ed8;
        padding: 18px 25px;
    }

    .cat-sec-ttl {
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: .5px;
    }

    .msg-pnl {
        margin-top: 15px;
        padding: 10px 15px;
        border-radius: 5px;
        background: #dcfce7;
        color: #166534;
        font-size: 14px;
    }

    .text-danger {
        color: #dc2626 !important;
    }

    .margin-20 {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .control-label {
        font-weight: 600;
        color: #374151;
        padding-top: 10px;
    }

    .star {
        color: red;
    }

    .form-control {
        height: 42px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        padding: 8px 12px;
        font-size: 15px;
        transition: .3s;
    }

    .form-control:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    }

    .is-invalid {
        border-color: #dc2626;
    }

    small.text-danger {
        display: block;
        margin-top: 6px;
        font-size: 13px;
    }

    .submitfrm {
        text-align: center;
        padding-top: 10px;
    }

    .btn-blue {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 35px;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: .3s;
    }

    .btn-blue:hover {
        background: #1e40af;
    }


    @media(max-width:768px){

        .bdr {
            margin:20px;
        }

        .margin-20 {
            padding:20px;
        }

        .control-label {
            margin-bottom:8px;
        }

    }

</style>

<div class="bdr">

    <div class="cat-list">
        <div class="cat-sec-ttl">
            CHANGE PASSWORD
        </div>

        @if(session('success'))
            <div class="msg-pnl msg-change-pwd" style="top:0px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="msg-pnl msg-change-pwd text-danger" style="top:0px;">
                {{ session('error') }}
            </div>
        @endif
    </div>


    <div class="margin-20">

        <div class="row form-sec">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <form 
                    method="POST"
                    action="{{ route('change.password') }}"
                    id="reset-frm"
                    name="forgot"
                    class="form-horizontal"
                >

                    @csrf


                    <div class="sec-slide-effect">


                        <!-- Old Password -->
                        <div class="row form-group chng-pwd">

                            <label class="col-xs-12 col-sm-6 col-md-4 control-label">
                                Old Password
                                <span class="star">*</span>
                            </label>


                            <div class="col-xs-12 col-sm-6 col-md-7">

                                <input 
                                    type="password"
                                    name="old_password"
                                    placeholder="Old Password"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                >


                                @error('old_password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>




                        <!-- New Password -->
                        <div class="row form-group chng-pwd">

                            <label class="col-xs-12 col-sm-6 col-md-4 control-label">

                                New Password
                                <span class="star">*</span>
                            </label>


                            <div class="col-xs-12 col-sm-6 col-md-7">


                                <input 
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror"
                                >


                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror


                            </div>

                        </div>




                        <!-- Confirm Password -->
                        <div class="row form-group chng-pwd">


                            <label class="col-xs-12 col-sm-6 col-md-4 control-label">

                                Confirm Password
                                <span class="star">*</span>
                            </label>

                            <div class="col-xs-12 col-sm-6 col-md-7">


                                <input 
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Confirm Password"
                                    class="form-control"
                                >


                            </div>


                        </div>


                    </div>



                    <div class="sec-slide-effect txt-cen">

                        <div class="submitfrm">

                            <button 
                                type="submit" 
                                class="btn btn-default btn-blue"
                            >
                                SUBMIT
                            </button>

                        </div>

                    </div>


                </form>


            </div>

        </div>

    </div>

</div>