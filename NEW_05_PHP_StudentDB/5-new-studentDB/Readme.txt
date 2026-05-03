 perform database operations using PHP and MySQL. 
Tasks: 1. Create database 'student_db'. 2. Create table 'students(id, name, email)'. 3. Connect PHP with MySQL using mysqli/PDO. 4. Insert records into table. 5. Display, update, and delete records.
============================================================
PHP MYSQL STUDENT CRUD SYSTEM
============================================================

------------------------------------------------------------
1. DATABASE SETUP (Run these in phpMyAdmin SQL tab)
------------------------------------------------------------

-- 1. Create database
CREATE DATABASE student_db;

-- 2. Use the database
USE student_db;

-- 3. Create table
CREATE TABLE students (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

------------------------------------------------------------
2. INSTALLATION
------------------------------------------------------------
npm install vite@latest

1. Start XAMPP/WAMP (Apache and MySQL).
2. Create a folder named 'student_crud' in htdocs.
3. Save 'index.php' into that folder.
4. Open browser and go to: http://localhost/student_crud/index.php

------------------------------------------------------------
3. SCRIPT LOGIC
------------------------------------------------------------
- CONNECTION: Uses 'mysqli' object-oriented approach to 
  link PHP with the MySQL database.
- CREATE: Handles POST requests to run INSERT queries.
- READ: Executes 'SELECT *' and loops through the result 
  set using fetch_assoc().
- UPDATE: Retrieves data using a GET ID, populates the form, 
  and submits a 'UPDATE' query.
- DELETE: Detects a 'delete' parameter in the URL and 
  executes a DELETE query.

------------------------------------------------------------
4. COMMON SQL QUERIES USED
------------------------------------------------------------
INSERT: INSERT INTO students (name, email) VALUES ('John', 'john@example.com');
SELECT: SELECT * FROM students;
UPDATE: UPDATE students SET name='New Name' WHERE id=1;
DELETE: DELETE FROM students WHERE id=1;
============================================================