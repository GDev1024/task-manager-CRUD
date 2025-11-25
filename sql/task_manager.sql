-- Task Manager Database Export
-- Creating the Database
CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

-- Creating the Tasks Table
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    status ENUM('pending','completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Data (Optional)
INSERT INTO tasks (task, status) VALUES 
('Finish assignment', 'pending'),
('Study for DSA quiz', 'completed'),
('Take a walk', 'pending');
