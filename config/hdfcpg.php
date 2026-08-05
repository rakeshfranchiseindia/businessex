<?php

/**
 * User: Yogendra Tomar
 * Date: 13-03-2020
 * Time: 12:26
 */
return [
    /*
      |--------------------------------------------------------------------------
      | PayU Merchant Key
      |--------------------------------------------------------------------------
     */

//'merchantKey' => 'gtKFFx',  //Staging
    'merchantKey' => '344760',
    'workingKey' => '15208D7E5FABDCCC3FC14480DBB91A69', 
    'accessCode' => 'AVIW03IC84AF89WIFA',    
    /*
      |--------------------------------------------------------------------------
      | PayU Salt
      |--------------------------------------------------------------------------
     */

//'salt' => 'eCwWELxi',   staging
// 'salt' => '0LBCTaus',

    /*
      |--------------------------------------------------------------------------
      | PayU Default Success Url
      |--------------------------------------------------------------------------
     */
   'surl' => 'http://bxapi.businessex.com/bexapi/hdfcVerifypayment',
   'surlService' => 'http://bxapi.businessex.com/bexapi/hdfcVerifyservicepayment',
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
    'curl' => 'http://bxapi.businessex.com/bexapi/hdfcPaymentcancelled',
    'curlService' => 'http://bxapi.businessex.com/bexapi/hdfcCancelledservicepayment',
    /*
      |--------------------------------------------------------------------------
      | PayU Default Base Url
      |--------------------------------------------------------------------------
     */
//'baseUrl' => 'https://test.payu.in',
//'baseUrl' => 'https://secure.payu.in/_payment',

    /*
      |--------------------------------------------------------------------------
      | PayU Hash Sequence Pattern
      |--------------------------------------------------------------------------
     */
// 'hashSeq' => '%s|%s|%s|%s|%s|%s|||||||||||%s',

    /*
      |--------------------------------------------------------------------------
      | PayU Payment Status
      |--------------------------------------------------------------------------
     */
    'paymentStatus' => array(
        'Initiated' => 0,
        'Success' => 1,
        'Failed' => 2,
        'Cancelled' => 3
    ),
    'charges' => array(
        'OPTCRDC' => "2.06",
        'OPTDBCRD' => "1.06",
        'OPTNBK' => "2.12",
        'OPTCASHC' => "0",
        'OPTMOBP' => "0",
        'OPTEMI' => "2.12",
        'OPTWLT' => "0",
        "Paytm" => "2.36"
    )
];

