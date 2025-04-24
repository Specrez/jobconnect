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
            echo "<script>alert('Request submitted successfully!');</script>";
            echo "<script>window.location.href='fields.php';</script>";
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
    <title>JobConnect | Request New Field</title>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="employee.css" rel="stylesheet">
    <link href="fieldreq.css" rel="stylesheet">
</head>
<body>
    <!-- Main Header -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="#" class="brand-logo">
                    <span class="icon">💼</span>
                    <span>JobConnect</span>
                </a>
            </div>
            
            <nav class="nav-links">
                <a href="employeehome.php" class="nav-link active">Dashboard</a>
                <a href="joblist.php" class="nav-link">Posted Jobs</a>
            </nav>
            
            <div class="user-actions">
                
                <div class="user-profile">
                    <a link href="acc.php" class="profile-link" title="My Account">
                    <div class="profile-avatar">
                        <span style="font-size:1.1rem;">
                            <?php echo strtoupper(substr($_SESSION['name'] ?? 'G', 0, 1)); ?>
                        </span>
                    </div>
                    </a>
                    <div style="font-weight:600;">
                        <?php echo htmlspecialchars($_SESSION['name'] ?? 'Guest'); ?>
                    </div>
                </div>
                <a href="../login/logout.php" class="nav-link" style="color: #ff4444; margin-left: 1rem;">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="breadcrumbs">
            <a href="employeehome.php">Dashboard</a>
            <span>/</span>
            <a href="fields.php">Job Fields</a>
            <span>/</span>
            <span>Request New Field</span>
        </div>

        <div class="page-header">
            <h1 class="page-title">Request New Job Field</h1>
            <p class="page-subtitle">Submit a request to add a new job field to our platform</p>
        </div>

        <div class="form-container">
            <form method="post" class="field-request-form">
                <div class="form-group">
                    <label for="field_name">Field Name</label>
                    <input type="text" id="field_name" name="field_name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="6" required></textarea>
                    <p class="form-hint">Please provide a detailed description of this job field and why it should be added.</p>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='fields.php'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
