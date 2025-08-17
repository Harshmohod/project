<?php
// Database connection configuration
// Update credentials if your MySQL setup is different

$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'land_registration_db';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
	headers_sent() ?: header('Content-Type: application/json');
	echo json_encode([
		'success' => false,
		'message' => 'Database connection failed: ' . $mysqli->connect_error,
	]);
	exit;
}

// Ensure proper charset
$mysqli->set_charset('utf8mb4');
?>


