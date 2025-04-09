<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login/login.php");
    exit();
}

// Disable caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once "../connect.php";
$email = $_SESSION['email'];
$query = "SELECT * FROM `user` WHERE email = '$email'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user details.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | My Profile</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="customerhome.php" class="brand-logo">
                    <div class="icon">💼</div>
                    <span>JobConnect</span>
                </a>
            </div>
            <nav class="nav-links">
                <a href="customerhome.php" class="nav-link">Home</a>
                <a href="#" class="nav-link">Browse Jobs</a>
                <a href="#" class="nav-link">My Applications</a>
                <a href="account.php" class="nav-link active">Profile</a>
            </nav>
            <div class="user-actions">
                <button class="icon-button notification-badge">
                    <span>🔔</span>
                    <span class="badge">2</span>
                </button>
                <div class="user-profile">
                    <div class="profile-avatar">
                        <?php echo isset($_SESSION['email']) ? substr($_SESSION['email'], 0, 2) : 'G'; ?>
                    </div>
                    <div class="profile-dropdown">
                        <a href="account.php" class="dropdown-item">My Profile</a>
                        <a href="#" class="dropdown-item logout" onclick="confirmLogout()">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="user-id">ID: <?php echo $user['userid']; ?></div>
                <div class="profile-pic"><?php echo strtoupper(substr($user['full_name'], 0, 2)); ?></div>
                <h1><?php echo $user['full_name']; ?></h1>
                <p><?php echo $user['email']; ?></p>
            </div>
            
            <div class="profile-body">
                <div class="detail-group">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value"><?php echo $user['full_name']; ?></div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value"><?php echo $user['email']; ?></div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Address</div>
                    <div class="detail-value"><?php echo $user['address']; ?></div>
                </div>
                
                <div class="detail-group">
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value"><?php echo $user['phone_number']; ?></div>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-secondary">Change Password</button>
                <button class="btn btn-primary">Edit Profile</button>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../login/logout.php";
            }
        }

        document.querySelector('.user-profile').addEventListener('click', function (e) {
            e.stopPropagation();
            this.querySelector('.profile-dropdown').classList.toggle('active');
        });

        document.addEventListener('click', function () {
            const dropdown = document.querySelector('.profile-dropdown');
            if (dropdown && dropdown.classList.contains('active')) {
                dropdown.classList.remove('active');
            }
        });
    </script>
</body>
</html>