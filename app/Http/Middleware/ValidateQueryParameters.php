<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateQueryParameters
{
    private const ALLOWED = [
        'business-listing' => [
            'business_type', 'location', 'industry', 'slug', 'min', 'max',
            'annual_sale_min', 'annual_sale_max', 'page',
        ],
        'startup-listing' => [
            'business_type', 'location', 'industry', 'min_investment',
            'max_investment', 'page',
        ],
        'investor-listing' => [
            'state', 'city', 'currentPage', 'itemsPerPage', 'industrymain',
            'industrysub', 'maxInvestment', 'minInvestment', 'investorType',
            'sortby',
        ],
        'mentor-listing' => [
            'state', 'city', 'occupation', 'location', 'sortby', 'itemsPerPage',
            'page',
        ],
        'detail' => [],
    ];

    public function handle(Request $request, Closure $next, string $profile): Response
    {
        abort_unless(array_key_exists($profile, self::ALLOWED), 404);

        $unknownParameters = array_diff(
            array_keys($request->query()),
            self::ALLOWED[$profile]
        );

        abort_if($unknownParameters !== [], 404);

        return $next($request);
    }
}
