<?php
session_start();

$loginError = '';
$loginSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Debug output
    error_log("Login attempt - Email: $email, Role: $role");

    $conn = new mysqli("localhost", "root", "", "jobconnect");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $table = '';
    if ($role === 'user') {
        $table = 'user';
    } elseif ($role === 'company') {
        $table = 'company';
    } elseif ($role === 'admin') {
        $table = 'admin';
    }

    if ($table !== '') {
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Debug the SQL query
        $query = "SELECT * FROM `$table` WHERE email = '$email'";
        error_log("SQL Query: " . $query);

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            error_log("User found in database");

            // Debug password verification
            error_log("Stored password: " . $user['password']);
            
            // Check if the password is stored as a hash
            if (strlen($user['password']) > 40) {
                // Password is hashed
                $passwordValid = password_verify($password, $user['password']);
            } else {
                // Password is stored in plain text (temporary for testing)
                $passwordValid = ($password === $user['password']);
            }

            if ($passwordValid) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $role;

                if ($role === 'user') {
                    $_SESSION['name'] = $user['full_name'] ?? 'User';
                    header("Location: ../customer/customerhome.php");
                } elseif ($role === 'company') {
                    $_SESSION['name'] = $user['name'] ?? 'Company';
                    $_SESSION['company_name'] = $user['name'] ?? 'Company';
                    $_SESSION['branch'] = $user['branch'] ?? '';
                    $_SESSION['reg_no'] = $user['reg_no'] ?? '';
                    header("Location: ../employee/employeehome.php");
                } elseif ($role === 'admin') {
                    $_SESSION['name'] = $user['name'] ?? 'Admin';
                    header("Location: ../admin/home.php");
                }
                exit();
            } else {
                error_log("Password verification failed");
                $loginError = "Invalid password.";
            }
        } else {
            error_log("No user found with email: $email in table: $table");
            $loginError = "User not found.";
        }
    } else {
        $loginError = "Invalid role selected.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>JobConnect - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <!-- Left side - Banner -->
        <div class="banner">
            <div class="logo">JobConnect</div>
            <h1 class="tagline">Welcome Back!</h1>
            <p class="description">Sign in to access your account and explore opportunities.</p>
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <div>Access your personalized dashboard</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <div>Track your applications</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <div>Connect with employers</div>
                </div>
            </div>
        </div>

        <!-- Right side - Login area -->
        <div class="login-area">
            <div class="login-container">
                <!-- Role selection screen -->
                <div id="roleSelection">
                    <div class="login-header">
                        <h2 class="login-title">Sign in to JobConnect</h2>
                        <p class="login-subtitle">Select your account type</p>
                    </div>
                    <div class="role-selection">
                        <div class="role-option" onclick="selectRole('user')">
                            <div class="role-icon">👤</div>
                            <div class="role-name">Job Seeker</div>
                            <div class="role-desc">Find your dream job</div>
                        </div>
                        <div class="role-option" onclick="selectRole('company')">
                            <div class="role-icon">🏢</div>
                            <div class="role-name">Company</div>
                            <div class="role-desc">Post jobs & find talent</div>
                        </div>
                        <div class="role-option" onclick="selectRole('admin')">
                            <div class="role-icon">⚙️</div>
                            <div class="role-name">Admin</div>
                            <div class="role-desc">Manage the platform</div>
                        </div>
                    </div>
                    <div class="signup-link">
                        Don't have an account? <a href="signup.php">Create Account</a>
                    </div>
                </div>

                <!-- Login form -->
                <div id="loginForm" class="login-form">
                    <div class="login-header">
                        <h2 class="login-title">Welcome Back!</h2>
                        <p class="login-subtitle">Enter your credentials to continue</p>
                    </div>

                    <div class="selected-role" id="selectedRole">
                        <span id="roleIcon">👤</span>
                        <span id="roleName">Job Seeker</span>
                    </div>

                    <?php if ($loginError): ?>
                        <div class="error-message"><?php echo $loginError; ?></div>
                    <?php elseif ($loginSuccess): ?>
                        <div class="success-message"><?php echo $loginSuccess; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <input type="hidden" name="role" id="roleInput" value="">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot your password?</a>
                        </div>
                        <button type="submit" class="login-button">Sign In</button>
                    </form>

                    <button class="back-button" onclick="goBack()">
                        <span class="back-arrow">←</span> Back to role selection
                    </button>

                    <div class="signup-link">
                        Don't have an account? <a href="signup.php">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('roleSelection').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('roleInput').value = role;

            const roleLabels = {
                'user': { name: 'Job Seeker', icon: '👤' },
                'company': { name: 'Company', icon: '🏢' },
                'admin': { name: 'Admin', icon: '⚙️' }
            };

            document.getElementById('roleIcon').innerText = roleLabels[role].icon;
            document.getElementById('roleName').innerText = roleLabels[role].name;
        }

        function goBack() {
            document.getElementById('roleSelection').style.display = 'block';
            document.getElementById('loginForm').style.display = 'none';
        }
    </script>
</body>
</html>
