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

if (isset($_POST['submit'])) {
    // Get form data
    $job_role = $_POST['job_role'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $requirements = $_POST['requirements'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    // Get company details from session
    $company_name = $_SESSION['company_name'] ?? null;
    $branch = $_SESSION['branch'] ?? null;
    $reg_no = $_SESSION['reg_no'] ?? null;

    // Validate session variables
    if (!$company_name || !$branch || !$reg_no) {
        echo "<script>alert('Session variables are missing. Please log in again.');</script>";
        exit();
    }

    // Validate company details using prepared statements
    $stmt = $con->prepare("SELECT * FROM company WHERE name = ? AND branch = ? AND reg_no = ?");
    $stmt->bind_param("sss", $company_name, $branch, $reg_no);
    $stmt->execute();
    $company_check_result = $stmt->get_result();

    if ($company_check_result->num_rows > 0) {
        // Insert into job table
        $stmt = $con->prepare("INSERT INTO job (job_field, job_role, company_name, branch, reg_no, location, phone, salary, requirements, description, deadline) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssss", $field_id, $job_role, $company_name, $branch, $reg_no, $location, $phone, $salary, $requirements, $description, $deadline);
        $result = $stmt->execute();

        if ($result) {
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
    <title>JobConnect | Employee Dashboard</title>
    <link href="../assets/css/main.css" rel="stylesheet">
</head>
<body>
    <!-- Main Header -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="employeehome.php" class="brand-logo">
                    <span class="icon">💼</span>
                    <span>JobConnect</span>
                </a>
            </div>
            
            <nav class="nav-links">
                <a href="customerhome.html" class="nav-link active">Dashboard</a>
                <a href="#" class="nav-link">My Jobs</a>
                <a href="#" class="nav-link">Applications</a>
                <a href="#" class="nav-link">Messages</a>
            </nav>
            
            <div class="user-actions">
                <div class="user-profile">
                    <div class="profile-avatar">
                    </div>
                    <?php echo htmlspecialchars($_SESSION['name'] ?? 'Guest'); ?> <!-- Display logged-in user's name -->
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Find Your Dream Employee</h1>
        <p class="page-subtitle">Fill the form given below to post your job</p>
        
        <form method="post"> <!-- Fixed: Added method="post" -->
            <div class="form-group">
                <label>Job Role</label>
                <input type="text" name="job_role" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Salary</label>
                <input type="text" name="salary" required>
            </div>
            <div class="form-group">
                <label>Job Requirements</label>
                <textarea name="requirements" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Job Description</label>
                <textarea name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Application Deadline</label>
                <input type="date" name="deadline" required>
            </div>
            <button type="submit" name="submit" class="submit-btn">Post Job</button> <!-- Fixed: Added name="submit" -->
        </form>
    </div>
</body>
</html>
