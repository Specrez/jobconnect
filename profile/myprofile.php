<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: ../login/login.php");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role'];

$conn = new mysqli("localhost", "root", "", "jobconnect");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = [];
if ($role === 'user') {
    $query = "SELECT full_name, email, address, phone_number FROM user WHERE email = '$email'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
} elseif ($role === 'company') {
    $query = "SELECT name, email, branch, address, phone_number, reg_no FROM company WHERE email = '$email'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
} else {
    echo "Invalid role.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="myprofile.css">
</head>
<body>
    <div class="container">
        <h1>My Profile</h1>
        <div class="profile-details">
            <?php if ($role === 'user'): ?>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($data['full_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($data['address'] ?? 'N/A'); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($data['phone_number'] ?? 'N/A'); ?></p>
            <?php elseif ($role === 'company'): ?>
                <p><strong>Company Name:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
                <p><strong>Branch:</strong> <?php echo htmlspecialchars($data['branch']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($data['address'] ?? 'N/A'); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($data['phone_number'] ?? 'N/A'); ?></p>
                <p><strong>Registration Number:</strong> <?php echo htmlspecialchars($data['reg_no']); ?></p>
            <?php endif; ?>
        </div>
        <div class="actions">
            <button onclick="window.location.href='../login/logout.php'">Logout</button>
            <button onclick="window.history.back()">Back</button>
        </div>
    </div>
</body>
</html>
