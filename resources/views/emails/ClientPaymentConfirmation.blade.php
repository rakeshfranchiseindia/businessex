@extends('layouts.master')

@section('title')
Payment Confirmation Mail

@endsection

@section('body')

<tr>
    <td valign="top">
        <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#f8f8f8"  >
            <tr>
                <td valign="top" style="padding:40px 0px 33px 0px; font-size:17px; font-weight: normal; text-align:center; color:#333333;" align="left">
                    <font face="Arial, sans-serif">
                        <p><span style="width:150px; display:inline-block; text-align:left;">Order No :</span>{{$orderNo}} </p>
                        <p><span style="width:150px; display:inline-block; text-align:left;">Profile :</span>{{$profile}} </p>
                        <p><span style="width:150px; display:inline-block; text-align:left;">Name :</span>{{$name}} </p>
                        <p><span style="width:150px; display:inline-block; text-align:left;">Email :</span> {{$email}}</p>
                        <p><span style="width:150px; display:inline-block; text-align:left;">Mobile No: :</span> {{$mobile}}</p>
                        @if(!empty($city))<p><span style="width:150px; display:inline-block; text-align:left;">City: :</span> {{$city}}</p>@endif
                        @if(!empty($company))<p><span style="width:150px; display:inline-block; text-align:left;">Company: :</span> {{$company}}</p>@endif
                        <p><span style="width:150px; display:inline-block; text-align:left;">Amount: :</span> {{$amount}}</p>
                        <p><span style="width:150px; display:inline-block; text-align:left;">Product Details: :</span> {{$productDetails}}</p>
                    </font>
                </td>
            </tr>
        </table>
    </td>
</tr>

@endsection