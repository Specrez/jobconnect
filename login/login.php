<?php
session_start();
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

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

        $query = "SELECT * FROM `$table` WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if ($password === $user['password']) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $role;

                // Add user's name and other details to session
                if ($role === 'user') {
                    $_SESSION['name'] = $user['full_name'] ?? 'User'; // Fetch 'full_name' from the 'user' table
                    header("Location: ../customer/customerhome.php");
                    exit();
                } elseif ($role === 'company') {
                    $_SESSION['company_name'] = $user['name']; // Fetch 'name' from the 'company' table
                    $_SESSION['branch'] = $user['branch']; // Fetch 'branch' from the 'company' table
                    $_SESSION['reg_no'] = $user['reg_no']; // Fetch 'reg_no' from the 'company' table
                    $_SESSION['name'] = $user['name']; // Use 'name' as the display name for the company
                    header("Location: ../employee/employeehome.php");
                    exit();
                } elseif ($role === 'admin') {
                    $_SESSION['name'] = $user['name'] ?? 'Admin'; // Fetch 'name' from the 'admin' table
                    header("Location: admin_dashboard.php");
                    exit();
                }
            } else {
                $loginError = "Invalid password.";
            }
        } else {
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
    <title>JobConnect - Find Your Dream Job</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="branding">
            <div class="logo">JobConnect</div>
            <h1 class="tagline">Connect with your dream career opportunity</h1>
            <p class="description">
                JobConnect helps job seekers find their ideal positions and enables companies to discover top talent efficiently.
            </p>
            <div class="feature-list">
                <div class="feature"><span class="feature-icon">✓</span><span>Thousands of job listings</span></div>
                <div class="feature"><span class="feature-icon">✓</span><span>Direct application to top companies</span></div>
                <div class="feature"><span class="feature-icon">✓</span><span>Smart matching with relevant positions</span></div>
            </div>
        </div>

        <div class="login-area">
            <div class="login-container">
                <div id="roleSelection">
                    <div class="login-header">
                        <h2 class="login-title">Welcome to JobConnect</h2>
                        <p class="login-subtitle">Please select your account type</p>
                    </div>
                    <div class="role-options">
                        <div class="role-card" onclick="selectRole('company')">
                            <div class="role-icon">🏢</div>
                            <div class="role-name">Company</div>
                            <div class="role-desc">Post jobs & find candidates</div>
                        </div>
                        <div class="role-card" onclick="selectRole('user')">
                            <div class="role-icon">👤</div>
                            <div class="role-name">Job Seeker</div>
                            <div class="role-desc">Find & apply to jobs</div>
                        </div>
                        <div class="role-card" onclick="selectRole('admin')">
                            <div class="role-icon">⚙️</div>
                            <div class="role-name">Admin</div>
                            <div class="role-desc">Manage the platform</div>
                        </div>
                    </div>
                </div>

                <div id="loginForm" style="display: none;">
                    <div class="login-header">
                        <h2 class="login-title">Sign in to JobConnect</h2>
                        <p class="login-subtitle">Enter your credentials to access your account</p>
                    </div>

                    <div class="role-badge">
                        <span id="roleIcon">👤</span>
                        <span id="roleText">Role</span>
                    </div>

                    <?php if ($loginError): ?>
                        <div style="color:red; margin-bottom: 10px;"><?php echo $loginError; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <input type="hidden" name="role" id="hiddenRole" value="user">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="forgot-link"><a href="#">Forgot password?</a></div>
                        <button type="submit" class="login-button">Sign In</button>
                    </form>

                    <a href="signup.php">
                        <div class="signup-section">
                            <p class="signup-text">Don't have an account yet?</p>
                            <button class="signup-button" onclick="redirectToSignup()">Create Account</button>
                        </div>
                    </a>
                    <button class="back-button" onclick="goBack()">← Back to role selection</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('roleSelection').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';

            const roleLabel = {
                'company': 'Company',
                'user': 'Job Seeker',
                'admin': 'Admin'
            };
            const roleIcons = {
                'company': '🏢',
                'user': '👤',
                'admin': '⚙️'
            };

            document.getElementById('roleText').innerText = roleLabel[role];
            document.getElementById('roleIcon').innerText = roleIcons[role];
            document.getElementById('hiddenRole').value = role;

            localStorage.setItem('selectedRole', role);
        }

        function goBack() {
            document.getElementById('roleSelection').style.display = 'block';
            document.getElementById('loginForm').style.display = 'none';
        }

        function redirectToSignup() {
            const selectedRole = localStorage.getItem('selectedRole') || 'user';
            window.location.href = 'signup.php?role=' + selectedRole;
        }
    </script>
</body>
</html>
