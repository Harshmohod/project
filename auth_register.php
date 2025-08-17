<?php
session_start();
header('Content-Type: application/json');

// Allow only POST
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/config.php';

// Read JSON or form-encoded input
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    $data = $_POST; // fallback for classic form posts
}

$fullName = trim($data['full_name'] ?? $data['Fullname'] ?? '');
$userName = trim($data['user_name'] ?? $data['Username'] ?? '');
$email    = trim($data['email'] ?? $data['Email'] ?? '');
$password = (string)($data['password'] ?? '');
$phone    = trim($data['phone'] ?? $data['phone_number'] ?? '');
$state    = trim($data['state'] ?? $data['State'] ?? '');
$city     = trim($data['city'] ?? $data['City'] ?? '');
$region   = trim($data['region'] ?? $data['Region'] ?? '');

if ($fullName === '' || $userName === '' || $email === '' || $password === '' || $phone === '' || $state === '' || $city === '' || $region === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Check duplicates
try {
    $checkStmt = $mysqli->prepare('SELECT id FROM account_details WHERE Username = ? OR Email = ? LIMIT 1');
    if (!$checkStmt) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error (prepare duplicate check): ' . $mysqli->error]);
        exit;
    }
    $checkStmt->bind_param('ss', $userName, $email);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'Username or Email already exists']);
        $checkStmt->close();
        exit;
    }
    $checkStmt->close();
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error (duplicate check): ' . $e->getMessage()]);
    exit;
}

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

try {
    $stmt = $mysqli->prepare('INSERT INTO account_details (Fullname, Username, Email, Password, phone_number, State, City, Region) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error (prepare insert): ' . $mysqli->error]);
        exit;
    }

    $stmt->bind_param('ssssssss', $fullName, $userName, $email, $passwordHash, $phone, $state, $city, $region);
    $ok = $stmt->execute();

    if (!$ok) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $stmt->error]);
        $stmt->close();
        exit;
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error (insert): ' . $e->getMessage()]);
    exit;
}

$userId = $stmt->insert_id;
$stmt->close();

$_SESSION['user_id'] = $userId;
$_SESSION['username'] = $userName;
$_SESSION['email'] = $email;

echo json_encode([
    'success' => true,
    'message' => 'Account created successfully',
    'user' => [
        'id' => $userId,
        'username' => $userName,
        'email' => $email,
    ],
]);


