# Land Registration and Evidence Management System

A comprehensive web-based system for managing land registration, user authentication, and role-based access control.

## Features

- **Multi-role Authentication**: Support for Users, Tehsildars, and Administrators
- **Secure Login System**: Password hashing and session management
- **Role-based Dashboards**: Different interfaces for different user types
- **User Registration**: Account creation with validation
- **Database Management**: MySQL-based data storage

## Setup Instructions

### Prerequisites

1. **XAMPP** (or similar local server with PHP and MySQL)
2. **Web Browser**
3. **MySQL Database**

### Installation Steps

1. **Start XAMPP**
   - Start Apache and MySQL services
   - Ensure both services are running (green status)

2. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database or use existing one
   - Import the `db.sql` file to create tables and sample data
   - OR run the database update script:
     ```
     http://localhost/your-project-folder/update_database.php
     ```

3. **File Configuration**
   - Place all project files in your XAMPP htdocs folder
   - Ensure `config.php` has correct database credentials:
     ```php
     $DB_HOST = '127.0.0.1';
     $DB_USER = 'root';
     $DB_PASS = '';
     $DB_NAME = 'land_registration_db';
     ```

4. **Access the System**
   - Open your web browser
   - Navigate to: `http://localhost/your-project-folder/`

## User Types and Access

### 1. Regular Users
- **Login**: `userlogin.html`
- **Dashboard**: `userdashboard.php`
- **Features**: Land registration applications, document uploads

### 2. Tehsildar Officers
- **Login**: `tehlogin.html`
- **Dashboard**: `tehsildardashboard.php`
- **Features**: Document verification, field inspections, approvals

### 3. Administrators
- **Login**: `adminlogin.html`
- **Dashboard**: `admindashboard.php`
- **Features**: User management, system reports, overall administration

## Sample Login Credentials

### Admin Access
- **Username**: `admin`
- **Password**: `admin123`
- **Email**: `admin@landreg.com`

### Tehsildar Access
- **Username**: `tehsildar`
- **Password**: `tehsildar123`
- **Email**: `tehsildar@landreg.com`

### Regular User
- Create a new account using the registration form
- Default role: `user`

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check if MySQL is running in XAMPP
   - Verify database credentials in `config.php`
   - Ensure database `land_registration_db` exists

2. **Login Not Working**
   - Run the database update script: `update_database.php`
   - Check if the `user_type` column exists in the database
   - Verify password hashing is working

3. **Page Not Found (404)**
   - Ensure files are in the correct XAMPP htdocs directory
   - Check file permissions
   - Verify Apache is running

4. **Session Issues**
   - Clear browser cookies and cache
   - Check PHP session configuration
   - Ensure `session_start()` is called in all PHP files

### Database Issues

If you encounter database-related errors:

1. **Run the update script**:
   ```
   http://localhost/your-project-folder/update_database.php
   ```

2. **Manual database setup**:
   - Import `db.sql` in phpMyAdmin
   - Or run the SQL commands manually

3. **Check table structure**:
   ```sql
   DESCRIBE account_details;
   ```
   Should show columns: `id`, `Fullname`, `Username`, `Email`, `Password`, `phone_number`, `State`, `City`, `Region`, `user_type`, `created_at`

## File Structure

```
project/
├── config.php              # Database configuration
├── auth_login.php          # Login authentication
├── auth_register.php       # Registration handling
├── logout.php              # Session logout
├── update_database.php     # Database update script
├── db.sql                  # Database schema
├── userlogin.html          # User login page
├── adminlogin.html         # Admin login page
├── tehlogin.html           # Tehsildar login page
├── createaccouint.html     # Registration page
├── userdashboard.php       # User dashboard
├── admindashboard.php      # Admin dashboard
├── tehsildardashboard.php  # Tehsildar dashboard
├── *.css                   # Styling files
└── README.md               # This file
```

## Security Features

- **Password Hashing**: Uses PHP's `password_hash()` with BCRYPT
- **Session Management**: Secure session handling
- **SQL Injection Prevention**: Prepared statements
- **Input Validation**: Server-side validation for all inputs
- **Role-based Access Control**: Different permissions for different user types

## Development Notes

- Built with PHP, MySQL, HTML, CSS, and JavaScript
- Uses AJAX for seamless user experience
- Responsive design for mobile compatibility
- Modular code structure for easy maintenance

## Support

For issues or questions:
1. Check the troubleshooting section above
2. Verify all prerequisites are met
3. Ensure proper file permissions
4. Check XAMPP error logs if needed
