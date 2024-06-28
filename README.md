# User Registration and Profile Management System
This project implements a simple User Registration and Profile Management system with dummy interfaces for both frontend and backend components.

# Features 
- User Registration: Allows users to register with a username, email, and password.
- Login and Logout: Users can log in using their registered credentials and log out securely.
- User Profile: Displays user information and allows updating of the "About Me" section.

# Language Used
- Frontend: HTML, CSS (styles.css)
- Backend: PHP, MySQL (database not connected in dummy implementation)

# Installation and Setup
1. Clone the repository.
2. Database Setup :
   - Create a MySQL database named 'assessment'.
   - Import the provided MySQL file ('assessment.sql') to set up the database schema and initial data.
   - Adjust database credentials in 'register.php', 'loginCheck.php', and 'profile.php' as necessary.
3. Run the application :
   - Place the project in your web server's root directory (e.g., Apache's 'htdocs' folder).
   - Access 'registration.php' to register a new user and 'login.php' to log in.

# Usage
- Navigate to registration.php to register a new user.
- Use login.php to log in with registered credentials.
- Upon successful login, users are redirected to profile.php to manage their profile and update their "About Me" section.

# Notes
- This project uses PHP for server-side scripting and MySQL for database management.
- It demonstrates basic CRUD operations (Create, Read, Update, Delete) for user profiles without actual database connectivity in the provided implementation.
- Frontend styling is handled using styles.css.
