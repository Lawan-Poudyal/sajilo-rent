# Sajilo Rent

Sajilo Rent is a PHP + MySQL web application for connecting room owners and students looking for rental rooms.  
It includes map-based room discovery, owner listing management, chat, profile management, reviews, and admin verification.

## Features

- User sign up and login
- Role-based flows for:
  - **Students** (search/filter rooms, view room details, request/book rentals, leave reviews)
  - **Owners** (post and manage room listings with location, images, facilities, and pricing)
  - **Admin** (verify pending users)
- Interactive map integration using Leaflet
- In-app chat between users
- Profile picture and profile management

## Tech Stack

- PHP (procedural + MySQLi)
- MySQL / MariaDB
- HTML, CSS, JavaScript
- Leaflet + Leaflet Routing Machine

## Project Structure

```text
adminPanel/              # Admin UI and verification page
chatapplication/         # Chat UI and chat backend APIs
database/                # SQL dump (schema + sample data)
loginsignup_page/        # Authentication pages
studentsection/          # Student dashboard and room browsing flows
student-scroll-section/  # Student room data generation/rendering
user-panel/              # Owner dashboard and listing management
userprofiles/            # Student/owner profile pages
resources/               # Shared images/assets
universal-styling/       # Shared styles
```

## Prerequisites

- PHP 8+
- MySQL / MariaDB
- Apache (XAMPP/LAMP recommended)

## Setup

1. Clone the project into your web root so the app is available at:
   `/opt/lampp/htdocs/sajilo-rent` (or update hardcoded absolute include paths in the project).
2. Start Apache and MySQL.
3. Create a MySQL database named `user_database`.
4. Import the SQL dump:
   - File: `database/user_database.sql`
   - Example:
     ```bash
     mysql -u root -p user_database < database/user_database.sql
     ```
5. Verify DB credentials in code (many files use):
   - host: `localhost`
   - user: `root`
   - password: blank by default in local XAMPP setups
   - database: `user_database`
   - ⚠️ For production, use a dedicated database user with a strong password and update connection settings accordingly.

## Running the App

Open in browser:

- `http://localhost/sajilo-rent/loginsignup_page/login.php`

Optional pages:

- Student dashboard: `http://localhost/sajilo-rent/studentsection/displayLatLng.php`
- Owner dashboard: `http://localhost/sajilo-rent/user-panel/owner-page.php`
- Admin panel: `http://localhost/sajilo-rent/adminPanel/adminPage.php`

## Notes

- This repository currently has no configured automated test suite.
- Basic PHP syntax lint can be run with:
  ```bash
  find . -name '*.php' -print0 | xargs -0 -n1 php -l
  ```
