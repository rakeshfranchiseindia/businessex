<?php

if (!function_exists('stateDisplayName')) {
    function stateDisplayName($state): string
    {
        $state = trim((string) $state);

        return config('constants.statesIndia.' . $state, $state);
    }
}

if (!function_exists('getInvestmentRange')) {
    function getInvestmentRange($investorDetails)
    {
        $minInvestment = 0;
        $maxInvestment = 0;

        if (
            $investorDetails['invest_pref'] == 1 &&
            $investorDetails['full_acquisition'] == 1
        ) {
            $minInvestment = $investorDetails['invest_size_min'];
            $maxInvestment = $investorDetails['invest_size_max'];
        }

        if (
            $investorDetails['invest_pref'] == 1 &&
            $investorDetails['full_acquisition'] == 0
        ) {
            $minInvestment = $investorDetails['invest_size_min'];
            $maxInvestment = $investorDetails['invest_size_max'];
        }

        if (
            $investorDetails['invest_pref'] == 0 &&
            $investorDetails['full_acquisition'] == 1
        ) {
            $minInvestment = $investorDetails['purchase_capacity_min'];
            $maxInvestment = $investorDetails['purchase_capacity_max'];
        }

        $minInvestment = convertAmountToShort($minInvestment, 0);
        $maxInvestment = convertAmountToShort($maxInvestment, 0);

        return [$minInvestment, $maxInvestment];
    }
}


if (!function_exists('convertAmountToShort')) {
    function convertAmountToShort($rpVal, $decimalPoints)
    {
        if (!is_numeric($rpVal)) {
            return $rpVal;
        }

        // These must be elseif, not separate ifs: once a branch reassigns
        // $rpVal to a formatted string ("15 Lakhs"), a later `if` here would
        // re-test/re-divide that STRING as if it were still the raw number —
        // that's what was throwing "A non-numeric value encountered" (fatal
        // in this app, since warnings are elevated to exceptions).
        if ($rpVal > 1000 && $rpVal < 100000) {
            $mod = round($rpVal / 1000, $decimalPoints);
            $rpVal = $mod . " Thousand";
        } elseif ($rpVal >= 100000 && $rpVal < 10000000) {
            $mod = round($rpVal / 100000, $decimalPoints);
            $rpVal = $mod . " Lakhs";
        } elseif ($rpVal >= 10000000) {
            $decimalPoints = ($decimalPoints == 0) ? 2 : $decimalPoints;
            $mod = round($rpVal / 10000000, $decimalPoints);
            $rpVal = $mod . " Crores";
        }

        return $rpVal;
    }
}
if (!function_exists('cleanSpecialChar')) {
    function cleanSpecialChar($string)
    {
        $specialCharacters = [
            '#' => '',
            '$' => '',
            '%' => '',
            '&' => '',
            '@' => '',
            '.' => '',
            '€' => '',
            '+' => '',
            '=' => '',
            '§' => '',
            '\\' => '',
            '/' => '',
        ];

        foreach ($specialCharacters as $character => $replacement) {
            $string = str_replace(
                $character,
                '-' . $replacement . '-',
                $string
            );
        }

        $string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
        $string = preg_replace('/^[\-]+/', '', $string);
        $string = preg_replace('/[\-]+$/', '', $string);
        $string = preg_replace('/[\-]{2,}/', ' ', $string);

        return $string;
    }
    
}
if (!function_exists('getInvestmentPreference')) {
    function getInvestmentPreference($investorDetails)
    {
        $investmentPref = '';

        if ($investorDetails['full_acquisition'] == 1 && $investorDetails['invest_pref'] == 0) {
            $investmentPref = 'Acquisition';
        }

        if ($investorDetails['invest_pref'] == 1 && $investorDetails['full_acquisition'] == 0) {
            $investmentPref = 'Investment';
        }

        if ($investorDetails['invest_pref'] == 1 && $investorDetails['full_acquisition'] == 1) {
            $investmentPref = 'Investment / Acquisition';
        }

        return $investmentPref;
    }
}


if (!function_exists('getAskingPrice')) {
    function getAskingPrice($sellerDetails, $isAsking = false)
    {
        $askingPrice = 'NA';

        // priority of showing asking price as per profile
        if (isset($sellerDetails['business_profile_str'])) {
            if ($sellerDetails['accel_inv_req'] > 0) {
                $askingPrice = $sellerDetails['accel_inv_req'];
            }
            if ($sellerDetails['loan_amount'] > 0) {
                $askingPrice = $sellerDetails['loan_amount'];
            }
            if ($sellerDetails['inv_asking_price'] > 0) {
                $askingPrice = $sellerDetails['inv_asking_price'];
            }
            if ($sellerDetails['buyer_sell_price'] > 0) {
                $askingPrice = $sellerDetails['buyer_sell_price'];
            }
        } else {
            if ($sellerDetails['accel_inv_req'] > 0) {
                $askingPrice = $sellerDetails['accel_inv_req'];
            }
            if ($sellerDetails['buyer_sell_price'] > 0) {
                $askingPrice = $sellerDetails['buyer_sell_price'];
            }
            if ($sellerDetails['loan_amount'] > 0) {
                $askingPrice = $sellerDetails['loan_amount'];
            }
            if ($sellerDetails['inv_asking_price'] > 0) {
                $askingPrice = $sellerDetails['inv_asking_price'];
            }
        }

        if ($isAsking) {
            return $askingPrice;
        }

        return convertAmountToShort($askingPrice, 0);
    }
}


if (!function_exists('getSellerLocation')) {
    function getSellerLocation($seller)
    {
        $sellersState = config('constants.statesIndia.' . $seller['ofc_state']);
        $location = $seller['ofc_city'] . ',  ' . $seller['ofc_state'];

        if ($sellersState) {
            $location = $seller['ofc_city'] . ',  ' . $sellersState;
        }

        return $location;
    }
}


if (!function_exists('priceLabelBusiness')) {
    function priceLabelBusiness($startupDetails)
    {
        $label = '';
        if ($startupDetails['seeking_mentors']) {
            $label = 'Seeking Mentor';
        }
        if ($startupDetails['seeking_accelerators']) {
            $label = 'Seeking Investment';
        }
        if ($startupDetails['seeking_loan']) {
            $label = 'Seeking Loan';
        }
        if ($startupDetails['seeking_investors']) {
            $label = 'Seeking Investment';
        }
        if ($startupDetails['seeking_buyers']) {
            $label = 'Asking Price';
        }
        return $label;
    }
}


if (!function_exists('priceLabelStartup')) {
    function priceLabelStartup($startupDetails)
    {
        $label = 'NA';
        if ($startupDetails['seeking_incubators']) {
            $label = 'Seeking Investment';
        }
        if ($startupDetails['seeking_acquirers']) {
            $label = 'Asking Price';
        }
        if ($startupDetails['seeking_loan']) {
            $label = 'Seeking Loan';
        }
        if ($startupDetails['seeking_mentorship']) {
            $label = 'Seeking Mentor';
        }
        if ($startupDetails['seeking_investors']) {
            $label = 'Seeking Investment';
        }
        return $label;
    }
}


if (!function_exists('randomSubCategoryImage')) {
    function randomSubCategoryImage($catId, $width, $height, $all = false)
    {
        $imageSet = [
            15 => ['91295156', '114594787', '176402912', '209921920', '358119659', '619891064'],
            16 => ['126064121', '263675750', '273934328', '288737060', '721076371', '1013104291', '1115484668'],
            17 => ['296722325', '488175217', '701764786', '737458639', '753702223', '793083490', '1233977635'],
            18 => ['375683737', '471343589', '515877400', '621530111', '754400164'],
            19 => ['36919255', '297999803', '338636855', '375753037', '403780030', '726712018'],
            20 => ['138252137', '406431103', '507397177', '661799206', '759448675', '762072385', '1124428316'],
            21 => ['56710468', '149749874', '232276042', '733812256', '773846263', '1042568224', '1361187998'],
            22 => ['138250826', '386720620', '519671452', '622823048', '1011931711', '1086840347'],
            23 => ['292187882', '335581730', '446092015', '521849182', '547407109', '564221938', '578849926'],
            28 => ['204535609', '389790181', '566591296', '761077030', '1007450311'],
            29 => ['56187514', '77058727', '108007286', '330844826', '401309230', '648901270'],
            34 => ['298752515', '589388144', '692205181', '795683179', '1007314102'],
            35 => ['74757589', '87781027', '141582367', '209940766', '362877266'],
            36 => ['605684882', '633964913', '1113082205', '1248693943', '1315533044', '1337296190'],
            38 => ['123704254', '552097078', '604328939', '700226077', '785109361', '1017025384'],
            37 => ['130517294', '213333985', '326638589', '621157613', '655037578', '1053737912'],
            39 => ['251933845', '388630477', '704737204', '722774977', '1079639357'],
            40 => ['376480093', '1049057906', '136751279', '200136746', '579451312', '227631046'],
            42 => ['144022057', '516275389', '564987298', '591209654', '615581297', '626626838'],
            41 => ['562165456', '529397326', '657513373', '295555664', '338483102'],
            43 => ['358265852', '583065985', '664883989', '373694485', '150158387'],
            44 => ['175965569', '497500513', '792538363', '213320158', '791008504', '724807297', '1184930191'],
            45 => ['1219007800', '1306085755', '1344109109', '82426351', '72094732', '1258515634', '519223267'],
            46 => ['337161530', '524837569', '609103169', '621674351', '721502437', '723086014', '1030032883'],
            47 => ['239278753', '503680609', '695046466', '1034282797', '1054761782'],
            48 => ['611606933', '156022646', '528854752', '786971899', '104336624'],
            49 => ['648908809', '485148412', '522110878', '1114244621', '391276264', '1066228688', '1296931378'],
            50 => ['310180061', '128912804', '1167232732', '752399074', '132304208', '578043463', '233948095', '386903308'],
            51 => ['1028530414', '552259924', '276464039', '579040885', '125340167', '680742976', '129943292'],
            52 => ['767980396', '1329218480', '1304713684', '612306623'],
            54 => ['704036482', '390599908', '766708444', '622413335', '245853028', '407951575'],
            53 => ['50056114', '215641117', '227609992', '357493880', '577603468', '1109649980'],
            55 => ['244733677', '458893558', '695041726', '695046562', '742177672', '1177797514', '1223030470'],
            56 => ['70782406', '124077403', '465281132', '561845899', '615581297', '1116897128', '1354783574'],
            57 => ['167027126', '335742965', '443069599', '515885956', '552259924', '713186644', '1028530414'],
            58 => ['94265785', '214882000', '342812459', '548073523', '1194000805'],
            59 => ['314848592', '631086410'],
            60 => ['328908710', '589482089', '797334520', '1197034852', '1252038760', '1348479263'],
            61 => ['88399243', '91519085', '213040195', '250261546', '269516258', '354650093', '522019972'],
            64 => ['318507608', '340152863', '419180689', '739402477', '793078339'],
            65 => ['251497315', '387334384', '661113826', '725359189', '1147852502'],
            66 => ['289585190', '523768063', '531055792', '560271130', '1113163970'],
            68 => ['223094107', '387792820', '575376397', '727853458', '1012270636'],
            69 => ['197455220', '636925537', '1016554156', '1023938740', '1026002596'],
            71 => ['378771547', '496840360', '566475787', '619110806', '767796808', '1016363545', '1086491852'],
            72 => ['278339894', '583881439', '588029498', '645219262', '1067991896'],
            77 => ['417293194', '436545799', '447486787', '532153939', '686184610', '786090865', '1043951605'],
            78 => ['519831238', '542082373', '576886780', '674435491', '1119754646'],
            79 => ['576896977', '633781313', '741451888', '1161800287', '1224274198'],
            81 => ['107373092', '273407585', '296001509', '1172384449', '1177721674', '1342257614'],
            82 => ['175786871', '177503219', '258525938', '423062023', '532057639', '540240925'],
            83 => ['120771937', '285401129', '452900215', '529030204', '652234435', '746650405', '1070794775', '1239599536'],
            85 => ['233716384', '397927255', '412311502', '548152279', '648758689', '1017688327', '1034790034'],
            86 => ['116283283', '390162811', '403868707', '1059811571', '1095464813'],
            87 => ['429084724', '713581222', '1028020777', '1155622726'],
            88 => ['106561970', '546271222', '685264144', '1066788122', '1121600516'],
            89 => ['580329337'],
            90 => ['165923525', '416661100', '436506028', '536476165', '649457611', '725256820', '791111584'],
            112 => ['342898208', '348324008', '428220508', '572748772', '617005082'],
            119 => ['406517023', '617507069', '686844292', '719895307', '755350933', '1028135884', '1132500290'],
            120 => ['89038666', '266676788', '267265577', '442157047', '520615606', '601129751'],
            121 => ['276651353', '318088739', '533130643', '547466125', '622788116', '1178362387', '1346057183'],
            122 => ['80777629', '380243965', '761907310', '761908033', '1150690232', '1161308839'],
            124 => ['209979001', '422167549', '753671818', '1050808202', '1263761995', '1312529225', '1327245395'],
            127 => ['103879322', '237226108', '442999612', '630915938', '1011576019'],
            134 => ['1149190532', '548559592', '120261622', '381771619', '288330335', '128876317'],
            135 => ['728293966', '462908386', '741942340', '93861613', '677621230', '93861613', '558520747'],
            136 => ['752076598', '1343710196', '526839118', '667100452', '1070688767', '1234319038'],
            139 => ['578104672', '459656608', '728293966', '105111686', '411757396', '221096500'],
            140 => ['210749167', '386744719', '673268602', '1038318109', '1126949681'],
            143 => ['161818667', '185270735', '235629937', '317891279', '336640721', '549855790', '561722458'],
            145 => ['1273230085', '1316277158', '789022792', '759619774', '1195300432', '762375802'],
            146 => ['254969464', '1063513568', '549055441', '516539476', '466486631', '715249594'],
            147 => ['518547550', '1085516465', '741686113', '363707237', '1186883545'],
            148 => ['93338575', '1025031589', '1321678403', '134216600', '83839360'],
            151 => ['1239599536', '1070794775', '285401129', '529030204', '652234435', '120771937', '746650405', '452900215', '270461501'],
            157 => ['417293194', '436545799', '447486787', '532153939', '686184610', '786090865', '1043951605'],
            158 => ['307612805', '354383690', '388726060', '421677028', '434934553', '464260121', '531741703'],
            164 => ['94327450', '173535041', '291419966', '1005668659', '1029974515'],
            165 => ['130880801', '317631077', '318171632', '407822140', '596931482', '667994098'],
            170 => ['348052715', '449136610', '559856737', '670249444', '1020294691'],
            187 => ['195723311', '681770029', '763670857', '1155563959', '1175962528', '1214344126', '1316947328'],
            188 => ['155487029', '555705742', '625208228', '644231245', '1046280247', '1066788122', '1188498334'],
            189 => ['20633581', '523682233', '528466828', '577056808', '590265665', '663070918'],
            190 => ['143926126', '146829527', '154195253', '254033098', '344329640', '560104441'],
            191 => ['512210', '107196662', '502002541', '1096671455', '1141482818'],
            193 => ['103678202', '370005596', '559380220', '639063613', '654331657', '709149532', '1315034813'],
            194 => ['524101153', '553614883', '581765149', '653068420', '1320609341', '1349267699'],
            195 => ['149570927', '164603351', '171240113', '192997676', '307491971'],
            199 => ['118200196', '429638932', '620311622', '1115404901', '1127090882'],
            207 => ['167093621', '276104912', '510718735', '1011759940', '1099091780', '1129551926'],
            210 => ['136149383', '212871865', '242575054', '269021891', '361444571'],
            236 => ['228188542', '518617552', '598918634', '604036076', '619567010'],
            241 => ['125411825', '144583085', '381212158', '392387443', '1027181617'],
            244 => ['500436901', '497743579', '721777969', '347420135', '537788836'],
            243 => ['273592568', '530792194', '609243434', '707662543', '775221112', '1020143272'],
            246 => ['132961508', '293337704', '471059489', '589577570', '746209546', '781514284'],
            247 => ['42862789', '99756866', '489209362', '570140890', '1070369402', '1148840183'],
            250 => ['227849809', '289730621', '592981166', '695996026', '1018551961'],
            251 => ['299049458', '403306198', '526625740', '1024967245', '1247122546'],
            252 => ['218687863', '227406655', '474330343', '764321776', '1008497035', '1134438881', '1159755691', '1381135736'],
        ];

        if (!array_key_exists($catId, $imageSet)) {
            return $all ? [] : null;
        }

        $catImages = $imageSet[$catId];

        if ($all) {
            $businessImage = [];
            foreach ($catImages as $key => $catImage) {
                $businessImage[] = [
                    'id' => $key,
                    'imageUrl' => sprintf(
                        "%s/subCatImages/%s/%s_x_%s/shutterstock_%s.jpg",
                        config('constants.ImageCDN'),
                        $catId,
                        $width,
                        $height,
                        $catImage
                    ),
                    'title' => config("industryCategoriesConfig." . $catId . ".category_name"),
                ];
            }
            return $businessImage;
        }

        $image = $catImages[array_rand($catImages)];
        return sprintf(
            "%s/subCatImages/%s/%s_x_%s/shutterstock_%s.jpg",
            config('constants.ImageCDN'),
            $catId,
            $width,
            $height,
            $image
        );
    }
}


if (!function_exists('randomImage')) {
    function randomImage($parentCatId)
    {
        $categoryImageMap = [
            1 => ['automobile.jpg', 'automobile1.jpg', 'automobile2.jpg'],
            2 => ['fmcg.jpg', 'fmcg1.jpg', 'fmcg2.jpg'],
            3 => ['education.jpg', 'education1.jpg', 'education2.jpg'],
            4 => ['beauty.jpg', 'beauty1.jpg', 'beauty2.jpg'],
            5 => ['business.jpg', 'business1.jpg', 'business2.jpg'],
            6 => ['food.jpg', 'food1.jpg', 'food2.jpg'],
            7 => ['fashion.jpg', 'fashion1.jpg', 'fashion2.jpg'],
            8 => ['building.jpg', 'building1.jpg', 'building2.jpg'],
            9 => ['travel.jpg', 'travel1.jpg', 'travel2.jpg'],
            10 => ['entertainment.jpg', 'entertainment1.jpg', 'entertainment2.jpg'],
            11 => ['finance.jpg', 'finance1.jpg', 'finance2.jpg'],
            12 => ['energy.jpg', 'energy1.jpg', 'energy2.jpg'],
            13 => ['manufacturing.jpg', 'manufacturing1.jpg', 'manufacturing2.jpg'],
            14 => ['retail.jpg', 'retail1.jpg', 'retail2.jpg'],
        ];

        if (!array_key_exists($parentCatId, $categoryImageMap)) {
            return '';
        }

        $images = $categoryImageMap[$parentCatId];
        return $images[array_rand($images)];
    }
}


if (!function_exists('getSlugUrl')) {
    function getSlugUrl($investor, $minInvestment, $maxInvestment)
    {
        $invTitleLoc = empty($investor['inv_city'])
            ? 'India'
            : $investor['inv_city'];

        $investorTitle = sprintf(
            config('constants.InvestorTitlePattern'),
            $invTitleLoc,
            $minInvestment,
            $maxInvestment
        );

        return !empty($investor['inv_headline'])
            ? $investor['inv_headline']
            : $investorTitle;
    }
}


if (!function_exists('getAvailableProfileTypes')) {
    /**
     * Which profile types (investor/mentor/lender/startup) this user actually
     * has a profile for — determined from user_profiles, the authoritative
     * registry, NOT by checking existence in profile_investors/etc directly
     * (those can carry leftover/unrelated rows).
     */
    function getAvailableProfileTypes($userId)
    {
        $types = ['investor', 'mentor', 'lender', 'startup', 'business'];
        $available = [];

        foreach ($types as $type) {
            $profileTypeCode = config('constants.profileTypes.' . ucfirst($type));
            $available[$type] = \App\Models\UserProfile::where('user_id', $userId)
                ->where('profile_type', $profileTypeCode)
                ->exists();
        }

        return $available;
    }
}


if (!function_exists('getUserProfileInstances')) {
    /**
     * Every individual profile this user has, per type — a user can register
     * more than one Business/Startup/Investor/etc profile, and each one needs
     * its own dropdown entry (labelled with the contact person's own name on
     * that profile — seller_name/startup_name/inv_name/mentor_name/lender_name,
     * not the company/entity name) rather than collapsing to "the type
     * exists". Queried straight from each profile_* table by user_id (not
     * user_profiles, which can carry more than one registry row per actual
     * profile).
     *
     * Only profiles with that type's own status column = Active (1) are
     * included — an awaiting/rejected/inactive registration isn't a real
     * selectable profile yet.
     *
     * Returns ['business' => [['profile_str'=>.., 'id'=>.., 'label'=>..], ...], 'startup' => [...], ...]
     * — a type key is only present if the user has at least one instance of it.
     */
    function getUserProfileInstances($userId)
    {
        $instances = [];
        $active = config('constants.ProfileStatus.Active');

        $business = \App\Models\ProfileBusiness::where('user_id', $userId)
            ->where('business_profile_status', $active)
            ->get(['business_id', 'business_profile_str', 'seller_name']);
        if ($business->isNotEmpty()) {
            $instances['business'] = $business->map(function ($row) {
                return [
                    'profile_str' => $row->business_profile_str,
                    'id' => $row->business_id,
                    'label' => $row->seller_name ?: $row->business_profile_str,
                ];
            })->all();
        }

        $startup = \App\Models\ProfileStartup::where('user_id', $userId)
            ->where('startup_profile_status', $active)
            ->get(['startup_id', 'startup_profile_str', 'startup_name']);
        if ($startup->isNotEmpty()) {
            $instances['startup'] = $startup->map(function ($row) {
                return [
                    'profile_str' => $row->startup_profile_str,
                    'id' => $row->startup_id,
                    'label' => $row->startup_name ?: $row->startup_profile_str,
                ];
            })->all();
        }

        $investor = \App\Models\ProfileInvestor::where('user_id', $userId)
            ->where('inv_profile_status', $active)
            ->get(['investor_id', 'inv_profile_str', 'inv_name']);
        if ($investor->isNotEmpty()) {
            $instances['investor'] = $investor->map(function ($row) {
                return [
                    'profile_str' => $row->inv_profile_str,
                    'id' => $row->investor_id,
                    'label' => $row->inv_name ?: $row->inv_profile_str,
                ];
            })->all();
        }

        $mentor = \App\Models\ProfileMentor::where('user_id', $userId)
            ->where('mentor_profile_status', $active)
            ->get(['mentor_id', 'mentor_profile_str', 'mentor_name']);
        if ($mentor->isNotEmpty()) {
            $instances['mentor'] = $mentor->map(function ($row) {
                return [
                    'profile_str' => $row->mentor_profile_str,
                    'id' => $row->mentor_id,
                    'label' => $row->mentor_name ?: $row->mentor_profile_str,
                ];
            })->all();
        }

        $lender = \App\Models\ProfileLender::where('user_id', $userId)
            ->where('lender_profile_status', $active)
            ->get(['lender_id', 'lender_profile_str', 'lender_name']);
        if ($lender->isNotEmpty()) {
            $instances['lender'] = $lender->map(function ($row) {
                return [
                    'profile_str' => $row->lender_profile_str,
                    'id' => $row->lender_id,
                    'label' => $row->lender_name ?: $row->lender_profile_str,
                ];
            })->all();
        }

        return $instances;
    }
}


if (!function_exists('isProfileTypeActivated')) {
    /**
     * A profile type is activated when BOTH:
     * - user_profiles.profile_status = 1 for that type, AND
     * - the profile-specific table's own ..._profile_status = 1.
     */
    function isProfileTypeActivated($userId, $profileType)
    {
        $profileTypeCode = config('constants.profileTypes.' . ucfirst($profileType));

        $isUserProfileActive = \App\Models\UserProfile::where('user_id', $userId)
            ->where('profile_type', $profileTypeCode)
            ->where('profile_status', 1)
            ->exists();

        $isSpecificProfileActive = false;

        switch ($profileType) {
            case 'business':
                $profile = \App\Models\ProfileBusiness::where('user_id', $userId)->first();
                $isSpecificProfileActive = !empty($profile) && (int) $profile->business_profile_status === 1;
                break;
            case 'mentor':
                $profile = \App\Models\ProfileMentor::where('user_id', $userId)->first();
                $isSpecificProfileActive = !empty($profile) && (int) $profile->mentor_profile_status === 1;
                break;
            case 'lender':
                $profile = \App\Models\ProfileLender::where('user_id', $userId)->first();
                $isSpecificProfileActive = !empty($profile) && (int) $profile->lender_profile_status === 1;
                break;
            case 'startup':
                $profile = \App\Models\ProfileStartup::where('user_id', $userId)->first();
                $isSpecificProfileActive = !empty($profile) && (int) $profile->startup_profile_status === 1;
                break;
            case 'investor':
            default:
                $profile = \App\Models\ProfileInvestor::where('user_id', $userId)->first();
                $isSpecificProfileActive = !empty($profile) && (int) $profile->inv_profile_status === 1;
                break;
        }

        return $isUserProfileActive && $isSpecificProfileActive;
    }
}


if (!function_exists('getProfileSocialLinks')) {
    /**
     * Facebook / LinkedIn / Twitter links for the given user's currently
     * active profile type, pulled from that profile-specific table (the
     * social columns aren't named consistently across types — see below).
     * Falls back to user_account.facebook_id / linkedin_id when the active
     * profile has nothing of its own (business/lender don't have their own
     * social columns at all, so they always fall back to these).
     *
     * Returns ['facebook' => url|null, 'linkedin' => url|null, 'twitter' => url|null].
     */
    function getProfileSocialLinks($userId, $profileType)
    {
        $links = ['facebook' => null, 'linkedin' => null, 'twitter' => null];

        switch ($profileType) {
            case 'startup':
                $profile = \App\Models\ProfileStartup::where('user_id', $userId)->first();
                if ($profile) {
                    $links['facebook'] = $profile->facebook_profile ?: null;
                    $links['linkedin'] = $profile->linkedin_profile ?: null;
                    $links['twitter'] = $profile->twitter_profile ?: null;
                }
                break;
            case 'mentor':
                $profile = \App\Models\ProfileMentor::where('user_id', $userId)->first();
                if ($profile) {
                    $links['linkedin'] = $profile->mentor_linkedin ?: null;
                }
                break;
            case 'lender':
                // profile_lenders has no social columns of its own.
                break;
            case 'business':
                // profile_business has no social columns of its own.
                break;
            case 'investor':
            default:
                $profile = \App\Models\ProfileInvestor::where('user_id', $userId)->first();
                if ($profile) {
                    $links['linkedin'] = $profile->linkedin_profile ?: null;
                }
                break;
        }

        // Fallback to the account-level fields (used by business/lender,
        // which have no social columns of their own, and as a catch-all for
        // any other type whose profile-specific field is empty).
        if (empty($links['facebook']) || empty($links['linkedin'])) {
            $account = \App\Models\UserAccount::find($userId);
            if ($account) {
                if (empty($links['facebook'])) {
                    $links['facebook'] = $account->facebook_id ?: null;
                }
                if (empty($links['linkedin'])) {
                    $links['linkedin'] = $account->linkedin_id ?: null;
                }
            }
        }

        // Normalize to an absolute URL so an anchor tag doesn't treat a
        // scheme-less value ("linkedin.com/in/foo") as a relative link.
        foreach ($links as $key => $url) {
            if ($url && !preg_match('#^https?://#i', $url)) {
                $links[$key] = 'https://' . ltrim($url, '/');
            }
        }

        return $links;
    }
}


if (!function_exists('getAvailableStatesFromCities')) {
    /**
     * Only the states that actually have at least one city in bx_cities —
     * used to populate a State dropdown whose City dropdown is driven by
     * bx_cities, so every state offered actually has cities behind it
     * (bx_cities is sparse: only a handful of states are populated, while
     * config('constants.statesIndia') lists every Indian state).
     */
    function getAvailableStatesFromCities()
    {
        $stateNames = \App\Models\BxCity::query()
            ->select('state')
            ->whereNotNull('state')
            ->distinct()
            ->pluck('state');

        $codeByName = array_flip(config('constants.statesIndia'));

        return $stateNames
            ->mapWithKeys(function ($name) use ($codeByName) {
                $code = $codeByName[$name] ?? $name;
                return [$code => $name];
            })
            ->sort();
    }
}


if (!function_exists('getTopRecommendationAddOnProfiles')) {
    /**
     * Profile ids (for the given profile type) who have an active "Top
     * Recommendations" paid add-on (profile_memberships.membership_type = 502).
     * Ported from CommonController::getTopRecommendationAddOnProfiles().
     */
    function getTopRecommendationAddOnProfiles($profileType)
    {
        return \App\Models\ProfileMembership::query()
            ->select('profile_id')
            ->where('profile_type', $profileType)
            ->where('membership_type', 502)
            ->where('is_active', '=', config('constants.ProfileStatus.Active'))
            ->orderBy('membership_id', 'desc')
            ->get()
            ->pluck('profile_id')
            ->toArray();
    }
}