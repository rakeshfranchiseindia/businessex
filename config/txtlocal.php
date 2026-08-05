<?php
/**
 * Created by PhpStorm.
 * User: vasanthmuthusamy
 * Date: 07-08-2017
 * Time: 13:25
 */
return [
    /*
    |--------------------------------------------------------------------------
    |  Merchant Key
    |--------------------------------------------------------------------------
    */
    'apiKey' => 'cfe63cea013d9f531a8db8f7106766e5ad9dff82a82a4fdeb8e6fb65de274f1e',

    /*
    |--------------------------------------------------------------------------
    | TextLocal API Url
    |--------------------------------------------------------------------------
    */
    'apiUrl' => 'https://api.textlocal.in/send/?',

    /*
    |--------------------------------------------------------------------------
    | TextLocal API Url
    |--------------------------------------------------------------------------
    */
    'sender' => 'FranIn',

    /*
    |--------------------------------------------------------------------------
    | TextLocal API Url
    |--------------------------------------------------------------------------
    */
    'username' => 'tech@businessex.com',
 
    /*
    |--------------------------------------------------------------------------
    | OTP SMS Template
    |--------------------------------------------------------------------------
    */
    'SmsMsgInstaOld'    => 'Hi, You have got a proposal from %s for your %s Profile. %s Regards, Team BusinessEx.com',
    'SmsMsgInsta'    => "Hi,\nYou have received a proposal from %s for your %s Profile.\nView Proposal: https://bit.ly/2L4woxC\nBEx Team",

    /*
    |--------------------------------------------------------------------------
    | Insta apply Template
    |--------------------------------------------------------------------------
    */
    'SmsMsg'    => 'Dear %s, Your BusinessEx.com verification code is %s'
    

];
