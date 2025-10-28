# Student Management System (Advanced)
Contains a PHP + MySQL student management system with user authentication (register/login) and CRUD for student records.

## Setup
1. Place the `student_system_advanced` folder into your XAMPP `htdocs` directory or similar web root.
2. Create a MySQL database and import `db.sql` or run the SQL inside it using phpMyAdmin.
3. Update `db.php` with your DB credentials if needed.
4. Start Apache and MySQL, visit `http://localhost/student_system_advanced/` to open the app.

## Files
- db.php           - Database connection
- db.sql           - SQL to create database and tables
- index.php        - Dashboard (students list) — requires login
- add.php          - Add student
- edit.php         - Edit student
- delete.php       - Delete student
- login.php        - Login page
- register.php     - Register page
- logout.php       - Logout handler
- style.css        - Basic styling
