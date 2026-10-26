CREATE DATABASE IF NOT EXISTS oop_crud
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE oop_crud;

CREATE TABLE IF NOT EXISTS students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    city VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_students_name (name),
    INDEX idx_students_city (city)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- 20 Demo Students
INSERT INTO students (name, email, phone, city) VALUES
('Aarav Sharma', 'aarav.sharma@example.com', '9876500001', 'Kolkata'),
('Ananya Sen', 'ananya.sen@example.com', '9876500002', 'Howrah'),
('Rohan Das', 'rohan.das@example.com', '9876500003', 'Kolkata'),
('Priya Roy', 'priya.roy@example.com', '9876500004', 'Siliguri'),
('Aditya Ghosh', 'aditya.ghosh@example.com', '9876500005', 'Durgapur'),
('Sneha Mukherjee', 'sneha.mukherjee@example.com', '9876500006', 'Kolkata'),
('Rahul Banerjee', 'rahul.banerjee@example.com', '9876500007', 'Asansol'),
('Tania Chatterjee', 'tania.chatterjee@example.com', '9876500008', 'Howrah'),
('Arjun Saha', 'arjun.saha@example.com', '9876500009', 'Bardhaman'),
('Moumita Das', 'moumita.das@example.com', '9876500010', 'Kolkata'),
('Sourav Paul', 'sourav.paul@example.com', '9876500011', 'Barrackpore'),
('Riya Dutta', 'riya.dutta@example.com', '9876500012', 'Kolkata'),
('Abhishek Roy', 'abhishek.roy@example.com', '9876500013', 'Chandannagar'),
('Puja Ghosh', 'puja.ghosh@example.com', '9876500014', 'Serampore'),
('Sayan Bhattacharya', 'sayan.bhattacharya@example.com', '9876500015', 'Kolkata'),
('Nandini Bose', 'nandini.bose@example.com', '9876500016', 'Kalyani'),
('Debjit Mitra', 'debjit.mitra@example.com', '9876500017', 'Kolkata'),
('Ishita Chakraborty', 'ishita.chakraborty@example.com', '9876500018', 'Krishnanagar'),
('Vivek Singh', 'vivek.singh@example.com', '9876500019', 'Kolkata'),
('Neha Gupta', 'neha.gupta@example.com', '9876500020', 'Durgapur');
