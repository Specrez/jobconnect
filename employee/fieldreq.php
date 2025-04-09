<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field_name = $_POST['field_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $company = $_SESSION['company_name'] ?? '';
    $branch = $_SESSION['branch'] ?? '';
    $reg_no = $_SESSION['reg_no'] ?? '';

    if ($field_name && $description && $company && $branch && $reg_no) {
        $conn = new mysqli("localhost", "root", "", "jobconnect");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $field_name = mysqli_real_escape_string($conn, $field_name);
        $description = mysqli_real_escape_string($conn, $description);

        $query = "INSERT INTO field_req (field_name, description, company, branch, reg_no, date) 
                  VALUES ('$field_name', '$description', '$company', '$branch', '$reg_no', NOW())";

        if ($conn->query($query) === TRUE) {
            echo "Field request submitted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Apply for Job</title>
    <link rel="stylesheet" href="../customer/uploadcv.css">
</head>
<body>
    <!-- Main Header -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="#" class="brand-logo">
                    <div class="icon">💼</div>
                    <span>JobConnect</span>
                </a>
            </div>
            
            <nav class="nav-links">
                <a href="#" class="nav-link">Dashboard</a>
                <a href="#" class="nav-link">Browse Jobs</a>
                <a href="#" class="nav-link active">Apply</a>
                <a href="#" class="nav-link">My Applications</a>
            </nav>
            
            <div class="user-actions">
                <button class="icon-button notification-badge">
                    <span>🔔</span>
                    <span class="badge">2</span>
                </button>
                
                <button class="icon-button">
                    <span>🔖</span>
                </button>
                
                <div class="user-profile">
                    <div class="profile-avatar">JS</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        
        <!-- Application Form -->
        <div class="application-form-container">
            <h2 class="form-title">Request for a Field</h2>
            
            <form id="jobApplicationForm" action="#" method="post" enctype="multipart/form-data">
                <!-- Information Section -->
                <div class="form-section">
                    <h3 class="section-title">Required Field Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="field_name" class="form-label required">Field Name</label>
                            <input type="text" id="field_name" name="field_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="description" class="form-label required">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back to Jobs</button>
                    <button type="submit" class="btn btn-primary">Request Admin</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
