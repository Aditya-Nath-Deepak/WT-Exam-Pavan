============================================================
COLLEGE COMPLAINT MANAGEMENT SYSTEM
============================================================

------------------------------------------------------------
1. PREREQUISITES
------------------------------------------------------------

- XAMPP/WAMP (Apache & MySQL)
- PHP 7.4 or higher

------------------------------------------------------------
2. DATABASE SETUP
------------------------------------------------------------
- Run the SQL commands in 'complaint_system.sql' via phpMyAdmin.
- Default Logins provided:
    * Student: student1 / 12345
    * Admin:   admin1 / admin123

------------------------------------------------------------
3. FILE STRUCTURE
------------------------------------------------------------
- index.php           : Student Login
- complaint.php       : Complaint Registration (Secured)
- admin_login.php     : Administrator Portal Login
- admin_dashboard.php : List of all complaints (Secured)
- logout.php          : Destroys current session
- style.css           : Universal styling
- register.php        : Student Registration

------------------------------------------------------------
4. EXECUTION
------------------------------------------------------------
- Move the folder to htdocs.
- Navigate to http://localhost/folder_name/index.php

------------------------------------------------------------
5. CORE SQL QUERIES
------------------------------------------------------------
CREATE DATABASE: CREATE DATABASE complaint_system;
INSERT COMPLAINT: INSERT INTO complaints (student_id, subject, description) VALUES (...);
FETCH COMPLAINTS: SELECT c.*, s.username FROM complaints c JOIN students s ON c.student_id = s.id;
============================================================