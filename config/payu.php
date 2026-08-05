<?php
/**
 * Created by PhpStorm.
 * User: vasanthmuthusamy
 * Date: 22-05-2017
 * Time: 19:42
 */
return [

    /*
    |--------------------------------------------------------------------------
    | PayU Merchant Key
    |--------------------------------------------------------------------------
    */

    //'merchantKey' => 'gtKFFx',  //Staging
    'merchantKey' => 'zXwKxK',

    /*
    |--------------------------------------------------------------------------
    | PayU Salt
    |--------------------------------------------------------------------------
    */
    
    //'salt' => 'eCwWELxi',   staging
    'salt' => '0LBCTaus',

    /*
    |--------------------------------------------------------------------------
    | PayU Default Success Url
    |--------------------------------------------------------------------------
    */
    'surl' => 'http://bxapi.businessex.com/bexapi/verifypayment',
    'surlService' => 'http://bxapi.businessex.com/bexapi/verifyservicepayment',

    /*
    |--------------------------------------------------------------------------
    | PayU Default Failure Url
    |--------------------------------------------------------------------------
    */
    'furl' => 'http://bxapi.businessex.com/bexapi/paymentfailed',
    'furlService' => 'http://bxapi.businessex.com/bexapi/failedservicepayment',

    /*
    |--------------------------------------------------------------------------
    | PayU Default Cancel Url
    |--------------------------------------------------------------------------
    */
    'curl' => 'http://bxapi.businessex.com/bexapi/paymentcancelled',
    'curlService' => 'http://bxapi.businessex.com/bexapi/cancelledservicepayment',

    /*
    |--------------------------------------------------------------------------
    | PayU Default Base Url
    |--------------------------------------------------------------------------
    */
    //'baseUrl' => 'https://test.payu.in',
    'baseUrl' => 'https://secure.payu.in/_payment',

    /*
    |--------------------------------------------------------------------------
    | PayU Hash Sequence Pattern
    |--------------------------------------------------------------------------
    */
    'hashSeq' => '%s|%s|%s|%s|%s|%s|||||||||||%s',

    /*
    |--------------------------------------------------------------------------
    | PayU Payment Status
    |--------------------------------------------------------------------------
    */
    'paymentStatus' => array(
        'Initiated' => 0,
        'Success'   => 1,
        'Failed'    => 2,
        'Cancelled' => 3
    )


];

