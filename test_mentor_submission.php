<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "============================================================\n";
echo "MENTOR PROFILE FORM SUBMISSION TEST\n";
echo "============================================================\n\n";

// Step 1: Get the form to extract CSRF token
echo "[1] Fetching form page...\n";
$form_url = 'http://127.0.0.1:8000/registration/create-mentor-profile';
$response = @file_get_contents($form_url);

if (!$response) {
    echo "    ERROR: Could not fetch form page!\n";
    exit(1);
}

// Extract CSRF token
if (preg_match('/name="_token" value="([^"]+)"/', $response, $matches)) {
    $csrf_token = $matches[1];
    echo "    CSRF Token found: " . substr($csrf_token, 0, 20) . "...\n";
} else {
    echo "    ERROR: Could not find CSRF token!\n";
    exit(1);
}

// Step 2: Submit the form
echo "\n[2] Submitting mentor profile form...\n";
$test_email = 'test.mentor.' . time() . '@example.com';

$post_data = http_build_query([
    '_token' => $csrf_token,
    'mentor_name' => 'Test Mentor Final',
    'mentor_email' => $test_email,
    'mentor_mobile' => '9876543221',
    'mentor_location' => 'Delhi',
    'mentor_city' => 'Delhi',
    'mentor_adv_headline' => 'Helping founders scale',
    'mentor_intro' => 'Business mentor with experience',
    'mentor_occupation' => 'Corporate Professional',
    'mentor_company' => 'Growth Inc',
    'mentor_designation' => 'Director',
    'mentor_profile_summary' => 'Experienced in startup growth',
    'experience_years[0]' => '8',
    'sector_expertise[0]' => '17',
    'mentor_linkedin' => 'https://linkedin.com/in/testmentor'
]);

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => $post_data,
    ]
];

$context = stream_context_create($options);
$response2 = @file_get_contents($form_url, false, $context);

if ($response2 === false) {
    echo "    ERROR: POST request failed!\n";
} else {
    echo "    POST request completed\n";
    echo "    Test Email: $test_email\n";
    
    // Check for success
    if (strpos($response2, 'Mentor Profile Registration Successful') !== false) {
        echo "    ✓ SUCCESS MESSAGE FOUND IN RESPONSE\n";
    } elseif (strpos($response2, 'alert-danger') !== false) {
        echo "    ✗ ERROR FOUND IN RESPONSE\n";
        if (preg_match('/<li>([^<]+)<\/li>/', $response2, $msg)) {
            echo "    Error message: " . $msg[1] . "\n";
        }
    } else {
        echo "    ? Response unclear (no success or error message found)\n";
    }
}

// Step 3: Query database
echo "\n[3] Checking database...\n";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=businessex', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    $stmt = $pdo->prepare('SELECT * FROM profile_mentors WHERE mentor_email = ? ORDER BY mentor_id DESC LIMIT 1');
    $stmt->execute([$test_email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        echo "    ✓ FOUND IN DATABASE\n";
        echo "      ID: " . $row['mentor_id'] . "\n";
        echo "      Name: " . $row['mentor_name'] . "\n";
        echo "      Email: " . $row['mentor_email'] . "\n";
        echo "      Status: " . $row['mentor_profile_status'] . "\n";
        echo "      Created: " . $row['created_at'] . "\n";
        
        // Check for related records
        $expStmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM profile_mentor_prof_exp WHERE mentor_profile_id = ?');
        $expStmt->execute([$row['mentor_id']]);
        $expRow = $expStmt->fetch();
        echo "      Experience rows: " . $expRow['cnt'] . "\n";
    } else {
        echo "    ✗ NOT FOUND IN DATABASE\n";
    }
} catch (Exception $e) {
    echo "    ERROR: Database query failed: " . $e->getMessage() . "\n";
}

echo "\n============================================================\n";
if ($row) {
    echo "✓ MENTOR PROFILE SUBMISSION SUCCESSFUL!\n";
    echo "  Email: $test_email\n";
} else {
    echo "✗ MENTOR PROFILE NOT FOUND IN DATABASE\n";
    echo "  Email was: $test_email\n";
}
echo "============================================================\n";
?>
