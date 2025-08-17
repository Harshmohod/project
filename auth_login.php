<?php
session_start();
header('Content-Type: application/json');

if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/config.php';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    $data = $_POST;
}

$identifier = trim($data['email'] ?? $data['username'] ?? ''); // can be email or username
$password   = (string)($data['password'] ?? '');

if ($identifier === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email/Username and password are required']);
    exit;
}

// Fetch user by email or username
$stmt = $mysqli->prepare('SELECT id, Username, Email, Password FROM account_details WHERE Email = ? OR Username = ? LIMIT 1');
$stmt->bind_param('ss', $identifier, $identifier);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    exit;
}

if (!password_verify($password, $user['Password'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    exit;
}

$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['username'] = $user['Username'];
$_SESSION['email'] = $user['Email'];

echo json_encode([
    'success' => true,
    'message' => 'Login successful',
    'user' => [
        'id' => (int)$user['id'],
        'username' => $user['Username'],
        'email' => $user['Email'],
        'user_type' => 'user'
    ]
]);


