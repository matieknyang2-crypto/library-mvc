# Library Management System (PHP MVC)

A complete Library Management System built with PHP MVC architecture, MySQL, and Bootstrap. Compatible with XAMPP.

## Features
- User authentication (Admin/Student roles)
- Dashboard with statistics
- Manage books (CRUD, search, filter by category)
- Manage categories
- Issue/return books with due dates
- Overdue tracking
- Export overdue list as CSV
- Responsive UI with Bootstrap 5

## Requirements
- XAMPP (PHP 7.4+, MySQL 5.7+)
- mod_rewrite enabled (for clean URLs)

## Installation

1. **Clone or download** the project into `C:\xampp\htdocs\library_mvc` (or your XAMPP htdocs).

2. **Start Apache and MySQL** from XAMPP control panel.

3. **Import database**:
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `library_mvc`
   - Import the `database.sql` file located in the project root.

4. **Configure database connection**:
   - Open `app/config/database.php` and update credentials if needed.
   - Current default project credentials are:
     - Host: `localhost`
     - Database: `library_mvc`
     - Username: `library_app`
     - Password: `LibApp@2026!`

5. **Set base URL**:
   - The project assumes the base URL is `/library_mvc/public/`. If your setup differs, adjust the paths in views and controllers (e.g., in header.php links). You may need to update the `redirect()` method in BaseController to use proper base URL.

6. **Default Users**:
   - Admin: email `admin@library.com`, password `admin123`
   - Student: email `john@example.com`, password `student123`
   - *Note:* Passwords are hashed. If you need to create new users, use `password_hash('password', PASSWORD_DEFAULT)`.

7. **Access the application**:
   - Open browser and go to `http://localhost/library_mvc/public/`

## Folder Structure
- `app/` – MVC core (config, controllers, models, views)
- `public/` – publicly accessible (index.php, css, js, .htaccess)
- `database.sql` – database dump
- `README.md` – this file

## Usage
- Login with admin or student credentials.
- Admin can manage books/categories, issue/return books, view overdue.
- Students can view available books and their issued books.

## Notes
- Ensure `mod_rewrite` is enabled in Apache for clean URLs.
- For production, change database credentials and disable error display.
- The system uses sessions; ensure session save path is writable.

## Troubleshooting
- If you get 404 errors, check .htaccess and base paths.
- If database connection fails, verify credentials in `database.php`.