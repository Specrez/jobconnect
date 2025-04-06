<?php
$con = new mysqli("localhost", "root", "", "jobconnect");

if (isset($_POST['submit'])) {
    $job_role = $_POST['job_role'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $requirements = $_POST['requirements'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    // Insert the data into the database (Fixed table name syntax)
    $sql = "INSERT INTO job (job_role, location, phone, salary, requirements, description, deadline) 
            VALUES ('$job_role', '$location', '$phone', '$salary', '$requirements', '$description', '$deadline')";
    
    $result = mysqli_query($con, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Candidate Dashboard</title>
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
                <a href="customerhome.html" class="nav-link active">Dashboard</a>
                <a href="#" class="nav-link">My Jobs</a>
                <a href="#" class="nav-link">Applications</a>
                <a href="#" class="nav-link">Messages</a>
            </nav>
            
            <div class="user-actions">
                <button class="icon-button notification-badge">
                    <span>🔔</span>
                    <span class="badge">3</span>
                </button>
                
                <button class="icon-button">
                    <span>🔖</span>
                </button>
                
                <div class="user-profile">
                    <div class="profile-avatar">JD</div>
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
