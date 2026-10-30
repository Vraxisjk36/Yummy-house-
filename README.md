# The Yummy House

Responsive PHP/MySQL e-commerce coursework prototype for a restaurant and Asian grocery shop.

## Stack
HTML, CSS, JavaScript, PHP 8+, MySQL 8.

## Local setup
1. Create a MySQL database and import `database/schema.sql`.
2. Copy `config.example.php` to `config.php` and set database credentials.
3. Serve this folder with PHP (for development only); deploy to PHP/MySQL hosting for assessment.

## Current phase
Customer storefront with product browsing, session cart, and order checkout. Admin and authentication are upcoming. Sample prices and menu entries are placeholders requiring client approval. No real payment processing.

## Security
Never commit `config.php` or passwords. Use HTTPS in production. This is an initial prototype, not production-ready.
