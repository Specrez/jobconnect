<?php
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

$con = new mysqli("localhost", "root", "", "jobconnect");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$field_id = isset($_GET['field_id']) ? intval($_GET['field_id']) : 0;

// Fetch field name
$field_name = '';
$field_query = "SELECT field_name FROM field WHERE field_id = '$field_id'";
$field_result = $con->query($field_query);
if ($field_result && $field_result->num_rows > 0) {
    $field_row = $field_result->fetch_assoc();
    $field_name = htmlspecialchars($field_row['field_name']);
}

if (isset($_POST['submit'])) {
    // Get form data and escape strings
    $job_role = mysqli_real_escape_string($con, $_POST['job_role']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $requirements = mysqli_real_escape_string($con, $_POST['requirements']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $deadline = mysqli_real_escape_string($con, $_POST['deadline']);

    // Get company details from session
    $company_name = mysqli_real_escape_string($con, $_SESSION['company_name'] ?? '');
    $branch = mysqli_real_escape_string($con, $_SESSION['branch'] ?? '');
    $reg_no = mysqli_real_escape_string($con, $_SESSION['reg_no'] ?? '');

    // Validate session variables
    if (!$company_name || !$branch || !$reg_no) {
        echo "<script>alert('Session variables are missing. Please log in again.');</script>";
        exit();
    }

    // Validate company details
    $company_check_query = "SELECT * FROM company WHERE name='$company_name' AND branch='$branch' AND reg_no='$reg_no'";
    $company_check_result = $con->query($company_check_query);

    if ($company_check_result->num_rows > 0) {
        // Insert into job table
        $insert_query = "INSERT INTO job (job_field, job_role, company_name, branch, reg_no, location, phone, salary, requirements, description, deadline) 
                        VALUES ('$field_id', '$job_role', '$company_name', '$branch', '$reg_no', '$location', '$phone', '$salary', '$requirements', '$description', '$deadline')";
        
        if ($con->query($insert_query)) {
            echo "<script>alert('Job posted successfully!');</script>";
        } else {
            echo "<script>alert('Failed to post job. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid company details. Please contact support.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Post New Job</title>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="employee.css" rel="stylesheet">
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
            <span>Post New Job</span>
        </div>

        <div class="page-header">
            <h1 class="page-title">Create New Job Posting</h1>
            <p class="page-subtitle">
                 <h2><?php echo $field_name; ?></h2>
            </p>
        </div>

        <div class="form-container">
            <form method="post" class="job-post-form">
                <div class="form-group">
                    <label for="job_role">Job Role</label>
                    <input type="text" id="job_role" name="job_role" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" id="salary" name="salary" required>
                </div>

                <div class="form-group">
                    <label for="requirements">Job Requirements</label>
                    <textarea id="requirements" name="requirements" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Job Description</label>
                    <textarea id="description" name="description" rows="6" required></textarea>
                </div>

                <div class="form-group">
                    <label for="deadline">Application Deadline</label>
                    <input type="date" id="deadline" name="deadline" required>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='fields.php'">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Post Job</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
