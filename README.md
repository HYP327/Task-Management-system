# Task Management System

A comprehensive task management web application built with PHP, PostgreSQL, HTML, CSS, and JavaScript.

## Features Implemented

### ✅ Morning Tasks Completed

- **User Registration System**
  - Secure registration form with validation
  - Password hashing using PHP's `password_hash()`
  - Username and email uniqueness validation
  - Input sanitization and validation

- **Database Setup**
  - PostgreSQL database schema with users table
  - Complete tables for tasks and categories
  - Proper foreign key relationships with CASCADE
  - PostgreSQL-specific features (triggers, functions)

- **User Authentication**
  - Login system with username/email support
  - Secure password verification
  - Session management with security features
  - Remember me functionality (basic implementation)

- **Session Management**
  - Secure session handling
  - Session regeneration for security
  - Login/logout state management
  - Protected page access control

- **Dashboard Foundation**
  - Welcome dashboard with user information
  - Statistics cards (ready for task data)
  - Quick action buttons
  - Responsive design
  - Navigation system

## Project Structure

```
Task Management System/
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   └── js/
│       └── main.js            # JavaScript functionality
├── config/
│   └── database.php           # Database configuration
├── database/
│   └── schema.sql             # Database schema
├── includes/
│   └── session.php            # Session management functions
├── index.php                  # Home page (redirects based on login)
├── login.php                  # User login page
├── register.php               # User registration page
├── dashboard.php              # User dashboard
├── logout.php                 # Logout functionality
└── README.md                  # This file
```

## Setup Instructions

### Prerequisites

- PHP 7.4 or higher with PostgreSQL extension (php-pgsql)
- PostgreSQL 12 or higher
- pgAdmin (recommended for database management)
- Web server (Apache/Nginx) or PHP built-in server

### Installation Steps

1. **Clone/Download the project**
   ```bash
   # If using git
   git clone <repository-url>
   cd "Task Management System"
   ```

2. **Database Setup**
   - Install PostgreSQL and pgAdmin
   - Create a PostgreSQL database named `task_management_system`
   - Connect to the database using pgAdmin
   - Run the SQL commands from `database/schema.sql` in pgAdmin Query Tool

3. **Configure Database Connection**
   - Edit `config/database.php` if needed
   - Update database credentials:
     - Host: `localhost` (default)
     - Port: `5432` (default PostgreSQL port)
     - Database: `task_management_system`
     - Username: `postgres` (default)
     - Password: Your PostgreSQL password

4. **Start the Application**

   **Option A: Using PHP Built-in Server**
   ```bash
   php -S localhost:8000
   ```

   **Option B: Using Apache/Nginx**
   - Place the project folder in your web server's document root
   - Access via `http://localhost/Task Management System/`

5. **Access the Application**
   - Open your browser and go to `http://localhost:8000` (or your configured URL)
   - You'll be redirected to the login page
   - Click "Register here" to create a new account

## Usage

### Registration
1. Navigate to the registration page
2. Fill in all required fields:
   - First Name
   - Last Name
   - Username (3+ characters, alphanumeric and underscores only)
   - Email (valid email format)
   - Password (6+ characters)
   - Confirm Password
3. Click "Register"

### Login
1. Use your username or email
2. Enter your password
3. Optionally check "Remember me"
4. Click "Login"

### Dashboard
- View welcome message with your name
- See task statistics (currently showing 0 as no tasks exist yet)
- Access quick actions for future features
- Navigate using the top menu

## Security Features

- **Password Hashing**: Uses PHP's `password_hash()` with default algorithm
- **Session Security**: Session ID regeneration on login
- **Input Validation**: Server-side and client-side validation
- **SQL Injection Prevention**: PDO prepared statements
- **XSS Prevention**: HTML escaping with `htmlspecialchars()`
- **Access Control**: Protected pages require authentication

## Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7.4+
- **Database**: PostgreSQL 12+
- **Styling**: Custom CSS with responsive design
- **Security**: PDO, password hashing, session management

## Next Steps (Future Development)

- Task CRUD operations
- Task categories and tags
- Due date management
- Task priority levels
- Search and filtering
- User profile management
- Email notifications
- Task sharing and collaboration

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source and available under the [MIT License](LICENSE).
