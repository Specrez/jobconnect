<?php
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Candidate Dashboard</title>
    <link href="../assets/css/main.css" rel="stylesheet">
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
                <a href="customerhome.html" class="nav-link active">Dashboard</a>
                <a href="#" class="nav-link">My Jobs</a>
                <a href="#" class="nav-link">Applications</a>
                <a href="#" class="nav-link">Messages</a>
            </nav>
            
            <div class="user-actions">
                <button class="icon-button notification-badge">
                    <span>🔔</span>
                    <span class="badge">3</span>
                </button>
                
                <button class="icon-button">
                    <span>🔖</span>
                </button>
                
                <div class="user-profile">
                    <div class="profile-avatar">
                    </div>
                    <div>
                        <?php echo htmlspecialchars($_SESSION['name'] ?? 'Guest'); ?> <!-- Display logged-in user's name -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Find Your Dream Job</h1>
                <p class="page-subtitle">Discover job opportunities matching your skills and preferences</p>
            </div>
        </div>

        <!-- Job Listings -->
        <section>
            <div class="section-header">
                <h2 class="section-title"></h2>
            </div>
            
            <div class="job-grid-container">
                <div class="job-grid">
                    <a href="fields.php">
                        <div class="job-card">
                            <div class="job-card-placeholder">
                                <span class="icon-large"><h1>Add Job</h1></span>
                            </div>
                        </div>
                    </a>
                    <a href="joblist.php">
                    <div class="job-card">
                        <div class="job-card-placeholder">
                            <span class="icon-large"><h1>View Jobs</h1></span>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3 class="footer-title">For Candidates</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Browse Jobs</a>
                        <a href="#" class="footer-link">Career Resources</a>
                        <a href="#" class="footer-link">Salary Calculator</a>
                        <a href="#" class="footer-link">Resume Builder</a>
                        <a href="#" class="footer-link">Job Alerts</a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">For Employers</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Post a Job</a>
                        <a href="#" class="footer-link">Talent Search</a>
                        <a href="#" class="footer-link">Pricing Plans</a>
                        <a href="#" class="footer-link">Recruitment Solutions</a>
                        <a href="#" class="footer-link">Employer Resources</a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Company</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">About Us</a>
                        <a href="#" class="footer-link">Our Team</a>
                        <a href="#" class="footer-link">Careers</a>
                        <a href="#" class="footer-link">Press</a>
                        <a href="#" class="footer-link">Contact Us</a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Support</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Help Center</a>
                        <a href="#" class="footer-link">FAQs</a>
                        <a href="#" class="footer-link">Privacy Policy</a>
                        <a href="#" class="footer-link">Terms of Service</a>
                        <a href="#" class="footer-link">Cookie Policy</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div>© 2025 JobConnect. All rights reserved.</div>
                
                <div class="social-links">
                    <a href="#" class="social-icon">f</a>
                    <a href="#" class="social-icon">t</a>
                    <a href="#" class="social-icon">in</a>
                    <a href="#" class="social-icon">ig</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>