===========================================================
PROJECT: WASTE COLLECTION & AUTHORITY DIRECTION SYSTEM
DEVELOPER: ARYAN
===========================================================

1. OVERVIEW
-----------
This system allows users to report waste (Plastic/Paper) 
at specific locations. The logic automatically directs 
the request to the relevant municipal authority based 
on the material type.

2. DATABASE SETUP (SQL SYNTAX)
------------------------------
Run the following commands in your MySQL environment 
(e.g., phpMyAdmin) to create the necessary table:

CREATE DATABASE waste_management;
USE waste_management;

CREATE TABLE waste_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_type ENUM('Plastic', 'Paper', 'Other') NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT,
    assigned_authority VARCHAR(100),
    status ENUM('Pending', 'In-Progress', 'Collected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. EXECUTION COMMANDS
---------------------
To run this project locally without a full XAMPP setup:

1. Open your terminal/command prompt.
2. Navigate to the folder containing index.php.
3. Run the built-in PHP server:
   > php -S localhost:8080

4. Open your browser and visit:
   > http://localhost:8080

4. HOW TO RUN
-------------
- Ensure PHP is installed on your system.
- If using a database, update the index.php file with 
  mysqli_connect() credentials.
- Fill out the form with the waste type and location.
- Upon submission, the system will display which 
  authority has been notified of the request.

5. NOTE ON NPM
--------------
This is a standard PHP project and does not require 
'npm install' or 'npm run dev'. Those commands are 
reserved for your React/Node.js projects like 
Retronic or your Digital Clock.

===========================================================