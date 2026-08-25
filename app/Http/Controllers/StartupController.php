<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileStartup;
use App\Models\StartupImage;
use App\Models\BxCity;
use App\Models\IndustryCategory;

class StartupController extends Controller
{
    /**
     * Display the startup listing page with filters and pagination
     */
    public function startupListing(Request $request)
    {
        // Get filter parameters from request
        $businessType = $request->get('business_type', 'all');
        $locationIds = collect($request->input('location', []))->map(fn($v) => (int)$v)->all();
        $industryIds = collect($request->input('industry', []))->map(fn($v) => (int)$v)->all();
        $minInvestment = $request->get('min_investment', null);
        $maxInvestment = $request->get('max_investment', null);

        // Build the query
        $query = ProfileStartup::query()
            ->where('startup_profile_status', config('constants.ProfileStatus.Active'))
            ->with(['images', 'management', 'fundRaising', 'industrySector']);

        // Apply business type filter
        if ($businessType !== 'all') {
            $query = $this->applyBusinessTypeFilter($query, $businessType);
        }

        // Apply location filter
        if (!empty($locationIds)) {
            $locationNames = BxCity::query()
                ->whereIn('id', $locationIds)
                ->get(['city', 'state'])
                ->flatMap(fn ($location) => [$location->city, $location->state])
                ->filter()
                ->unique()
                ->values();

            if ($locationNames->isEmpty()) {
                $query->whereRaw('1 = 0');
            } else {
                $query->where(function ($locationQuery) use ($locationNames) {
                    $locationQuery
                        ->whereIn('ofc_city', $locationNames)
                        ->orWhereIn('ofc_state', $locationNames);
                });
            }
        }

        // Apply industry filter (through industry_sector field)
        if (!empty($industryIds)) {
            $query->whereIn('industry_sector', $industryIds);
        }

        // Apply investment range filter
        if ($minInvestment !== null && $minInvestment !== '') {
            $query->whereRaw('CAST(inv_asking_price AS DECIMAL(20, 2)) >= ?', [(float) $minInvestment]);
        }
        if ($maxInvestment !== null && $maxInvestment !== '') {
            $query->whereRaw('CAST(inv_asking_price AS DECIMAL(20, 2)) <= ?', [(float) $maxInvestment]);
        }

        // Get paginated results
        $itemsPerPage = 2;//config('constants.pagination.items_per_page', 10);
        $startups = $query->paginate($itemsPerPage)->appends($request->except('page'));

        // Transform the startup data for view
        $startups = $this->transformStartupData($startups);

        // Get data for filters (shared with sidebar)
        $businessTypeData = $businessType;

        return view('startuplist', compact('startups', 'businessTypeData'));
    }

    /**
     * Apply business type filter to query
     */
    private function applyBusinessTypeFilter($query, $businessType)
    {
        $filterMap = [
            'investor'    => 'seeking_investors',
            'buyer'       => 'seeking_acquirers',
            'loan'        => 'seeking_loan',
            'mentorship'  => 'seeking_mentorship',
            'incubators'  => 'seeking_incubators',
        ];

        if (!isset($filterMap[$businessType])) {
            return $query;
        }

        $column = $filterMap[$businessType];
        return $query->where($column, 1);
    }

    /**
     * Transform startup data for the view
     */
    private function transformStartupData($paginator)
    {
        $constants = config('constants');
        $entityTypes = $constants['entityType'] ?? [];
        $businessTypes = $constants['businessType'] ?? [];
        $employeeCounts = $constants['employeeCount'] ?? [];
        $companyStages = $constants['companyStage'] ?? [];

        $startups = $paginator->getCollection()->map(function ($startup) use ($entityTypes, $businessTypes, $employeeCounts, $companyStages, $constants) {
            // Get profile image
            $profileImage = $startup->images()
                ->where('type', 1)
                ->where('is_active', 1)
                ->first();
            
            $imagePath = $profileImage 
                ? asset($profileImage->startup_img_path)
                : asset('assets/img/placeholder-startup.png');

            // Get location name
            $locationName = $startup->ofc_city . ', ' . $startup->ofc_state;

            // Get industry name from config
            $industryId = $startup->industry_sector;
            $industryName = 'N/A';
            if ($industryId) {
                $industryName = config("industryCategoriesConfig.$industryId.category_name", $industryName);
            }

            // Get entity type label
            $entityTypeLabel = $entityTypes[$startup->nature_of_entity] ?? $startup->nature_of_entity ?? 'N/A';

            // Get business type label
            $businessTypeLabel = $businessTypes[$startup->business_type] ?? $startup->business_type ?? 'N/A';

            // Get employee count label
            $empCountLabel = $employeeCounts[$startup->emp_count] ?? $startup->emp_count ?? 'N/A';

            // Get company stage label
            $stageLabel = $companyStages[$startup->company_stage] ?? 'N/A';

            // Determine badge based on what startup is seeking
            $badge = $this->getStartupBadge($startup);

            // Get seeking requirements
            $seekingRequirements = $this->getSeekingRequirements($startup);

            // Format investment amount
            $investmentAmount = $this->formatCurrency($startup->inv_asking_price ?? 0);

            return [
                'startup_id'       => $startup->startup_id,
                'title'           => $startup->startup_name ?? 'N/A',
                'headline'        => $startup->advmt_headline ?? '',
                'description'     => $startup->startup_intro ?? '',
                'image'           => $imagePath,
                'badge'           => $badge,
                'category'        => $industryName,
                'location'        => $locationName,
                'annual_sales'    => $startup->annual_sales ?? 0,
                'tags'            => $seekingRequirements,
                'investment'      => $investmentAmount,
                'requirement'     => $stageLabel,
                'est_year'        => $startup->estb_date ? date('Y', strtotime($startup->estb_date)) : 'N/A',
                'employee_count'  => $empCountLabel,
                'entity_type'     => $entityTypeLabel,
                'business_type'   => $businessTypeLabel,
                'contact_email'   => $startup->startup_email ?? '',
                'contact_mobile'  => $startup->startup_mobile ?? '',
                'profile_url'     => '#', // Link to startup profile detail view when available
                'seeking_investors'    => $startup->seeking_investors ?? 0,
                'seeking_loan'         => $startup->seeking_loan ?? 0,
                'seeking_mentorship'   => $startup->seeking_mentorship ?? 0,
                'seeking_incubators'   => $startup->seeking_incubators ?? 0,
                'seeking_acquirers'    => $startup->seeking_acquirers ?? 0,
            ];
        });

        // Create new paginator with transformed data
        return $paginator->setCollection($startups);
    }

    /**
     * Get badge for startup based on seeking status
     */
    private function getStartupBadge($startup)
    {
        if ($startup->seeking_investors) {
            return 'Seeking Investment';
        } elseif ($startup->seeking_loan) {
            return 'Seeking Loan';
        } elseif ($startup->seeking_mentorship) {
            return 'Seeking Mentorship';
        } elseif ($startup->seeking_incubators) {
            return 'Seeking Incubator';
        } elseif ($startup->seeking_acquirers) {
            return 'Open for Acquisition';
        }
        return 'Active Startup';
    }

    /**
     * Get what the startup is seeking
     */
    private function getSeekingRequirements($startup)
    {
        $requirements = [];
        
        if ($startup->seeking_investors) {
            $requirements[] = 'Investment';
        }
        if ($startup->seeking_loan) {
            $requirements[] = 'Loan';
        }
        if ($startup->seeking_mentorship) {
            $requirements[] = 'Mentorship';
        }
        if ($startup->seeking_incubators) {
            $requirements[] = 'Incubation';
        }
        if ($startup->seeking_acquirers) {
            $requirements[] = 'Acquisition';
        }

        return !empty($requirements) ? $requirements : ['Active'];
    }

    /**
     * Format currency value
     */
    private function formatCurrency($value)
    {
        if (empty($value) || $value == 0) {
            return 'Not Specified';
        }

        $value = (float)$value;
        
        if ($value >= 10000000) {
            return '₹' . number_format($value / 10000000, 2) . ' Cr';
        } elseif ($value >= 100000) {
            return '₹' . number_format($value / 100000, 2) . ' L';
        }
        
        return '₹' . number_format($value, 0);
    }

    public function startupDetail($startup_profile)
    {
        $startup = ProfileStartup::with(['images', 'management', 'fundRaising', 'industrySector'])
            ->where('startup_profile_status', config('constants.ProfileStatus.Active'))
            ->where('startup_id', $startup_profile)
            ->firstOrFail();

        return view('bx-startup-details', compact('startup'));
    }
}
