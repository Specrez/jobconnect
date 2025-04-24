<?php
require '../connect.php';
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

$email = $_SESSION['email'];
$success_message = '';
$error_message = '';

// Fetch company details
$query = "SELECT * FROM company WHERE email = '$email' LIMIT 1";
$result = mysqli_query($con, $query);
if (!$result) {
    $error_message = "Database error: " . mysqli_error($con);
    $company = null;
} else {
    $company = mysqli_fetch_assoc($result);
    if (!$company) {
        $error_message = "No company data found for this account.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $branch = mysqli_real_escape_string($con, $_POST['branch']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        
        // Update company information
        $update_query = "UPDATE company SET 
                        name = '$name',
                        branch = '$branch',
                        address = '$address',
                        phone_number = '$phone'
                        WHERE email = '$email'";
        
        if (mysqli_query($con, $update_query)) {
            $success_message = "Profile updated successfully!";
            $result = mysqli_query($con, $query);
            $company = mysqli_fetch_assoc($result);
        } else {
            $error_message = "Error updating profile: " . mysqli_error($con);
        }
    }

    if (isset($_POST['change_password'])) {
        $current_password = mysqli_real_escape_string($con, $_POST['current_password']);
        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
        
        // Verify current password
        $password_query = "SELECT password FROM company WHERE email = '$email'";
        $password_result = mysqli_query($con, $password_query);
        $password_row = mysqli_fetch_assoc($password_result);
        
        if (password_verify($current_password, $password_row['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $password_update = "UPDATE company SET password = '$hashed_password' WHERE email = '$email'";
                
                if (mysqli_query($con, $password_update)) {
                    $success_message = "Password updated successfully!";
                } else {
                    $error_message = "Error updating password: " . mysqli_error($con);
                }
            } else {
                $error_message = "New passwords do not match!";
            }
        } else {
            $error_message = "Current password is incorrect!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | My Account</title>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="employee.css" rel="stylesheet">
    <link href="acc.css" rel="stylesheet">
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
                <a href="employeehome.php" class="nav-link ">Dashboard</a>
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
            <span>My Account</span>
        </div>

        <div class="account-container">
            <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div class="alert alert-error"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="account-header">
                <div class="company-avatar">
                    <?php echo $company ? strtoupper(substr($company['name'], 0, 1)) : 'C'; ?>
                </div>
                <h1><?php echo $company ? htmlspecialchars($company['name']) : 'Company Name Not Found'; ?></h1>
                <p class="company-reg">Reg No: <?php echo $company ? htmlspecialchars($company['reg_no']) : 'Not Available'; ?></p>
            </div>

            <form method="post" class="account-form">
                <div class="form-section">
                    <h2>Company Information</h2>
                    
                    <div class="form-group">
                        <label for="name">Company Name</label>
                        <input type="text" id="name" name="name" 
                               value="<?php echo $company ? htmlspecialchars($company['name']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <input type="text" id="branch" name="branch" 
                               value="<?php echo $company ? htmlspecialchars($company['branch']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" 
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" 
                               value="<?php echo $company ? htmlspecialchars($company['phone_number']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3"><?php echo $company ? htmlspecialchars($company['address']) : ''; ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>

            <form method="post" class="account-form">
                <div class="form-section">
                    <h2>Change Password</h2>
                    
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="change_password" class="btn btn-secondary">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
