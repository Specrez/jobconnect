<?php

session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}
// Database connection
$conn = new mysqli("localhost", "root", "", "jobconnect");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch job fields from the `field` table
$sql = "SELECT field_id, field_name FROM field"; 
$result = $conn->query($sql);
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
            <span>Post New Job</span>
        </div>

        <div class="page-header">
            <h1 class="page-title">Select Job Field</h1>
            <p class="page-subtitle">Choose a field for your job posting or request a new one</p>
        </div>

        <section>
            <div class="job-grid-container-fields">
                <div class="job-grid-fields">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="jobapp.php?field_id=' . urlencode($row["field_id"]) . '" class="job-card-link">';
                            echo '<div class="action-card">';
                            echo '<div class="card-icon">🎯</div>';
                            echo '<h2>' . htmlspecialchars($row["field_name"]) . '</h2>';
                            echo '<p>Click to post a job in this field</p>';
                            echo '</div></a>';
                        }
                    } else {
                        echo "<p>No job fields found.</p>";
                    }
                    ?>
                    <a href="fieldreq.php" class="job-card-link">
                        <div class="action-card add-new-field">
                            <div class="card-icon">➕</div>
                            <h2>Add New Field</h2>
                            <p>Request a new job field to be added</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

</body>
</html>

<?php
$conn->close();
?>
