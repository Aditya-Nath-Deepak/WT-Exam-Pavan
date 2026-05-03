===========================================================
PROJECT: AIRPLANE SEAT BOOKING SYSTEM (PHP)
===========================================================

1. PROJECT DESCRIPTION
----------------------
A PHP-based web application that allows users to view an 
airplane seating arrangement and book seats in real-time. 
The system tracks availability and prevents double-booking.

2. PREREQUISITES
----------------
- PHP 8.0 or higher
- MySQL / MariaDB (for database storage)
- Local Server Environment (XAMPP, WAMP, or MAMP)

3. DATABASE SETUP (SQL SYNTAX)
------------------------------
If you wish to move from Session-based storage to a Database, 
execute the following SQL commands in your MySQL console or 
phpMyAdmin:

CREATE DATABASE airplane_db;
USE airplane_db;

CREATE TABLE seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seat_code VARCHAR(5) NOT NULL UNIQUE,
    is_booked TINYINT(1) DEFAULT 0,
    booked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pre-populating the seats for a 10x4 configuration
INSERT INTO seats (seat_code) VALUES 
('1A'), ('1B'), ('1C'), ('1D'),
('2A'), ('2B'), ('2C'), ('2D'),
-- ... (continue for all 10 rows)
('10A'), ('10B'), ('10C'), ('10D');

4. EXECUTION COMMANDS
---------------------
Unlike React projects (which use npm), standard PHP runs 
directly on a server. However, you can use these commands:

A. Using PHP Built-in Server (Fastest):
   Open your terminal in the project folder and run:
   > php -S localhost:8000

   Then, open your browser and go to: http://localhost:8000

B. Using XAMPP/WAMP:
   1. Move the project folder to 'C:/xampp/htdocs/'.
   2. Start Apache and MySQL from the XAMPP Control Panel.
   3. Open browser and go to: http://localhost/your_folder_name/index.php

C. If using a React-based Frontend (NPM):
   If you integrate this with a React frontend later:
   > npm install      (Install dependencies)
   > npm run dev      (Start development server)

5. HOW TO RUN
-------------
1. Ensure your local server (Apache/PHP) is running.
2. Place 'index.php' and any associated CSS/JS files in the 
   root directory of your server.
3. Access the file via the localhost URL.
4. Click on any GREEN seat to book it.
5. Use the 'Reset' button at the bottom to clear all data.

6. PROJECT STRUCTURE
--------------------
- index.php    : Main logic, seating grid, and booking handlers.
- style.css    : (Optional) Separate styling if not inline.
- readme.txt   : Project documentation and setup guide.

===========================================================