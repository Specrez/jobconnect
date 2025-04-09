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

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require_once "../connect.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and collect inputs
    $jobId = isset($_POST["jobId"]) ? intval($_POST["jobId"]) : 0;
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $currentCompany = $_POST["currentCompany"];
    $currentPosition = $_POST["currentPosition"];
    $experience = $_POST["yearsOfExperience"];
    $expectedSalary = $_POST["expectedSalary"];
    $skills = $_POST["skills"];
    $whyApplying = $_POST["whyApplying"];
    $additionalInfo = $_POST["additionalInfo"];

    // Validate job_id
    $jobCheckQuery = $con->prepare("SELECT job_id FROM job WHERE job_id = ?");
    $jobCheckQuery->bind_param("i", $jobId);
    $jobCheckQuery->execute();
    $jobCheckResult = $jobCheckQuery->get_result();

    if (!$jobCheckResult || $jobCheckResult->num_rows === 0) {
        echo "<script>alert('Invalid job ID. Please try again.'); window.history.back();</script>";
        exit();
    }

    // File upload
    $uploadDir = "uploads/";
    $resumePath = "";
    $coverLetterPath = "";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
        $resumePath = $uploadDir . time() . "_" . basename($_FILES["resume"]["name"]);
        move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath);
    }

    if (isset($_FILES["coverLetter"]) && $_FILES["coverLetter"]["error"] == 0) {
        $coverLetterPath = $uploadDir . time() . "_" . basename($_FILES["coverLetter"]["name"]);
        move_uploaded_file($_FILES["coverLetter"]["tmp_name"], $coverLetterPath);
    }

    // Insert into database
    $sql = "INSERT INTO job_applications 
        (job_id, first_name, last_name, email, phone, address, current_company, current_position, experience, expected_salary, skills, why_applying, additional_info, resume_path, cover_letter_path) 
        VALUES 
        ('$jobId', '$firstName', '$lastName', '$email', '$phone', '$address', '$currentCompany', '$currentPosition', '$experience', '$expectedSalary', '$skills', '$whyApplying', '$additionalInfo', '$resumePath', '$coverLetterPath')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Application submitted successfully!'); window.location.href = 'customerhome.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Apply for Job</title>
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
                <a href="#" class="nav-link active">Apply</a>
                <a href="account.php" class="nav-link">Profile</a>
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
    <div class="application-form-container">
      <h2 class="form-title">Submit Your Application</h2>

      <form id="jobApplicationForm" action="uploadcv.php" method="post" enctype="multipart/form-data">
        <!-- Corrected hidden input for job_id -->
        <input type="hidden" name="jobId" value="<?php echo isset($_GET['jobId']) ? htmlspecialchars($_GET['jobId']) : ''; ?>" />
        
        <div class="form-section">
          <h3 class="section-title">Personal Information</h3>
          <div class="form-row">
            <div class="form-group">
              <label for="firstName" class="form-label required">First Name</label>
              <input type="text" id="firstName" name="firstName" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="lastName" class="form-label required">Last Name</label>
              <input type="text" id="lastName" name="lastName" class="form-control" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="email" class="form-label required">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="phone" class="form-label required">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="form-control" required />
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="form-label">Current Address</label>
            <input type="text" id="address" name="address" class="form-control" />
          </div>
        </div>

        <div class="form-section">
          <h3 class="section-title">Professional Information</h3>
          <div class="form-row">
            <div class="form-group">
              <label for="currentCompany" class="form-label">Current Company</label>
              <input type="text" id="currentCompany" name="currentCompany" class="form-control" />
            </div>
            <div class="form-group">
              <label for="currentPosition" class="form-label">Current Position</label>
              <input type="text" id="currentPosition" name="currentPosition" class="form-control" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="yearsOfExperience" class="form-label required">Years of Experience</label>
              <input type="number" id="yearsOfExperience" name="yearsOfExperience" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="expectedSalary" class="form-label">Expected Salary (LKR)</label>
              <input type="text" id="expectedSalary" name="expectedSalary" class="form-control" />
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="section-title">Upload Documents</h3>
          <div class="form-group">
            <label for="resume" class="form-label required">Resume/CV</label>
            <div class="file-input-container">
              <label for="resume" class="file-input-label">
                <span class="file-input-icon">📄</span>
                <span>Choose file or drag and drop</span>
              </label>
              <input type="file" id="resume" name="resume" class="file-input" accept=".pdf,.doc,.docx" required />
            </div>
            <div class="file-name" id="resumeFileName">No file selected</div>
            <p class="form-note">Accepted formats: PDF, DOC, DOCX. Maximum size: 5MB</p>
          </div>

          <div class="form-group">
            <label for="coverLetter" class="form-label">Cover Letter (Optional)</label>
            <div class="file-input-container">
              <label for="coverLetter" class="file-input-label">
                <span class="file-input-icon">📝</span>
                <span>Choose file or drag and drop</span>
              </label>
              <input type="file" id="coverLetter" name="coverLetter" class="file-input" accept=".pdf,.doc,.docx" />
            </div>
            <div class="file-name" id="coverLetterFileName">No file selected</div>
            <p class="form-note">Accepted formats: PDF, DOC, DOCX. Maximum size: 3MB</p>
          </div>
        </div>

        <div class="form-section">
          <h3 class="section-title">Additional Information</h3>
          <div class="form-group">
            <label for="skills" class="form-label required">Key Skills</label>
            <textarea id="skills" name="skills" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="whyApplying" class="form-label required">Why are you interested in this position?</label>
            <textarea id="whyApplying" name="whyApplying" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="additionalInfo" class="form-label">Any additional information</label>
            <textarea id="additionalInfo" name="additionalInfo" class="form-control"></textarea>
          </div>
        </div>

        <div class="form-section">
          <div class="checkbox-group">
            <label class="checkbox-label">
              <input type="checkbox" name="termsConsent" required class="checkbox-input">
              <span>I agree to the Terms and Conditions and Privacy Policy</span>
            </label>
          </div>
          <div class="checkbox-group">
            <label class="checkbox-label">
              <input type="checkbox" name="dataConsent" required class="checkbox-input">
              <span>I consent to JobConnect storing and sharing my application</span>
            </label>
          </div>
          <div class="checkbox-group">
            <label class="checkbox-label">
              <input type="checkbox" name="marketingConsent" class="checkbox-input">
              <span>I'd like to receive job alerts</span>
            </label>
          </div>
        </div>

        <div class="action-buttons">
          <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back to Jobs</button>
          <button type="submit" class="btn btn-primary">Submit Application</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('resume').addEventListener('change', function (e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'No file selected';
      document.getElementById('resumeFileName').textContent = fileName;
    });
    document.getElementById('coverLetter').addEventListener('change', function (e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'No file selected';
      document.getElementById('coverLetterFileName').textContent = fileName;
    });

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
