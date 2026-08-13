<?php

namespace App\Models;

class ProfileBusiness extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'profile_business';

    protected $primaryKey = 'business_id';

    protected $fillable = [
        'business_profile_str',
        'user_id',
        'seller_name',
        'seller_designation',
        'seller_mobile',
        'seller_email',
        'advmt_headline',
        'seller_intro',
        'seller_company',
        'estb_year',
        'emp_count',
        'entity_type',
        'business_type',
        'industry_sector',
        'business_industry',
        'business_location',
        'business_website',
        'facilities_desc',
        'annual_sales',
        'ebitda',
        'gross_profit',
        'inventory_value',
        'ebitda_margin',
        'rentals',
        'company_summary',
        'director_name',
        'director_email',
        'director_designation',
        'ofc_address',
        'ofc_city',
        'ofc_state',
        'ofc_country',
        'ofc_pincode',
        'business_pitch',
        'seeking_investors',
        'seeking_buyers',
        'seeking_loan',
        'seeking_mentors',
        'seeking_accelerators',
        'buyer_sell_price',
        'buyer_sell_reason',
        'inv_for',
        'inv_asking_price',
        'inv_stake',
        'inv_reason',
        'loan_collateral_details',
        'loan_amount',
        'loan_repayment_period',
        'loan_interest_rate',
        'loan_reason',
        'loan_existing',
        'mentor_req_details',
        'accel_req_details',
        'accel_inv_req',
        'accel_time_period',
        'seller_prof_pic',
        'seller_prof_thumb_pic',
        'seller_prof_thumb_pic1',
        'seller_prof_pic1',
        'seller_doc_path',
        'seller_doc_path1',
        'seller_doc_path2',
        'seller_doc_path3',
        'seller_doc_path4',
        'business_profile_status',
        'membership_paid',
        'membership_plan',
        'seller_prof_thumb_pic_name',
        'trackid',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'mailer_campaign',
        'contact_response',
        'contact_status',
        'activated_by',
        'activated_at',
        'last_login_at',
    ];

    protected $casts = [
        'annual_sales' => 'decimal:2',
        'ebitda' => 'decimal:2',
        'ebitda_margin' => 'decimal:2',
        'buyer_sell_price' => 'decimal:2',
        'inv_asking_price' => 'decimal:2',
        'loan_amount' => 'decimal:2',
        'accel_inv_req' => 'decimal:2',
        'activated_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(BusinessImage::class, 'business_id', 'business_id');
    }

    public function management()
    {
        return $this->hasMany(ProfileBusinessMgmt::class, 'business_profile_id', 'business_id');
    }

    public function industryPreferences()
    {
        return $this->hasMany(IndPrefBusiness::class, 'business_profile_id', 'business_id');
    }

    public function locationPreferences()
    {
        return $this->hasMany(LocPrefBusiness::class, 'business_profile_id', 'business_id');
    }

    public function contactRequests()
    {
        return $this->hasMany(ContactBusiness::class, 'profile_id', 'business_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(BusinessBookmark::class, 'profile_id', 'business_id');
    }

    public function visitors()
    {
        return $this->hasMany(ProfileVisitor::class, 'profile_id', 'business_id');
    }

}
