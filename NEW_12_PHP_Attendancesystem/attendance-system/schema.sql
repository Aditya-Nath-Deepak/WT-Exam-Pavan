CREATE DATABASE IF NOT EXISTS attendance;
USE attendance;
CREATE TABLE students (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), roll VARCHAR(50));
CREATE TABLE attendance (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT,
  date DATE,
  FOREIGN KEY(student_id) REFERENCES students(id)
);