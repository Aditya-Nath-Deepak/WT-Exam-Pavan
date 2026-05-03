# springboot-failed-login-tracker

A minimalistic Spring Boot application designed for a lab exam that demonstrates how to track failed login attempts, lock an account after multiple failures, and automatically unlock it after a specific time interval.

## Features
- Spring Security based Authentication.
- Track failed login attempts.
- Lock user account after 3 failed login attempts.
- Custom error messages for failed attempts and locked accounts.
- Automatic account unlock after 15 seconds (for demonstration purposes).
- In-memory H2 Database for easy setup and testing.

## Prerequisites
- Java 17

## How to Run

1. Open your terminal or command prompt.
2. Navigate to the root directory of the project:
   ```cmd
   cd c:\DAOO\springboot-failed-login-tracker
   ```
3. Run the application using the Maven wrapper:
   ```cmd
   mvnw.cmd spring-boot:run
   ```

## How to Test

1. Open a web browser and go to `http://localhost:8080`.
2. You will be redirected to the login page (`http://localhost:8080/login`).
3. **Available Credentials:**
   - Username: `admin`, Password: `admin123`
   - Username: `user`, Password: `user123`
4. **Successful Login:** Enter the correct credentials. You will be redirected to the home page.
5. **Failed Login / Account Lock Test:**
   - Enter an incorrect password for a user (e.g., `admin`).
   - Repeat this 3 times.
   - On the 3rd failed attempt, the account will be locked, and you will see a message: *"Your account has been locked due to 3 failed attempts. It will be unlocked after 15 seconds."*
   - Try logging in again immediately; you will see: *"Your account is locked. Please try again later."*
   - Wait for **15 seconds** and try logging in with the **correct** password. You will see: *"Your account has been unlocked. Please try to login again."*
   - Log in once more with the correct password to successfully access the home page.
