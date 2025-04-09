<?php
// Replace these with your actual DB credentials
$servername = "localhost";
$username = "root";
$password = ""; // your MySQL password
$dbname = "jobconnect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['full_name'])) {
        // Job Seeker signup
        $full_name = $conn->real_escape_string($_POST['full_name']);
        $email = $conn->real_escape_string($_POST['user_email']);
        $password = $conn->real_escape_string($_POST['user_password']); // Plain text
        $address = $conn->real_escape_string($_POST['user_address']);

        $sql = "INSERT INTO user (full_name, email, password, address)
                VALUES ('$full_name', '$email', '$password', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Job Seeker account created successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

    } elseif (isset($_POST['company_name'])) {
        // Company signup
        $company_name = $conn->real_escape_string($_POST['company_name']);
        $email = $conn->real_escape_string($_POST['company_email']);
        $password = $conn->real_escape_string($_POST['company_password']); // Plain text
        $branch = $conn->real_escape_string($_POST['branch']);
        $phone = $conn->real_escape_string($_POST['phone_number']);
        $reg_number = $conn->real_escape_string($_POST['register_number']);
        $address = $conn->real_escape_string($_POST['company_address']);

        $sql = "INSERT INTO company (name, email, password, branch, phone_number, reg_no, address)
                VALUES ('$company_name', '$email', '$password', '$branch', '$phone', '$reg_number', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Company account created successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <!-- Left side - Banner -->
        <div class="banner">
            <div class="logo">JobConnect</div>
            <h1 class="tagline">Start Your Journey with JobConnect Today</h1>
            <p class="description">Create your free account and join thousands of professionals connecting with opportunities worldwide.</p>
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <div>Quick and easy registration</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <div>Create custom job alerts</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <div>Connect with top employers</div>
                </div>
            </div>
        </div>

        <!-- Right side - Signup form -->
        <div class="signup-area">
            <div class="signup-container">
                <!-- Role selection screen -->
                <div id="roleSelection">
                    <div class="signup-header">
                        <h2 class="signup-title">Join JobConnect</h2>
                        <p class="signup-subtitle">Choose your account type to get started</p>
                    </div>
                    <div class="role-selection">
                        <div class="role-option" onclick="selectRole('jobseeker')">
                            <div class="role-icon">👤</div>
                            <div class="role-name">Job Seeker</div>
                            <div class="role-desc">Find your dream job</div>
                        </div>
                        <div class="role-option" onclick="selectRole('company')">
                            <div class="role-icon">🏢</div>
                            <div class="role-name">Company</div>
                            <div class="role-desc">Post jobs & find talent</div>
                        </div>
                    </div>
                    <div class="login-link">
                        Already have an account? <a href="login.php">Sign In</a>
                    </div>
                </div>

                <!-- Job Seeker Signup form -->
                <div id="jobseekerForm" class="signup-form">
                    <div class="signup-header">
                        <h2 class="signup-title">Create Job Seeker Account</h2>
                        <p class="signup-subtitle">Fill in your details to get started</p>
                    </div>
                    <div class="selected-role" id="selectedRoleJobseeker">
                        <span>👤</span>
                        <span>Job Seeker</span>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email Address</label>
                            <input type="email" name="user_email" id="user_email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" name="user_password" id="user_password" placeholder="Create a strong password" required>
                        </div>
                        <div class="form-group">
                            <label for="user_address">Address</label>
                            <input type="text" name="user_address" id="user_address" placeholder="Enter your address" required>
                        </div>
                        <div class="terms">
                            By clicking "Create Account", you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                        </div>
                        <button type="submit" class="signup-button">Create Account</button>
                    </form>
                    <button class="back-button" onclick="goBack()">
                        <span class="back-arrow">←</span> Back to role selection
                    </button>
                    <div class="login-link">
                        Already have an account? <a href="#">Sign In</a>
                    </div>
                </div>

                <!-- Company Signup form -->
                <div id="companyForm" class="signup-form">
                    <div class="signup-header">
                        <h2 class="signup-title">Create Company Account</h2>
                        <p class="signup-subtitle">Fill in your company details</p>
                    </div>
                    <div class="selected-role" id="selectedRoleCompany">
                        <span>🏢</span>
                        <span>Company</span>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" placeholder="Enter company name" required>
                        </div>
                        <div class="form-group">
                            <label for="company_email">Email Address</label>
                            <input type="email" name="company_email" id="company_email" placeholder="Enter company email" required>
                        </div>
                        <div class="form-group">
                            <label for="company_password">Password</label>
                            <input type="password" name="company_password" id="company_password" placeholder="Create a strong password" required>
                        </div>
                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <input type="text" name="branch" id="branch" placeholder="Enter company branch" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="tel" name="phone_number" id="phone_number" placeholder="Enter phone number" required>
                            </div>
                            <div class="form-group">
                                <label for="register_number">Registration Number</label>
                                <input type="text" name="register_number" id="register_number" placeholder="Enter registration number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_address">Company Address</label>
                            <input type="text" name="company_address" id="company_address" placeholder="Enter company address" required>
                        </div>
                        <div class="terms">
                            By clicking "Create Account", you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                        </div>
                        <button type="submit" class="signup-button">Create Account</button>
                    </form>
                    <button class="back-button" onclick="goBack()">
                        <span class="back-arrow">←</span> Back to role selection
                    </button>
                    <div class="login-link">
                        Already have an account? <a href="#">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle role selection
        function selectRole(role) {
            document.getElementById('roleSelection').style.display = 'none';
            if (role === 'jobseeker') {
                document.getElementById('jobseekerForm').classList.add('active');
            } else if (role === 'company') {
                document.getElementById('companyForm').classList.add('active');
            }
        }

        function goBack() {
            document.getElementById('roleSelection').style.display = 'block';
            document.getElementById('jobseekerForm').classList.remove('active');
            document.getElementById('companyForm').classList.remove('active');
        }
    </script>
</body>
</html>
