-- Create database
CREATE DATABASE IF NOT EXISTS task_manager_crud;
USE task_manager_crud;

-- Create tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    status ENUM('pending','completed') DEFAULT 'pending'
);

-- Sample data
INSERT INTO tasks (title, status) VALUES 
('Finish prepare for DSA quiz', 'pending'),
('Buy groceries', 'completed'),
('Call mom', 'pending'),
('Clean the house', 'completed');
