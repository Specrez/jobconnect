CREATE TABLE IF NOT EXISTS user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    session_token VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL,
    last_activity DATETIME NOT NULL,
    UNIQUE KEY unique_session (email, session_token)
);
