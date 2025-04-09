<?php
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
    <title>JobConnect | Candidate Dashboard</title>
    <link href="../customer/customerhome.css" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="customerhome.php" class="brand-logo">
                    <span class="icon">💼</span>
                    <span>JobConnect</span>
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="page-header-content">
            <h1 class="page-title">Find Your Dream Employee</h1>
        </div>

        <section>
            <h2 class="section-title">Choose a Job Field</h2>
            <div class="job-grid-container">
                <div class="job-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="jobapp.php?field_id=' . urlencode($row["field_id"]) . '" class="job-card-link">';
                            echo '<div class="job-card">';
                            echo '<span class="icon-large">' . htmlspecialchars($row["field_name"]) . '</span>';
                            echo '</div></a>';
                        }
                    } else {
                        echo "<p>No job fields found.</p>";
                    }
                    ?>
                    <!-- Add New Field Card -->
                    <a href="fieldreq.php" class="job-card-link">
                        <div class="job-card add-new-field">
                            <span class="icon-large">➕ Add New Field</span>
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
