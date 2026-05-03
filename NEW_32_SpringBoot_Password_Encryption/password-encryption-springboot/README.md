# Password Encryption Spring Boot App

A minimalistic Spring Boot application created for a lab exam to demonstrate secure user authentication and password encryption. 

## Features
1. **Password Encoder**: Uses `BCryptPasswordEncoder` to securely hash passwords.
2. **Database**: In-memory H2 database to store encrypted passwords.
3. **Authentication**: Uses Spring Security to authenticate users based on the stored BCrypt hash.
4. **Validation**: Seamlessly validates passwords during the login process.
5. **Results**: Displays a simple authentication success message.

---

## How to Run the Project

You can run this project easily using the included Maven wrapper.

### Prerequisites
- JDK 17 or higher installed on your system.

### Steps to Run
1. Open a terminal or PowerShell in the root directory of the project (`password-encryption-springboot`).
2. Run the following command:

   **On Windows:**
   ```powershell
   .\mvnw.cmd spring-boot:run
   ```

   **On macOS/Linux:**
   ```bash
   ./mvnw spring-boot:run
   ```

3. The application will start on `http://localhost:8080`.

---

## How to Test the Application

### 1. Register a User
To create a new user, you need to send a `POST` request to the `/register` endpoint with a `username` and `password`. The password will be automatically encrypted with BCrypt before being saved to the database.

**Using PowerShell:**
```powershell
Invoke-RestMethod -Uri "http://localhost:8080/register?username=student&password=mypassword" -Method POST
```

**Using cURL:**
```bash
curl -X POST "http://localhost:8080/register?username=student&password=mypassword"
```

### 2. Login & Authenticate
1. Open your web browser and navigate to: [http://localhost:8080/home](http://localhost:8080/home)
2. You will be redirected to the default Spring Security login page.
3. Enter the credentials you registered with (e.g., Username: `student`, Password: `mypassword`).
4. Click **Sign in**.

### 3. Verify Results
Once logged in, you will be redirected back to the `/home` endpoint and should see the following message:
> Authentication successful for user: student!

---

## Database Console (Optional)
Since this project uses an in-memory H2 database, you can inspect the stored users and their encrypted passwords directly.
1. Navigate to: [http://localhost:8080/h2-console](http://localhost:8080/h2-console)
2. Ensure the JDBC URL is set to `jdbc:h2:mem:testdb`.
3. Username is `sa`, leave the password blank.
4. Click **Connect**.
5. Run the query `SELECT * FROM users;` to see the securely hashed passwords in the database.
