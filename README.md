# The Yummy House

PHP 8+ and MySQL coursework prototype for a restaurant storefront and administrator dashboard.

## Setup
1. Provision a MySQL database on a PHP-compatible host.
2. Import database/schema.sql into that database. Some hosts require removing the CREATE DATABASE and USE lines before import.
3. Import database/admin_migration.sql into the same database.
4. Copy config.example.php to config.php and enter the database connection settings. Do not commit config.php.
5. Create the first admin using scripts/create_admin.php from a trusted command-line environment with database access.
6. Deploy PHP files and assets to the PHP host. GitHub Pages cannot run this application.

## URLs
- /index.php: storefront
- /cart.php: shopping cart and order request
- /customer/register.php: customer registration
- /customer/login.php: customer sign-in
- /customer/account.php: customer order history
- /admin/login.php: administrator sign-in
- /admin/index.php: administrator dashboard

## Before assessment
Test account registration, login, logout, cart additions and removals, pickup and delivery orders, order history, admin product edits, special offers, and order statuses. Check phone and desktop layouts. Replace sample product names and prices with client-approved details.

## Known limitations
No online payments, delivery fee calculation, inventory quantities, password reset, login rate limiting, or live-host verification. The checkout records order requests, not confirmed paid orders. Keep SQL files and administrative scripts outside the public web root where possible. Complete the assignment's required diagrams, screenshots, and report separately.
