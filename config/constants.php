<?php
/**
 * Created by PhpStorm.
 * User: vasanthmuthusamy
 * Date: 20-03-2017
 * Time: 19:18
 */

return array(
    'pagination' => array(
        'items_per_page' => 10
    ),

    'ProfileStatus' => array(
        'Inactive' => 0,
        'Active' => 1,
        'Pending' => 2,   // Email verification pending
        'Awaiting' => 3,   // Awaiting Moderator's approval
        'Rejected' => 4
    ),

    // Forgot Password config
    'ForgotPasswdFrontUrl' => 'http://www.businessex.com/registration/forgotpassword/',
    'ForgetPasswordMailSubject' => 'BusinessEx.com Password Assistance',

    // Amazon S3 storage path for profiles
    'InvestorProfileImagePath' => 'investor/profile/%s/%s.%s',
    'InvestorLogoImagePath' => 'investor/logo/%s/%s.%s',
    'MentorProfileImagePath' => 'mentor/profile/%s/%s.%s',
    'LenderProfileImagePath' => 'lender/profile/%s/%s.%s',
    'LenderNBFCImagePath' => 'lender/nbfc/%s/%s.%s',
    'LenderNBFCCorporatePath' => 'lender/nbfc/%s/%s.%s',
    'IncubatorLogoImagePath' => 'incubator/logo/%s/%s.%s',
    'IncubatorIocDocPath' => 'incubator/docs/%s/%s.%s',
    'BusinessProfileImagePath' => 'business/pics/%s/%s.%s',
    'BusinessProfileDocPath' => 'business/docs/%s/%s.%s',
    'StartupProfileImagePath' => 'startup/pics/%s/%s.%s',
    'StartupProfileDocPath' => 'startup/docs/%s/%s.%s',
    'StartupProfileCertificatePath' => 'startup/certificate/%s/%s.%s',
    'IncubatorProfileCertificatePath' => 'incubator/certificate/%s/%s.%s',
    'IncubatorProfileLogoPath' => 'incubator/logo/%s/%s.%s',
    'BxInboxAttachFilePath' => 'bxinbox/attach/%s/%s.%s',
    'BxUserProfileImagePath' => 'bxuser/profile/%s/%s.%s',
    'BxBrokerCompanyLogoPath' => 'broker/logo/%s/%s.%s',

    // Facebook Profile pic URL
    'FbProfilePicUrl' => 'http://graph.facebook.com/%s/picture?width=400&height=400',

    // Social media and token keys
    'FacebookApiKey' => 'a6fb197a9cdf6aa72d8cf50e1aae9109',
    'JwtTokenKey' => 'a6fb197a9cdf6aa72d8cf50e1aae9109',
    'GoogleSecretKey' => 'aR02S4Jow3utxZyRJd3DgTo3',
    'LinkedinSecretKey' => 'ingZogVckS7V9Rsm',

    // Main Domain
    'MainDomain' => 'https://www.businessex.com/',

    // Investor Title Pattern
    'InvestorTitlePattern' => 'Individual Investor from %s looking for investment between %s and %s',

    // User Registration source
    'NewRegSource' => array(
        'BusinessEx' => 1,
        'Facebook' => 2,
        'Google' => 3,
        'Linkedin' => 4,
        'BxOld' => 5,
        'FI.COM' => 6,
        'Events' => 7
    ),

    // Mobile OTP  constants.mobile.otpLength
    'mobile' => array(
        'OtpLength' => 4,
        'SmsUrl' => 'http://smsc.co.in/api/mt/SendSMS?APIKey=897242d1-3ade-4a6f-8f7a-8935c00ce20f&senderid=FranIn&channel=2&DCS=0&flashsms=0&number=%s&text=%s&route=1',
        'SmsMsg' => 'Dear %s, Your BusinessEx.com verification code is %s'
    ),

    // Insta Mobile OTP constants.mobile.otpLength
    'instamobile' => array(
        'SmsUrl' => 'http://smsc.co.in/api/mt/SendSMS?APIKey=897242d1-3ade-4a6f-8f7a-8935c00ce20f&senderid=FranIn&channel=2&DCS=0&flashsms=0&number=%s&text=%s&route=1',
        'SmsMsg' => 'Hi, You have got a proposal from %s for your %s Profile. Regards, Team BusinessEx.com'
    ),

    // Payment Source
    'paymentSource' => array(
        'PayU' => 1,
        'Cheque' => 2,
        'NEFT' => 3,
        'DD' => 4
    ),

    // Profile Types
    'profileTypes' => array(
        'Business' => 1,
        'Investor' => 2,
        'Lender' => 3,
        'Mentor' => 4,
        'Incubation' => 5,
        'Broker' => 6,
        'Startup' => 7
    ),

    'investorFirmType' => array(
        1 => 'Corporate Investment Firm',
        2 => 'Private Equity Firm',
        3 => 'Venture Capital Firm'
    ),

    'investorType' => array(
        2 => 'Individual Investor',
        1 => 'Investment Firm'
    ),

    'investmentPreference' => array(
        1 => 'Investment',
        2 => 'Full Acquisition'
    ),

    'lenderType' => array(
        1 => 'Banker',
        2 => 'NBFC',
        3 => 'Private Lender'
    ),

    'nbfcType' => array(
        1 => 'Asset Finance Company (AFC)',
        2 => 'Investment Company (IC)',
        3 => 'Loan Company (LC)',
        4 => 'Infrastructure Finance Company (IFC)',
        5 => 'Systemically Important core Investment Company (CIC-ND-SI)',
        6 => 'Infrastructure Debt Fund (IDF-NBFC)',
        7 => 'Micro Finance Institution (MFI-NBFC)',
        8 => 'Non Banking Finance Company - Factors',
        9 => 'Mortgage Guarantee Company (MGC)',
        10 => 'Non Operative Financial Holding Company (NOFHC)'
    ),

    'invitationStatus' => array(
        'New' => 1,
        'Accepted' => 2,
        'Rejected' => 3,
    ),

    'mentorOccupation' => array(
        1 => 'Education Professional',
        2 => 'Corporate Professional'
    ),

    'businessEntity' => array(
        1 => 'Proprietorship',
        2 => 'Partnership',
        3 => 'Limited Liability Company',
        4 => 'Private Limited Company',
        5 => 'Public Limited Company'
    ),

    'businessType' => array(
        1 => 'B2B',
        2 => 'B2C',
        3 => 'C2C',
        4 => 'C2B',
        5 => 'B2B and B2C'
    ),

    'designationinf' => array(
        1 => 'Director',
        2 => 'CEO',
        3 => 'Owner'
    ),

    'employeeCount' => array(
        1 => 'less than 10',
        2 => '10-50',
        3 => '50-100',
        4 => '100-500',
        5 => '500-1000',
        6 => 'more than 1000'
    ),

    'loanRepaymentPeriod' => array(
        1 => '3 Month',
        2 => '6 Month',
        3 => '9 Month',
        4 => '1 Year',
        5 => '2 Year',
        6 => 'More than 2 Years'
    ),

    'entityType' => array(
        1 => 'Proprietorship',
        2 => 'Partnership',
        3 => 'Limited Liability Company',
        4 => 'Private Limited Company',
        5 => 'Public Limited Company'
    ),

    'companyStage' => array(
        1 => 'Idea & Concept Stage',
        2 => 'Development Stage',
        3 => 'Scaling Up Stage',
        4 => 'Full Business Established'
    ),

    'membershipPlanType' => array(
        0 => 'Profile Activation',
        1 => 'Premium',
        2 => 'Gold',
        3 => 'Platinum',
        4 => 'Promoted-Event',
        501 => 'Profile View',
        502 => 'Top Recommendations',
        503 => 'Interaction Credits ',
        504 => 'Insta Credits',
    ),

    'brokerProfileType' => array(
        1 => 'Individual',
        2 => 'Firm'
    ),

    'contentType' => array(
        'Article' => 1,
        'News' => 2
    ),

    'statesIndia' => array(
        'AP' => 'Andhra Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'BR' => 'Bihar',
        'CG' => 'Chhattisgarh',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu and Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Orissa',
        'PB' => 'Punjab',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TS' => 'Telangana',
        'TR' => 'Tripura',
        'UK' => 'Uttarakhand',
        'UP' => 'Uttar Pradesh',
        'WB' => 'West Bengal',
        'AN' => 'Andaman and Nicobar Islands',
        'CH' => 'Chandigarh',
        'DH' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman and Diu',
        'DL' => 'Delhi',
        'LD' => 'Lakshadweep',
        'PY' => 'Pondicherry'
    ),

    'regionViseStates' => array(
        'AP' => ['AP', 'KL', 'KA', 'TN', 'TS'],
        'AR' => ['AR', 'AS', 'ML', 'MZ', 'TR', 'MN', 'NL', 'WB', 'SK', 'OR'],
        'AS' => ['AS', 'ML', 'MZ', 'TR', 'AR', 'MN', 'NL', 'WB', 'SK', 'OR'],
        'BR' => ['BR', 'CG', 'MP', 'JH'],
        'CG' => ['CG', 'MP', 'BR', 'JH'],
        'GA' => ['GA', 'RJ', 'MH', 'GJ'],
        'GJ' => ['GJ', 'RJ', 'MH', 'GA'],
        'HR' => ['HR', 'DL', 'HP', 'JK', 'PB', 'UK', 'UP'],
        'HP' => ['HP', 'DL', 'HR', 'JK', 'PB', 'UK', 'UP'],
        'JK' => ['JK', 'DL', 'HR', 'HP', 'PB', 'UK', 'UP'],
        'JH' => ['JH', 'MP', 'BR', 'CG'],
        'KA' => ['KA', 'KL', 'TN', 'AP', 'TS'],
        'KL' => ['KL', 'KA', 'TN', 'AP', 'TS'],
        'MP' => ['MP', 'CG', 'BR', 'JH'],
        'MH' => ['MH', 'RJ', 'GJ', 'GA'],
        'MN' => ['MN', 'ML', 'MZ', 'TR', 'AR', 'AS', 'NL', 'WB', 'SK', 'OR'],
        'ML' => ['ML', 'AS', 'MZ', 'TR', 'AR', 'MN', 'NL', 'WB', 'SK', 'OR'],
        'MZ' => ['MZ', 'ML', 'AS', 'TR', 'AR', 'MN', 'NL', 'WB', 'SK', 'OR'],
        'NL' => ['NL', 'ML', 'MZ', 'TR', 'AR', 'MN', 'AS', 'WB', 'SK', 'OR'],
        'OR' => ['OR', 'ML', 'MZ', 'TR', 'AR', 'MN', 'NL', 'WB', 'SK', 'AS'],
        'PB' => ['PB', 'DL', 'HR', 'HP', 'JK', 'UK', 'UP'],
        'RJ' => ['RJ', 'GJ', 'MH', 'GA'],
        'SK' => ['SK', 'ML', 'MZ', 'TR', 'AR', 'MN', 'NL', 'WB', 'AS', 'OR'],
        'TN' => ['TN', 'KL', 'KA', 'AP', 'TS'],
        'TS' => ['TS', 'KL', 'KA', 'TN', 'AP'],
        'TR' => ['TR', 'ML', 'MZ', 'AS', 'AR', 'MN', 'NL', 'WB', 'SK', 'OR'],
        'UK' => ['UK', 'DL', 'HR', 'HP', 'JK', 'PB', 'UP'],
        'UP' => ['UP', 'DL', 'HR', 'HP', 'JK', 'PB', 'UK'],
        'WB' => ['WB', 'ML', 'MZ', 'TR', 'AR', 'MN', 'NL', 'AS', 'SK', 'OR'],
        'AN' => ['AN', 'PY', 'CH', 'LD', 'DD'],
        'CH' => ['CH', 'PY', 'AN', 'LD', 'DD'],
        'DH' => ['DH', 'AN', 'PY', 'CH', 'LD', 'DD'],
        'DD' => ['DD', 'AN', 'PY', 'CH', 'LD', 'DD'],
        'DL' => ['DL', 'HR', 'HP', 'JK', 'PB', 'UK', 'UP'],
        'LD' => ['LD', 'PY', 'CH', 'AN', 'DD'],
        'PY' => ['PY', 'AN', 'CH', 'LD', 'DD']
    ),

    // Insta Credits
    'addOnCredits' => array(
        'ProfileView' => 2,
        'TopRecommend' => 4,
        'Interaction' => 10,
        'Instant' => 10,
        'NoCredits' => 0,
        'UnlimitedCredit' => 'Unlimited'
    ),

    'planType' => array(
        1 => 'Premium',
        2 => 'Gold',
        3 => 'Platinum',
        0 => 'Profile Activation'
    ),

    'bannerLocation' => array(
        'Top' => 1,
        'Left' => 2,
        'Right' => 3,
        'Middle' => 4,
        'Bottom' => 5,
        'Mobile_Top' => 6,
    ),
    'isCachingOn' => false, // use caching if flag is true
    'profileRegistrationEmailTo' => ['techsupport@franchiseindia.net'],
    'invstake' => [1 => "0-5", 2 => "5-10", 3 => "10-25", 4 => "25-35", 5 => "40-50", 6 => "more than 50"],
    'profileContactLimitExceedMessage' => 'You have used all your insta credits for today. <br> Note: You can only contact any 5 profiles per day.',
    'addOnProfileView' => [1 => 1000, 3 => 2500, 6 => 4000],
    'addOnTopRecommendation' => [1 => 1000, 3 => 2500, 6 => 4000],
    'addOnInteraction' => [5 => 1000, 10 => 1500, 15 => 2000],
    'addOnInstaResponse' => [5 => 1000, 10 => 1500, 15 => 2000],
    'addOnAcceleratedMarketing' => [1 => 2500],
    'addOnTopBuyerSeller' => [20 => 2000, 50 => 3000],
    'loanInterestRate' => [
        1 => "0-5",
        2 => "5-10",
        3 => "10-25",
        4 => "25-35",
        5 => "40-50",
        6 => "more than 50"
    ],
    'contactStatus' => array(
        0 => 'Wrong No',
        2 => 'Follow Up',
        3 => 'Closed',
        4 => 'Not Interested',
        5 => 'Not Responding',
        6 => 'Switch Off',
        7 => 'Other',
    ),
    'businessServices' => [
        1 => 'Business Valuation',
        2 => 'Business Plan',
        3 => 'BEx Guruwaar',
        4 => 'Due Diligence',
    ],
    'originalPlanAmount' => [
        1 => '4999',
        2 => '7499',
        3 => '15000',
        0 => '1000'
    ],
    'sellingPlanAmount' => [
        1 => '5999',
        2 => '11999',
        3 => '19999',
        0 => '999'
    ],
    'sellingPlanAmountMentorStartup' => [
        1 => '2499',
        2 => '3999',
        3 => '5999',
        0 => '999'
    ],
    'ImageCDN'=>'https://media.businessex.com'
);
