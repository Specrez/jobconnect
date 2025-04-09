<?php
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
            echo "Field request approved and added to the system.";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'reject' && $request_id) {
        echo "Field request rejected.";
    } else {
        echo "Invalid action or missing parameters.";
    }

    $conn->close();
}
?>
