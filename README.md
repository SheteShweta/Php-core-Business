# PHP Core Business

A simple PHP application for managing businesses and collecting star ratings. Built with PHP, MySQL, Bootstrap, and jQuery.

## Features

- **Business CRUD**: Add, edit, and delete businesses
- **Star ratings**: Rate businesses (1–5 stars); same user (email or phone) for a business updates their rating
- **Real-time updates**: Average rating and stars update after submit without page refresh
- **Modal UI**: Rating and business forms in Bootstrap modals

## Requirements

- PHP 7.4+ (or compatible)
- MySQL 5.7+ / MariaDB
- Web server with PHP (e.g. Apache via XAMPP, WAMP, or built-in PHP server)

## Setup Instructions

### 1. Clone or copy the project

Place the project in your web server document root, for example:

- **XAMPP**: `C:\xampp\htdocs\Php-core-Business` (Windows) or `/Applications/XAMPP/xamppfiles/htdocs/Php-core-Business` (macOS)
- **MAMP**: `htdocs/Php-core-Business`
- Or use PHP built-in server from the project root (see step 5)

### 2. Create the database

1. Start MySQL (e.g. from XAMPP Control Panel).
2. Run the schema from the **project root** via MySQL CLI or import in phpMyAdmin:

```bash
mysql -u root -p < Database/schema.sql
```

Or in phpMyAdmin: create database `php_business`, then import `Database/schema.sql`.

This creates the database `php_business` with tables `businesses` and `ratings`.

### 3. Configure database connection

Edit `config/db.php` and set your MySQL credentials:

```php
$host     = "localhost";
$user     = "root";
$password = "";        // Set your MySQL password if required
$database = "php_business";
```

### 4. Add star images (for Raty)

The rating stars need three images in `assets/images/`:

- `star-on.png`
- `star-off.png`
- `star-half.png`

Create the folder if it doesn’t exist and add these files (e.g. from the [Raty](https://github.com/wbotelhos/raty) project).

### 5. Run the application

**Option A – Apache (XAMPP/WAMP)**  
Start Apache and MySQL, then open in the browser:

```
http://localhost/Php-core-Business/
```

**Option B – PHP built-in server**  
From the project root:

```bash
php -S localhost:8000
```

Then open: `http://localhost:8000`

---

## Project structure

```
Php-core-Business/
├── config/
│   └── db.php              # Database connection
├── controllers/
│   ├── BusinessController.php
│   └── RatingController.php
├── views/
│   ├── business_list.php   # Main listing + business modal
│   └── rating_modal.php    # Rating form modal
├── assets/
│   ├── css/
│   │   └── raty.css
│   ├── js/
│   │   ├── business.js
│   │   └── raty.js
│   └── images/             # Star images (see setup step 4)
├── Database/
│   └── schema.sql
├── index.php               # Front controller
└── README.md
```

## Rating logic

- **Existing user**: If the same email OR phone already has a rating for that business, the existing rating is updated.
- **New user**: Otherwise, a new rating row is inserted.
- The average rating is recalculated after each save and the table updates in real time (no page refresh).
