<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Models\BusinessexNewsletter;
use App\Models\ContactBusiness;
use App\Models\ContactInvestors;
use App\Models\ContactMentor;
use App\Models\ContactStartup;
use App\Models\ContentTags;
use App\Models\ContentTagsAssigned;
use App\Models\Incubator;
use App\Models\Investor;
use App\Models\Lender;
use App\Models\Mentor;
use App\Models\ProfileMembership;
use App\Models\RequestContact;
use App\Models\Seller;
use App\Models\Startup;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    const S3_BUCKET = 'https://s3.ap-south-1.amazonaws.com/businessextest';
    const IMG_CDN = 'https://media.businessex.com';
    const __TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibm";

    public static function sendTxtSms($mobileNo, $message)
    {
        $jsonData = self::_sendTextSms($mobileNo, $message);
        // If sms sending failed, log the data
        if ($jsonData['status'] == 'failure') {
            Log::alert('SMS sending Failed - CommonController : ' . $jsonData['errors'][0]['message'] . ' -- ' . $message . ' -- ' . $jsonData['errors'][0]['code'] . ' -- ' . $mobileNo);
            return response()->json(['message' => 'SMS Sending Failed', 'status' => 'failure']);
        }
        // If sms sending successful, return true
        return response()->json(['message' => 'SMS Sending successfull', 'status' => 'success']);
    }

    public static function cleanSpecialChar($string)
    {
        $specialCharacters = array(
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
        );
        foreach ($specialCharacters as $character => $replacement) {
            $string = str_replace($character, '-' . $replacement . '-', $string);
        }
        $string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
        $string = preg_replace('/^[\-]+/', '', $string);
        $string = preg_replace('/[\-]+$/', '', $string);
        $string = preg_replace('/[\-]{2,}/', ' ', $string);
        return $string;
    }

    public static function cleanSpecialCharOld($string)
    {
        $specialCharacters = array(
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
            ':' => '',
            '1' => '',
            '2' => '',
            '3' => '',
            '4' => '',
            '5' => '',
            '6' => '',
            '7' => '',
            '8' => '',
            '9' => '',
            '0' => '',
        );
        while (list($character, $replacement) = each($specialCharacters)) {
            $string = str_replace($character, '-' . $replacement . '-', $string);
        }
        $string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
        $string = preg_replace('/^[\-]+/', '', $string);
        $string = preg_replace('/[\-]+$/', '', $string);
        $string = preg_replace('/[\-]{2,}/', ' ', $string);
        return $string;
    }

    /**
     * @param $rpVal
     * @param $decimalPoints
     * @return float|string
     */
    public static function convertAmountToShort($rpVal, $decimalPoints)
    {
        if (!is_numeric($rpVal)) {
            return $rpVal;
        }
        if ($rpVal > 1000 && $rpVal < 100000) {
            $mod = round($rpVal / 1000, $decimalPoints);
            $rpVal = $mod . " Thousand";
        }
        if ($rpVal >= 100000 && $rpVal < 10000000) {
            $mod = round($rpVal / 100000, $decimalPoints);
            $rpVal = $mod . " Lakhs";
        }
        if ($rpVal >= 10000000) {
            $decimalPoints = ($decimalPoints == 0) ? 2 : $decimalPoints;
            $mod = round($rpVal / 10000000, $decimalPoints);
            $rpVal = $mod . " Crores";
        }
        return $rpVal;
    }

    public static function UserUniqRandomStr()
    {
        $uniqId = mt_rand(5, 150000000);
        $chkExists = User::query()->where('user_rand_id', $uniqId)->get()->first();
        if (empty($chkExists)) {
            return $uniqId;
        }
        return self::UserUniqRandomStr();
    }

    public static function profileUniqueStr()
    {
        $uniqStr = strtolower(str_random(6));
        $chkExists = UserProfile::query()->where('profile_str', $uniqStr)->get()->first();
        if (empty($chkExists)) {
            return strtolower($uniqStr);
        }
        return self::profileUniqueStr();
    }


    /**
     * @param $imagePath
     * @param $imagePic
     * @return mixed
     * Upload file on AWS
     */
    public static function imageUploadPost($imagePath, $imagePic)
    {
        Storage::disk('s3')->put($imagePath, file_get_contents($imagePic), 'public');
        $imagePath = $imagePath;//Storage::disk('s3')->url($imagePath);
        return $imagePath;
    }

    /**
     * @param $startupDetails
     * @return string
     */
    public static function getSeekingString($startupDetails)
    {
        $seekingStr = "";
        if ($startupDetails['seeking_investors'] == 1)
            $seekingStr = "Investment" . ",";
        if ($startupDetails['seeking_acquirers'] == 1)
            $seekingStr .= "Buyer" . ",";
        if ($startupDetails['seeking_loan'] == 1)
            $seekingStr .= "Lender" . ",";
        if ($startupDetails['seeking_mentorship'] == 1)
            $seekingStr .= "Mentorship" . ",";
        if ($startupDetails['seeking_incubators'] == 1)
            $seekingStr .= "Incubation" . ",";
        return $seekingStr;
    }

    /**
     * @param $investorDetails
     * @return array
     */
    public static function getInvestmentRange($investorDetails)
    {
        $minInvestment = 0;
        $maxInvestment = 0;
        if ($investorDetails['invest_pref'] == 1 && $investorDetails['full_acquisition'] == 1) {
            $minInvestment = $investorDetails['invest_size_min'];
            $maxInvestment = $investorDetails['invest_size_max'];
        }
        if ($investorDetails['invest_pref'] == 1 && $investorDetails['full_acquisition'] == 0) {
            $minInvestment = $investorDetails['invest_size_min'];
            $maxInvestment = $investorDetails['invest_size_max'];
        }
        if ($investorDetails['invest_pref'] == 0 && $investorDetails['full_acquisition'] == 1) {
            $minInvestment = $investorDetails['purchase_capacity_min'];
            $maxInvestment = $investorDetails['purchase_capacity_max'];
        }
        $minInvestment = self::convertAmountToShort($minInvestment, 0);
        $maxInvestment = self::convertAmountToShort($maxInvestment, 0);
        return array($minInvestment, $maxInvestment);
    }

    /**
     * @param $investorDetails
     * @return string
     */
    public static function getInvestmentPreference($investorDetails)
    {
        $investmentPref = '';
        if ($investorDetails['full_acquisition'] == 1 && $investorDetails['invest_pref'] == 0)
            $investmentPref = 'Acquisition';

        if ($investorDetails['invest_pref'] == 1 && $investorDetails['full_acquisition'] == 0)
            $investmentPref = 'Investment';

        if ($investorDetails['invest_pref'] == 1 && $investorDetails['full_acquisition'] == 1)
            $investmentPref = 'Investment / Acquisition';
        return $investmentPref;
    }

    /**
     * @param $sellerDetails
     * @return string
     */
    public static function getAskingPrice($sellerDetails, $isAsking = false)
    {
        $askingPrice = 'NA';
        // priority of showing asking price as per profile
        if (isset($sellerDetails['business_profile_str'])) {
            if ($sellerDetails['accel_inv_req'] > 0)
                $askingPrice = $sellerDetails['accel_inv_req'];
            if ($sellerDetails['loan_amount'] > 0)
                $askingPrice = $sellerDetails['loan_amount'];
            if ($sellerDetails['inv_asking_price'] > 0)
                $askingPrice = $sellerDetails['inv_asking_price'];
            if ($sellerDetails['buyer_sell_price'] > 0)
                $askingPrice = $sellerDetails['buyer_sell_price'];
        } else {
            if ($sellerDetails['accel_inv_req'] > 0)
                $askingPrice = $sellerDetails['accel_inv_req'];
            if ($sellerDetails['buyer_sell_price'] > 0)
                $askingPrice = $sellerDetails['buyer_sell_price'];
            if ($sellerDetails['loan_amount'] > 0)
                $askingPrice = $sellerDetails['loan_amount'];
            if ($sellerDetails['inv_asking_price'] > 0)
                $askingPrice = $sellerDetails['inv_asking_price'];
        }

        if ($isAsking) {
            return $askingPrice;
        }
        $askingPrice = self::convertAmountToShort($askingPrice, 0);
        return $askingPrice;
    }

    public static function randomImage($parentCatId)
    {
        $catImage = "";
        if ($parentCatId == 1) {
            $imageArray = array("automobile.jpg", "automobile1.jpg", "automobile2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 2) {
            $imageArray = array("fmcg.jpg", "fmcg1.jpg", "fmcg2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 3) {
            $imageArray = array("education.jpg", "education1.jpg", "education2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 4) {
            $imageArray = array("beauty.jpg", "beauty1.jpg", "beauty2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 5) {
            $imageArray = array("business.jpg", "business1.jpg", "business2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }

        if ($parentCatId == 6) {
            $imageArray = array("food.jpg", "food1.jpg", "food2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 7) {
            $imageArray = array("fashion.jpg", "fashion1.jpg", "fashion2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 8) {
            $imageArray = array("building.jpg", "building1.jpg", "building2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 9) {

            $imageArray = array("travel.jpg", "travel1.jpg", "travel2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 10) {
            $imageArray = array("entertainment.jpg", "entertainment1.jpg", "entertainment2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }
        if ($parentCatId == 11) {
            $imageArray = array("finance.jpg", "finance1.jpg", "finance2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];
        }

        if ($parentCatId == 12) {
            $imageArray = array("energy.jpg", "energy1.jpg", "energy2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];

        }
        if ($parentCatId == 13) {

            $imageArray = array("manufacturing.jpg", "manufacturing1.jpg", "manufacturing2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];

        }
        if ($parentCatId == 14) {
            $imageArray = array("retail.jpg", "retail1.jpg", "retail2.jpg");
            $randomImage = array_rand($imageArray);
            $catImage = $imageArray[$randomImage];

        }
        return $catImage;
    }

    /**
     * @param $investor
     * @param $minInvestment
     * @param $maxInvestment
     * @return string
     */
    public static function getSlugUrl($investor, $minInvestment, $maxInvestment)
    {
        $invTitleLoc = (empty($investor['inv_city'])) ? 'India' : $investor['inv_city'];
        $investorTitle = sprintf(config('constants.InvestorTitlePattern'), $invTitleLoc, $minInvestment, $maxInvestment);
        return (!empty($investor['inv_headline'])) ? $investor['inv_headline'] : $investorTitle;
    }

    /**
     * @param $contentType
     * @param $contentId
     * @return array
     */
    public static function getContentTags($contentType, $contentId = 0)
    {
        $tagQuery = ContentTagsAssigned::query()
            ->select(['content_tags.tag_name', 'content_tags.tag_slug', 'content_tags_assigned.created_at'])
            ->join('content_tags', 'content_tags_assigned.tag_id', '=', 'content_tags.tag_id')
            ->where('content_tags_assigned.content_type', '=', $contentType)
            ->orderBy('content_tags_assigned.assigned_id', 'desc');
        if ($contentId !== 0) {
            $tagQuery->where('content_tags_assigned.content_id', '=', $contentId);
        } else {
            $tagQuery->groupBy(['content_tags_assigned.tag_id']);
        }
        $tags = $tagQuery->get();
        if (empty($tags)) {
            return [];
        }
        return $tags->toArray();
    }

    /**
     * @param $tagSlug
     * @param $contentType
     * @return array
     */
    public static function getContentIds($tagSlug, $contentType)
    {
        $articleIds = [];
        $articles = ContentTags::query()
            ->select(['content_tags_assigned.content_id'])
            ->join('content_tags_assigned', 'content_tags.tag_id', '=', 'content_tags_assigned.tag_id')
            ->where('content_tags.tag_slug', '=', $tagSlug)
            ->where('content_tags_assigned.content_type', '=', $contentType)
            ->get();
        if (!empty($articles)) {
            $articleIds = $articles->map(function ($item) {
                return $item['content_id'];
            })->toArray();
        }
        return $articleIds;
    }

    /**
     * @param $sellerDetails
     * @param $BusinessType
     * @return string
     */
    public static function getBusinessAskingPrice($sellerDetails, $BusinessType)
    {
        if ($BusinessType === '') {
            return self::getAskingPrice($sellerDetails, true);
        }
        $askingPrice = 'NA';
        if ($BusinessType === 'sale' || $BusinessType === 'Buyer') {
            $askingPrice = $sellerDetails['buyer_sell_price'];
        }
        if ($BusinessType === 'investment' || $BusinessType === 'Investor') {
            $askingPrice = $sellerDetails['inv_asking_price'];
        }
        if ($BusinessType === 'seeking-loan' || $BusinessType === 'Loan') {
            $askingPrice = $sellerDetails['loan_amount'];
        }
        if ($BusinessType === 'Incubators') {
            $askingPrice = $sellerDetails['accel_inv_req'];
        }

        return $askingPrice;
    }

    /**
     * @param $BusinessType
     * @return string
     */
    public static function getPriceLabel($BusinessType)
    {
        $label = 'Asking Price';
        if ($BusinessType === 'Investor' || $BusinessType === 'investment' || $BusinessType === 'Incubators') {
            $label = 'Seeking Investment';
        }
        if ($BusinessType === 'Loan' || $BusinessType === 'seeking-loan') {
            $label = 'Seeking Loan';
        }
        if ($BusinessType === 'Mentorship') {
            $label = 'Seeking Mentor';
        }

        return $label;
    }

    public static function priceLabelStartup($startupDetails)
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

    public static function priceLabelBusiness($startupDetails)
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

    public static function randomSubCategoryImage($catId, $width, $height, $all = false)
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
            35  => ['74757589','87781027','141582367','209940766','362877266'],
            36  => ['605684882','633964913','1113082205','1248693943','1315533044','1337296190'],
            38  => ['123704254','552097078','604328939','700226077','785109361','1017025384'],
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
            58  => ['94265785','214882000','342812459','548073523','1194000805'],
            59  => ['314848592','631086410'],
            60  => ['328908710','589482089','797334520','1197034852','1252038760','1348479263'],
            61  => ['88399243','91519085','213040195','250261546','269516258','354650093','522019972'],
            64 => ['318507608', '340152863', '419180689', '739402477', '793078339'],
            65 => ['251497315', '387334384', '661113826', '725359189', '1147852502'],
            66 => ['289585190', '523768063', '531055792', '560271130', '1113163970'],
            68 => ['223094107', '387792820', '575376397', '727853458', '1012270636'],
            69 => ['197455220', '636925537', '1016554156', '1023938740', '1026002596'],
            71 => ['378771547', '496840360', '566475787', '619110806', '767796808', '1016363545', '1086491852'],
            72  => ['278339894','583881439','588029498','645219262','1067991896'],
            77  => ['417293194','436545799','447486787','532153939','686184610','786090865','1043951605'],
            78 => ['519831238', '542082373', '576886780', '674435491', '1119754646'],
            79  => ['576896977','633781313','741451888','1161800287','1224274198'],
            81  => ['107373092','273407585','296001509','1172384449','1177721674','1342257614'],
            82 => ['175786871', '177503219', '258525938', '423062023', '532057639', '540240925'],
            83  => ['120771937','285401129','452900215','529030204','652234435','746650405','1070794775','1239599536'],
            85 => ['233716384', '397927255', '412311502', '548152279', '648758689', '1017688327', '1034790034'],
            86 => ['116283283', '390162811', '403868707', '1059811571', '1095464813'],
            87  => ['429084724','713581222','1028020777','1155622726'],
            88  => ['106561970','546271222','685264144','1066788122','1121600516'],
            89  => ['580329337'],
            90 => ['165923525', '416661100', '436506028', '536476165', '649457611', '725256820', '791111584'],
            112 => ['342898208', '348324008', '428220508', '572748772', '617005082'],
            119  => ['406517023','617507069','686844292','719895307','755350933','1028135884','1132500290'],
            120  => ['89038666','266676788','267265577','442157047','520615606','601129751'],
            121  => ['276651353','318088739','533130643','547466125','622788116','1178362387','1346057183'],
            122  => ['80777629','380243965','761907310','761908033','1150690232','1161308839'],
            124  => ['209979001','422167549','753671818','1050808202','1263761995','1312529225','1327245395'],
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
            187  => ['195723311','681770029','763670857','1155563959','1175962528','1214344126','1316947328'],
            188  => ['155487029','555705742','625208228','644231245','1046280247','1066788122','1188498334'],
            189  => ['20633581','523682233','528466828','577056808','590265665','663070918'],
            190  => ['143926126','146829527','154195253','254033098','344329640','560104441'],
            191  => ['512210','107196662','502002541','1096671455','1141482818'],
            193  => ['103678202','370005596','559380220','639063613','654331657','709149532','1315034813'],
            194  => ['524101153','553614883','581765149','653068420','1320609341','1349267699'],
            195  => ['149570927','164603351','171240113','192997676','307491971'],
            199  => ['118200196','429638932','620311622','1115404901','1127090882'],
            207 => ['167093621', '276104912', '510718735', '1011759940', '1099091780', '1129551926'],
            210 => ['136149383', '212871865', '242575054', '269021891', '361444571'],
            236 => ['228188542', '518617552', '598918634', '604036076', '619567010'],
            241 => ['125411825', '144583085', '381212158', '392387443', '1027181617'],
            244 => ['500436901', '497743579', '721777969', '347420135', '537788836'],
            243  => ['273592568','530792194','609243434','707662543','775221112','1020143272'],
            246  => ['132961508','293337704','471059489','589577570','746209546','781514284'],
            247  => ['42862789','99756866','489209362','570140890','1070369402','1148840183'],
            250  => ['227849809','289730621','592981166','695996026','1018551961'],
            251  => ['299049458','403306198','526625740','1024967245','1247122546'],
            252  => ['218687863','227406655','474330343','764321776','1008497035','1134438881','1159755691','1381135736'],
        ];

        if (!array_key_exists($catId, $imageSet)) {
            return ($all) ? [] : NULL;
        }
        $catImages = $imageSet[$catId];
        if ($all) {
            $businessImage = [];
            foreach ($catImages as $key => $catImage) {
                $imgDataArr = ['id' => $key, 'imageUrl' => sprintf("%s/subCatImages/%s/%s_x_%s/shutterstock_%s.jpg",config('constants.ImageCDN'), $catId, $width, $height, $catImage),
                    'title' => config("industryCategoriesConfig." . $catId . ".category_name")];
                array_push($businessImage, $imgDataArr);
            }
            return $businessImage;
        }
        $image = $catImages[array_rand($catImages)];
        return sprintf("%s/subCatImages/%s/%s_x_%s/shutterstock_%s.jpg",config('constants.ImageCDN'), $catId, $width, $height, $image);
    }

    /**
     * @param $mobileNo
     * @param $message
     * @return mixed
     */
    public static function _sendTextSms($mobileNo, $message)
    {
        $userName = urlencode(config('txtlocal.username')); // Username
        $apiKey = urlencode(config('txtlocal.apiKey')); // Hash
        $sender = urlencode(config('txtlocal.sender'));
        $message = rawurlencode($message);
        // Prepare data for POST request
        $data = "username=" . $userName . "&hash=" . $apiKey . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $mobileNo;
        // Send the POST request with cURL
        $ch = curl_init(config('txtlocal.apiUrl'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        // Process your response here
        $jsonData = json_decode($response, true);
        return $jsonData;
    }

    public function updateProfileViewCount(Request $request)
    {
        $profileType = $request->input('profileType');
        $profileString = $request->input('profileString');

        if (empty($profileString) || empty($profileString)) {
            return response(array('code' => 404, 'message' => 'No records found'), 404);
        }

        if ($profileType == config('constants.profileTypes.Business')) {
            Seller::query()->where('business_profile_str', $profileString)->increment('mailer_campaign');
        }

        if ($profileType == config('constants.profileTypes.Startup')) {
            Startup::query()->where('startup_profile_str', $profileString)->increment('mailer_campaign');
        }
        return response(array('code' => 200, 'message' => 'Count Update'), 200);

    }

    /**
     * @param $seller
     * @return string
     */
    public static function getSellerLocation($seller)
    {
        $sellersState = config('constants.statesIndia.' . $seller['ofc_state']);
        $location = $seller['ofc_city'] . ',  ' . $seller['ofc_state'];
        if ($sellersState) {
            $location = $seller['ofc_city'] . ',  ' . $sellersState;
        }
        return $location;
    }

    public static function subscribeNewsLetter($lastInsertId, $email)
    {
        $exist = BusinessexNewsletter::query()->where('email', $email);
        if ($exist->count() > 0) {
            $data = $exist->get()->first();
            // newsletter subscription applied, but either pending or unsubscribe
            if ($data->status == 'P' || $data->status == 'U') {
                $exist->update(['status' => 'S']);
                self::sendingSubscription($email);
            }
        } else {
            $newsletter = new BusinessexNewsletter();
            $newsletter->user_id = $lastInsertId;
            $newsletter->email = $email;
            $newsletter->status = 'P';
            $newsletter->save();
        }
    }

    /**
     * @param $email
     */
    public static function sendingSubscription($email, $method = 'AddSubscriberToList')
    {
        $site = '868';
        $xml = '<xmlrequest>
               <username>ebdotcom</username>
               <usertoken>945667f87b2fde2a8957e1ccbb16d7980d434e85</usertoken>
               <requesttype>subscribers</requesttype>
               <requestmethod>' . $method . '</requestmethod>
               <details>
               <emailaddress>' . $email . '</emailaddress>
               <mailinglist>' . $site . '</mailinglist>
               <format>html</format>
               <confirmed>yes</confirmed>
               <customfields>
               </customfields>
               </details>
             </xmlrequest>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://mailer.franchiseindia.com/emailmarketer/xml.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
        $ch_result = curl_exec($ch);
        curl_close($ch);
    }

    public function checkSubscription($email)
    {
        $emailId = base64_decode($email);
        $status = BusinessexNewsletter::query()->select(['status'])->where('email', $emailId)->first();
        if (empty($status) || $status->status == 'P') {
            return response()->json(['status' => 0, 'message' => 'You have not subscribe for newsletter']);
        }
        if ($status->status == 'U') {
            return response()->json(['status' => 0, 'message' => 'You have already unsubscribed']);
        }
        return response()->json(['status' => 1, 'message' => '']);
    }

    public function unsubscribeNewsletter(Request $request)
    {
        BusinessexNewsletter::query()->select(['status'])->where('email', $request->email)
            ->update(['status' => 'U', 'unsubscribe_reason' => $request->reason]);

        self::sendingSubscription($request->email, 'DeleteSubscriber');
        return response()->json(['status' => 1, 'message' => 'You have been unsubscribed successfully']);
    }

    public static function verifyNewsletterSubscription($email)
    {
        $email = base64_decode($email);
        if (empty($email)) {
            return response()->json(['status' => 0, 'message' => 'Invalid Url']);
        }
        $status = BusinessexNewsletter::query()->select(['status'])->where('email', $email)->first();
        if (empty($status)) {
            return response()->json(['status' => 0, 'message' => 'You have not subscribe for newsletter']);
        }
        if ($status->status == 'S') {
            return response()->json(['status' => 0, 'message' => 'You have already subscribed']);
        }
        if ($status->status == 'U') {
            return response()->json(['status' => 0, 'message' => 'Invalid Url']);
        }
        BusinessexNewsletter::query()->select(['status'])->where('email', $email)
            ->update(['status' => 'S']);
        self::sendingSubscription($email);
        return response()->json(['status' => 0, 'message' => 'You have been subscribed successfully']);

    }

    /**
     * Contacts done by a user in single day
     * @param $userId
     * @return int
     */
    public static function getProfileContactCount($userId)
    {
        $date = date('Y-m-d');
        $business = ContactBusiness::query()->where('user_id', $userId)
            ->where('created_at', 'LIKE', '%' . $date . '%')->count();
        $startup = ContactStartup::query()->where('user_id', $userId)
            ->where('created_at', 'LIKE', '%' . $date . '%')->count();
        $mentor = ContactMentor::query()->where('user_id', $userId)
            ->where('created_at', 'LIKE', '%' . $date . '%')->count();
        $investor = ContactInvestors::query()->where('user_id', $userId)
            ->where('created_at', 'LIKE', '%' . $date . '%')->count();

        return $business + $startup + $mentor + $investor;
    }

    /**
     * Contacts done by a user in single day
     * @param $userId
     * @return int
     */
    public static function getTotalProfileContactCount($userId)
    {
        $business = ContactBusiness::query()->where('user_id', $userId)->count();
        $startup = ContactStartup::query()->where('user_id', $userId)->count();
        $mentor = ContactMentor::query()->where('user_id', $userId)->count();
        $investor = ContactInvestors::query()->where('user_id', $userId)->count();

        return $business + $startup + $mentor + $investor;
    }

    public function checkAndUpdateLastLogin($status)
    {

        if ($status == 1) {
            $recordsReceiver = RequestContact::query()->select('receiver', 'updated_at')
                ->where('status', '!=', '1')
                ->orderBy('request_id', 'asc')
                ->distinct('receiver')
                ->get()
                ->pluck('updated_at', 'receiver');

            echo "Updating Receiver Last login <br>";
            $this->_updateLastLogin($recordsReceiver);
        } elseif ($status == 2) {
            $recordsSender = RequestContact::query()->select('sender', 'created_at')
                ->orderBy('request_id', 'asc')
                ->distinct('sender')
                ->get()
                ->pluck('created_at', 'sender');

            echo "Updating Sender Last login <br>";
            $this->_updateLastLogin($recordsSender);
        } elseif ($status == 3) {
            $recordsPayment = ProfileMembership::query()->select('user_id', 'created_at')
                ->orderBy('membership_id', 'asc')
                ->distinct('user_id')
                ->get()
                ->pluck('created_at', 'user_id');

            echo "Updating Payment Last login <br>";
            $this->_updateLastLogin($recordsPayment);
        } elseif ($status == 4) {
            $recordsContactBusiness = ContactBusiness::query()->select('profile_id', 'created_at')
                ->where('contact_viewed', '1')
                ->orderBy('contact_id', 'asc')
                ->distinct('profile_id')
                ->get()
                ->pluck('created_at', 'profile_id');
            echo "Updating Contact Business Last login <br>";
            $this->_updateLastLogin($recordsContactBusiness);

        } elseif ($status == 5) {
            $recordsContactInvestor = ContactInvestors::query()->select('profile_id', 'created_at')
                ->where('contact_viewed', '1')
                ->orderBy('contact_id', 'asc')
                ->distinct('profile_id')
                ->get()
                ->pluck('created_at', 'profile_id');
            echo "Updating Contact Investor Last login <br>";
            $this->_updateLastLogin($recordsContactInvestor);
        } elseif ($status == 6) {
            $recordsContactMentors = ContactMentor::query()->select('profile_id', 'created_at')
                ->where('contact_viewed', '1')
                ->orderBy('contact_id', 'asc')
                ->distinct('profile_id')
                ->get()
                ->pluck('created_at', 'profile_id');
            echo "Updating Contact Mentors Last login <br>";
            $this->_updateLastLogin($recordsContactMentors);
        } elseif ($status == 7) {
            $recordsContactMentors = ContactStartup::query()->select('profile_id', 'created_at')
                ->where('contact_viewed', '1')
                ->orderBy('contact_id', 'asc')
                ->distinct('profile_id')
                ->get()
                ->pluck('created_at', 'profile_id');
            echo "Updating Contact Mentors Last login <br>";
            $this->_updateLastLogin($recordsContactMentors);
        }
    }

    /**
     * @param $recordsSender
     */
    private function _updateLastLogin($recordsSender)
    {
        foreach ($recordsSender as $user_id => $lastLogin) {
            $lastLogin = date('Y-m-d H:i:s', strtotime($lastLogin));
            $user0 = User::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user1 = Seller::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user2 = Investor::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user3 = Mentor::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user4 = Lender::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user5 = Incubator::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user6 = Broker::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $user7 = Startup::query()->where('user_id', $user_id)->where('last_login_at', '<', $lastLogin)->update(['last_login_at' => $lastLogin]);
            $sum = $user0 + $user1 + $user2 + $user3 + $user4 + $user5 + $user6 + $user7;
            echo $user_id . '=' . $sum . '/8';
            echo "<br>";
        }
    }
    public static function getCampaignSource($campaign)
    {
        $campaign = strtolower($campaign);
        $source = [
            'website' =>1,
            'facebook' =>2,
            'linkedin' =>3,
            'google' =>4,
            'twitter' =>5,
            'dotnet' =>6,
            'dotcom' =>7,
            'business insider' =>8,
            'delhishow' =>9,
            'eb' =>11,
            'economictimes' =>12,
            'emailer' =>13,
            'socialorganic' =>14,
            'linkedinpromocode' =>15,
            'banner' =>16,
            'popup' =>17,
            'ABPNews' =>19,
            'Timesnow' =>20,
            'TheHindu' =>21,
            'ManormalOnline' =>22,
            'AMNETNewsCluster' =>23,
            'HT' =>24,
            'LiveMint' =>25,
            'LiveHindustan' =>26,
            'GoogleDisplayNetwork ' =>27,
            'Whatsapp' =>28,
            'SMS' =>29,
        ];
        if (isset($source[$campaign])) {
            return $source[$campaign];
        }
        return 1;
    }


    /**
     * @param $profileType
     * @return array
     */
    public static function getTopRecommendationAddOnProfiles($profileType)
    {
        $paidProfileIds = ProfileMembership::query()
            ->select('profile_id')
            ->where('profile_type', $profileType)
            ->where('membership_type', 502)
            ->where('is_active', '=', config('constants.ProfileStatus.Active'))
            ->orderBy('membership_id', 'desc')
            ->get()
            ->pluck('profile_id')
            ->toArray();
        return $paidProfileIds;
    }

    public function getAddOnConfig()
    {
        return response()->json([
            'addOnCharges' => [
                501=>config('constants.addOnProfileView'),
                502=>config('constants.addOnTopRecommendation'),
                503=>config('constants.addOnInteraction'),
                504=>config('constants.addOnInstaResponse'),
                505=>config('constants.addOnAcceleratedMarketing'),
                506=>config('constants.addOnTopBuyerSeller'),
            ]
        ]);

    }

    /*public function getDbConfig()
    {
        return response()->json([
            'addOnCharges' => [
                'dbN'=>env('DB_DATABASE'),
                'dbU'=>env('DB_USERNAME'),
                'dbP'=>env('DB_PASSWORD'),
            ]
        ]);

    }*/


}
