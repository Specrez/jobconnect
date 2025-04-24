<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $request_id = $_POST['request_id'] ?? '';
    $field_name = $_POST['field_name'] ?? '';

    $conn = new mysqli("localhost", "root", "", "jobconnect");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($action === 'approve' && $request_id && $field_name) {
        $field_name = $conn->real_escape_string($field_name);

        // Insert into the field table
        $query = "INSERT INTO field (field_name) VALUES ('$field_name')";
        if ($conn->query($query) === TRUE) {
            // Update the status in the field_req table
            $update_query = "UPDATE field_req SET status = 'approved' WHERE field_id = $request_id";
            $conn->query($update_query);
            echo "Field request approved and added to the system.";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'reject' && $request_id) {
        // Update the status in the field_req table
        $update_query = "UPDATE field_req SET status = 'rejected' WHERE field_id = $request_id";
        if ($conn->query($update_query) === TRUE) {
            echo "Field request rejected.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid action or missing parameters.";
    }

    $conn->close();
}
?>
