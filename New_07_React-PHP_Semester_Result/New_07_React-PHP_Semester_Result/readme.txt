 Design and develop a responsive website to prepare one semester result of VIT students using REACT, PHP and MySQL. Take any four subjects with MSE Marks (30%) ESE Marks (70%). Task 1. Create multiple components.(App (Parent Component), Student (Child Component),Result (Child Component) ) 2. Pass data from parent to child using Props.(The App component should pass the data to the Student component are: Student Name,Course,Marks)
3. Manage component State using useState().(Use useState() to manage marks) 4. Update UI dynamically based on state changes.(Display Pass/Fail status dynamically)


🛠️ Phase 1: Software You Need
Before we start, install these two tools. They do all the heavy lifting for you.

XAMPP: Download here. This turns your computer into a local server to handle the database and PHP.

Node.js: Download here. This allows your computer to run the React website. Just click "Next" on all the installer prompts.

🗄️ Phase 2: Setting up the Database (MySQL)
Open the XAMPP Control Panel from your Start menu.

Click Start next to Apache and MySQL. They should turn green.

Open your browser and go to: http://localhost/phpmyadmin

Click New on the left sidebar.

Database name: vit_results. Click Create.

Click the SQL tab at the top and paste the following:

SQL
CREATE TABLE records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    course VARCHAR(100),
    percentage DECIMAL(5,2),
    status VARCHAR(10)
);
Click Go. Your database is now ready!

⚙️ Phase 3: Setting up the Backend (PHP)
Go to the folder where you installed XAMPP (usually C:\xampp).

Open the htdocs folder.

Paste the backend folder in there.

💻 Phase 4: Setting up the Website (React)

Bash
npm install
npm start

🚀 Phase 5: How to use it
Your browser will automatically open http://localhost:3000.

Enter the Student Name and Course.

Enter marks for the 4 subjects.

MSE: Enter a number between 0 and 30.

ESE: Enter a number between 0 and 70.

The Pass/Fail status will change instantly as you type!

Click Save Result to Database.

To verify it worked, go back to phpMyAdmin and click the records table. You will see the student's data saved there!

Phase 6: To see the data saved
Open your browser and go to: http://localhost/phpmyadmin

On the left-hand sidebar, click on the database you created: vit_results.

Click on the table named records.

Click the "Browse" tab at the top.

You will see a grid (like an Excel sheet) showing every student's name, course, percentage, and pass/fail status that you have saved so far.

⚠️ Troubleshooting
"Connection Failed": Make sure the Apache and MySQL buttons in XAMPP are green.

"NPM not recognized": Restart your computer after installing Node.js so it registers properly.

"Blank Screen": Check the "Console" in your browser (Right-click > Inspect > Console) to see if there are any red error messages.