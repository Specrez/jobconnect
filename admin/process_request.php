<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access - Admin only");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $request_id = intval($_POST['request_id'] ?? 0);
    $field_name = trim($_POST['field_name'] ?? '');

    $conn = new mysqli("localhost", "root", "", "jobconnect");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        if ($action === 'approve' && $field_name) {
            $field_name = $conn->real_escape_string($field_name);
            
            // Check if field already exists
            $check = $conn->query("SELECT field_id FROM field WHERE field_name = '$field_name'");
            if ($check->num_rows > 0) {
                throw new Exception("Field already exists");
            }

            // Insert new field
            if (!$conn->query("INSERT INTO field (field_name) VALUES ('$field_name')")) {
                throw new Exception("Failed to add field");
            }

            // Update request status
            if (!$conn->query("UPDATE field_req SET status = 'approved' WHERE field_id = $request_id")) {
                throw new Exception("Failed to update request status");
            }

            $conn->commit();
            echo "Field request approved successfully";

        } elseif ($action === 'reject') {
            if (!$conn->query("UPDATE field_req SET status = 'rejected' WHERE field_id = $request_id")) {
                throw new Exception("Failed to reject request");
            }
            
            $conn->commit();
            echo "Field request rejected successfully";
        }

    } catch (Exception $e) {
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }

    $conn->close();
}
?>
