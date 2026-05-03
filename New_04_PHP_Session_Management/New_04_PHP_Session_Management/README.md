. process user input and manage sessions. Task 1. Design HTML form with Name, Email, Password. 2. Process form using GET and POST methods. 3. Validate email format. 4. Create cookie to store username. 5. Implement session-based login example.

## Prerequisites

You need a **PHP server** to run this project. Here are your options:

### 1: XAMPP
- **Download**: https://www.apachefriends.org/
- Includes Apache, PHP, and MySQL
- Easy to use for beginners

## Installation & Setup

### Using XAMPP (Easiest)

**Step 1: Install XAMPP**
1. Download from https://www.apachefriends.org/
2. Run the installer
3. Choose components (Apache, PHP)
4. Complete installation

**Step 2: Locate Project Folder**

Copy the entire `New_04_PHP_Session_Management` folder to:

**Windows:**
```
C:\xampp\htdocs\
```

After copying, your folder structure should be:
```
C:\xampp\htdocs\New_04_PHP_Session_Management\
├── index.php
├── process.php
├── dashboard.php
├── logout.php
└── README.md
```

**Step 3: Start XAMPP**

1. Open XAMPP Control Panel
2. Click **Start** for Apache
3. Click **Start** fro MySQL

```
If the MySQL is not starting, go to services in start menu, then search mysql and stop the activity.
```

**Step 4: Access the Application**

Open your browser and go to:
```
http://localhost/New_04_PHP_Session_Management/index.php
```

---

### Using PHP Built-in Server

**Step 1: Navigate to Project Folder**

```bash
cd "D:\backup\course_material_vi\web_dev\Lab_Exam\New_04_PHP_Session_Management"
```

**Step 2: Start PHP Server**

```bash
php -S localhost:8000
```

**Step 3: Access the Application**

Open your browser and go to:
```
http://localhost:8000/
```

---



## Default Credentials

| Field | Value |
|-------|-------|
| Name | Any name (e.g., "John Doe") |
| Email | Any valid email (e.g., "test@example.com") |
| Password | `password123` |



## Troubleshooting

### "Page not found" error

**Solution:**
- Ensure folder is in correct location:
  - XAMPP: `C:\xampp\htdocs\New_04_PHP_Session_Management`
  - PHP Server: Running in project directory
- Check URL: `http://localhost/New_04_PHP_Session_Management/`

### "Apache not running" (XAMPP users)

**Solution:**
1. Open XAMPP Control Panel
2. Click **Start** next to Apache
3. Wait for it to turn green

### "Invalid email format" error

**Solution:**
- Enter a valid email address
- Format: `username@domain.com`
- Examples: `john@example.com`, `test@gmail.com`

### "Invalid password" error

**Solution:**
- Password must be exactly: `password123`
- Check for typos
- Password is case-sensitive

### Login page shows but login doesn't work

**Solution:**
1. Check browser console (F12) for errors
2. Verify all files are in the project folder
3. Restart Apache/PHP server
4. Clear browser cache (Ctrl+Shift+Delete)

### Session lost after redirect

**Solution:**
- Ensure `session_start()` is first line in each PHP file
- Check if sessions folder has write permissions
- Clear browser cookies and try again


## Quick Reference Commands

### Start XAMPP (Windows)
1. Open XAMPP Control Panel
2. Click "Start" next to Apache

### Start PHP Built-in Server
```bash
php -S localhost:8000
```
