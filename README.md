# Student Manager — PHP MySQL CRUD

A clean CRUD project using **HTML, CSS, JavaScript, PHP and MySQLi OOP**.

## Features
- Create, read, update and delete students
- MySQLi Object-Oriented database connection
- Prepared statements for database writes and search
- Server-side validation + client-side JavaScript validation
- Duplicate email handling
- Responsive professional UI
- Search by name, email, phone or city
- Flash success/error messages
- Safe HTML output with `htmlspecialchars`
- Delete confirmation

## Setup
1. Start Apache and MySQL in XAMPP/WAMP.
2. Import `schema.sql` into MySQL/phpMyAdmin.
3. Put this folder inside your web server directory, e.g. `htdocs`.
4. If your MySQL credentials differ, update the constants in `database.php`.
5. Open `index.php` through localhost.

## File flow
`index.php` → list/search
`insert.php` → form
`save.php` → INSERT
`update.php` → edit form + UPDATE
`delete.php` → DELETE
`database.php` → MySQLi connection
`message.php` → flash messages/output helpers
`helpers.php` → validation/redirect helpers
`assets/css/style.css` → UI
`assets/js/app.js` → validation + delete confirmation
`schema.sql` → database/table setup
