<?php
require '../connect.php';
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

// Get parameters
$application_id = isset($_GET['application_id']) ? intval($_GET['application_id']) : 0;
$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($application_id === 0 || !in_array($type, ['resume', 'cover_letter'])) {
    die("Invalid request");
}

// Fetch file path from database
$column = $type === 'resume' ? 'resume_path' : 'cover_letter_path';
$query = "SELECT $column FROM job_applications WHERE application_id = $application_id";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    die("File not found");
}

$row = mysqli_fetch_assoc($result);
$file_path = '../customer/' . $row[$column]; // Add customer directory to path

// Validate file exists
if (!file_exists($file_path)) {
    die("File not found on server: " . $file_path);
}

// Get file information
$file_name = basename($file_path);
$file_size = filesize($file_path);
$file_type = mime_content_type($file_path);

// Set headers for download
header('Content-Type: ' . $file_type);
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . $file_size);
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: public');

// Output file content
readfile($file_path);
exit();
