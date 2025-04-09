/* JobConnect - Modern Enhanced UI */
:root {
  --primary-color: #4361ee;
  --primary-light: #4895ef;
  --primary-dark: #3f37c9;
  --secondary-color: #1d3557;
  --accent-color: #f72585;
  --success-color: #4cc9f0;
  --warning-color: #ffd166;
  --danger-color: #ef476f;
  --text-color: #2b2d42;
  --text-light: #6c757d;
  --bg-color: #f8f9fa;
  --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #e4e9f3 100%);
  --card-bg: #ffffff;
  --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05), 0 6px 6px rgba(0, 0, 0, 0.07);
  --card-hover-shadow: 0 14px 28px rgba(0, 0, 0, 0.15), 0 10px 10px rgba(0, 0, 0, 0.08);
  --header-shadow: 0 4px 6px rgba(0, 0, 0, 0.06);
  --border-radius: 12px;
  --button-radius: 8px;
  --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  --font-heading: 'Poppins', sans-serif;
  --font-body: 'Inter', sans-serif;
}

/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: var(--font-body);
  background: var(--bg-gradient);
  color: var(--text-color);
  line-height: 1.6;
  min-height: 100vh;
}

/* Modern Header */
.main-header {
  background-color: var(--card-bg);
  box-shadow: var(--header-shadow);
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  max-width: 1400px;
  margin: 0 auto;
}

.logo-container {
  display: flex;
  align-items: center;
}

.brand-logo {
  display: flex;
  align-items: center;
  text-decoration: none;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 1.6rem;
  background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: var(--transition);
}

.brand-logo:hover {
  transform: scale(1.05);
}

.brand-logo .icon {
  margin-right: 0.5rem;
  font-size: 1.8rem;
}

.nav-links {
  display: flex;
  gap: 2rem;
}

.nav-link {
  text-decoration: none;
  color: var(--text-color);
  font-weight: 500;
  padding: 0.5rem 0;
  position: relative;
  transition: var(--transition);
  font-size: 1.05rem;
}

.nav-link:hover {
  color: var(--primary-color);
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
  transition: var(--transition);
}

.nav-link:hover::after {
  width: 100%;
}

.nav-link.active {
  color: var(--primary-color);
}

.nav-link.active::after {
  width: 100%;
}

.user-actions {
  display: flex;
  align-items: center;
  gap: 1.2rem;
}

.icon-button {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1.3rem;
  position: relative;
  color: var(--text-color);
  transition: var(--transition);
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-button:hover {
  color: var(--primary-color);
  background-color: rgba(67, 97, 238, 0.1);
}

.notification-badge {
  position: relative;
}

.badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: linear-gradient(45deg, var(--accent-color), var(--danger-color));
  color: white;
  font-size: 0.7rem;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  box-shadow: 0 2px 5px rgba(247, 37, 133, 0.3);
}

.user-profile {
  display: flex;
  align-items: center;
  cursor: pointer;
}

.profile-avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  box-shadow: 0 3px 6px rgba(67, 97, 238, 0.2);
  transition: var(--transition);
}

.profile-avatar:hover {
  transform: scale(1.05);
  box-shadow: 0 5px 8px rgba(67, 97, 238, 0.3);
}

/* Main Content */
.main-content,
.container {
  max-width: 1400px;
  margin: 2rem auto;
  padding: 0 2rem;
}

.page-header-content {
  margin-bottom: 3rem;
  text-align: center;
  animation: fadeInUp 0.6s ease-out;
}

.page-title {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  font-weight: 700;
  background: linear-gradient(90deg, var(--primary-dark), var(--primary-light));
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1rem;
  letter-spacing: -0.02em;
}

.section-title {
  font-family: var(--font-heading);
  font-size: 1.8rem;
  font-weight: 600;
  color: var(--secondary-color);
  margin-bottom: 2rem;
  text-align: center;
  letter-spacing: -0.01em;
}

/* Enhanced Job Grid */
.job-grid-container {
  margin-top: 2rem;
  animation: fadeIn 0.8s ease-out;
}

.job-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.8rem;
}

.job-card-link {
  text-decoration: none;
  color: inherit;
  display: block;
  transition: var(--transition);
}

.job-card {
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  box-shadow: var(--card-shadow);
  padding: 1.8rem;
  transition: var(--transition);
  height: 100%;
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.job-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
  transition: var(--transition);
}

.job-card:hover {
  transform: translateY(-7px);
  box-shadow: var(--card-hover-shadow);
}

.job-card:hover::before {
  height: 7px;
}

.job-card-content {
  color: var(--text-color);
}

.job-card-content p {
  margin-bottom: 0.8rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.job-card-content p strong {
  color: var(--secondary-color);
  font-weight: 600;
  min-width: 80px;
}

.job-card-placeholder {
  text-align: center;
  color: var(--text-light);
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 3rem 1rem;
}

.job-card-placeholder::before {
  content: '🔍';
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.6;
}

.icon-large {
  font-size: 1.4rem;
  font-weight: 600;
  color: var(--secondary-color);
  transition: var(--transition);
}

/* Job Details */
.sector-banner {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-dark));
  color: white;
  padding: 2.5rem;
  border-radius: var(--border-radius) var(--border-radius) 0 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  animation: fadeIn 0.6s ease-out;
}

.sector-title {
  font-family: var(--font-heading);
  font-size: 2rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  font-weight: 600;
}

.status-badge {
  font-size: 0.8rem;
  padding: 0.4rem 1rem;
  border-radius: 50px;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  gap: 0.3rem;
}

.status-badge::before {
  content: '•';
  font-size: 1.2rem;
}

.status-active {
  background-color: rgba(76, 201, 240, 0.3);
  border: 1px solid rgba(76, 201, 240, 0.5);
}

.job-details-container {
  background-color: var(--card-bg);
  border-radius: 0 0 var(--border-radius) var(--border-radius);
  padding: 2.5rem;
  box-shadow: var(--card-shadow);
  animation: fadeInUp 0.8s ease-out;
  border: 1px solid rgba(0, 0, 0, 0.05);
  border-top: none;
}

.job-details-title {
  font-family: var(--font-heading);
  font-size: 1.8rem;
  color: var(--secondary-color);
  margin-bottom: 2rem;
  font-weight: 600;
  text-align: center;
  position: relative;
  padding-bottom: 1rem;
}

.job-details-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
  border-radius: 3px;
}

/* Enhanced Form Styles */
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.8rem;
  margin-bottom: 1.8rem;
}

.form-group {
  margin-bottom: 1.8rem;
  position: relative;
}

.form-control {
  width: 100%;
  padding: 0.9rem 1rem;
  border: 1.5px solid #e2e8f0;
  border-radius: var(--button-radius);
  font-family: var(--font-body);
  font-size: 1rem;
  color: var(--text-color);
  transition: var(--transition);
  background-color: #f8fafc;
}

.form-control:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
  background-color: white;
}

.form-control[readonly] {
  background-color: #f1f5f9;
  border-color: #e2e8f0;
  cursor: not-allowed;
}

textarea.form-control {
  min-height: 120px;
  resize: vertical;
}

.form-label {
  display: block;
  margin-bottom: 0.6rem;
  font-weight: 500;
  color: var(--secondary-color);
}

.form-label.required::after {
  content: ' *';
  color: var(--accent-color);
}

.form-note {
  font-size: 0.85rem;
  color: var(--text-light);
  margin-top: 0.5rem;
}

.error-message {
  text-align: center;
  padding: 4rem 3rem;
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  box-shadow: var(--card-shadow);
  animation: fadeIn 0.8s ease-out;
}

.error-message h2 {
  color: var(--danger-color);
  margin-bottom: 1.2rem;
  font-family: var(--font-heading);
}

.error-message p {
  margin-bottom: 2rem;
  color: var(--text-light);
  max-width: 500px;
  margin-left: auto;
  margin-right: auto;
}

/* Enhanced Buttons */
.action-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 1.2rem;
  margin-top: 2.5rem;
}

.btn {
  padding: 0.9rem 1.8rem;
  border-radius: var(--button-radius);
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: var(--transition);
  border: none;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  letter-spacing: 0.01em;
}

.btn-primary {
  background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
  color: white;
  box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
}

.btn-secondary {
  background-color: #f1f5f9;
  color: var(--secondary-color);
  border: 1px solid #e2e8f0;
}

.btn-secondary:hover {
  background-color: #e2e8f0;
}

/* Application Form */
.application-form-container {
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  box-shadow: var(--card-shadow);
  padding: 2.5rem;
  animation: fadeIn 0.8s ease-out;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.form-title {
  font-family: var(--font-heading);
  font-size: 2.2rem;
  background: linear-gradient(90deg, var(--primary-dark), var(--primary-light));
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 2.5rem;
  text-align: center;
  font-weight: 700;
  letter-spacing: -0.02em;
}

.form-section {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #e2e8f0;
  animation: fadeInUp 0.8s ease-out;
}

.form-section:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.section-title {
  font-family: var(--font-heading);
  font-size: 1.4rem;
  color: var(--secondary-color);
  margin-bottom: 2rem;
  text-align: left;
  font-weight: 600;
  position: relative;
  padding-left: 1rem;
}

.section-title::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.3rem;
  bottom: 0.3rem;
  width: 4px;
  background: linear-gradient(180deg, var(--primary-color), var(--primary-light));
  border-radius: 4px;
}

.file-input-container {
  border: 2px dashed #cbd5e1;
  border-radius: var(--border-radius);
  padding: 2rem 1.5rem;
  text-align: center;
  margin-bottom: 0.8rem;
  transition: var(--transition);
  background-color: #f8fafc;
}

.file-input-container:hover {
  border-color: var(--primary-color);
  background-color: rgba(67, 97, 238, 0.03);
}

.file-input-label {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.8rem;
  cursor: pointer;
}

.file-input-icon {
  font-size: 2.2rem;
  color: var(--primary-color);
}

.file-input {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.file-name {
  font-size: 0.9rem;
  color: var(--text-light);
  font-weight: 500;
  margin-top: 0.7rem;
  background-color: #f1f5f9;
  padding: 0.4rem 1rem;
  border-radius: 50px;
  display: inline-block;
}

.checkbox-group {
  margin-bottom: 1.2rem;
  animation: fadeIn 0.6s ease-out;
}

.checkbox-label {
  display: flex;
  align-items: flex-start;
  gap: 0.8rem;
  cursor: pointer;
  padding: 0.5rem 0;
}

.checkbox-input {
  margin-top: 0.35rem;
  width: 18px;
  height: 18px;
  accent-color: var(--primary-color);
}

/* Animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Design */
@media (max-width: 992px) {
  .header-container {
    padding: 1rem;
  }
  
  .nav-links {
    display: none;
  }
  
  .form-row {
    grid-template-columns: 1fr;
    gap: 0;
  }
  
  .job-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
}

@media (max-width: 768px) {
  .header-container {
    flex-wrap: wrap;
  }
  
  .logo-container {
    margin-bottom: 0.5rem;
  }
  
  .user-actions {
    margin-left: auto;
  }
  
  .sector-banner {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .job-details-container, 
  .application-form-container {
    padding: 1.5rem;
  }
  
  .page-title {
    font-size: 2rem;
  }
  
  .container, .main-content {
    padding: 1rem;
  }
  
  .action-buttons {
    flex-direction: column;
  }
  
  .btn {
    width: 100%;
  }
}

/* Custom Field Icons */
.field-icon {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Theme colors for different job fields */
.field-tech { --field-color: #4cc9f0; }
.field-health { --field-color: #4895ef; }
.field-education { --field-color: #5e60ce; }
.field-finance { --field-color: #7209b7; }
.field-marketing { --field-color: #f72585; }
.field-hospitality { --field-color: #4361ee; }