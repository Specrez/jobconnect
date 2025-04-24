<?php
require '../connect.php';
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

if (isset($_GET['job_id'])) {
    $job_id = intval($_GET['job_id']);
    $company_name = mysqli_real_escape_string($con, $_SESSION['name'] ?? '');

    // First, verify that the job belongs to the company
    $verify_query = "SELECT job_id FROM job WHERE job_id = '$job_id' AND company_name = '$company_name'";
    $result = mysqli_query($con, $verify_query);

    if (mysqli_num_rows($result) > 0) {
        // Delete related applications first
        $delete_applications = "DELETE FROM job_applications WHERE job_id = '$job_id'";
        mysqli_query($con, $delete_applications);

        // Then delete the job
        $delete_job = "DELETE FROM job WHERE job_id = '$job_id'";
        
        if (mysqli_query($con, $delete_job)) {
            echo "<script>
                    alert('Job deleted successfully');
                    window.location.href='joblist.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error deleting job: " . mysqli_error($con) . "');
                    window.location.href='joblist.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Unauthorized access or job not found');
                window.location.href='joblist.php';
              </script>";
    }
} else {
    header("Location: joblist.php");
}
?>
