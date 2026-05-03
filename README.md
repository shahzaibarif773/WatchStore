# WatchStore Ecommerce (Laravel 11)

**Demo video:** [WatchStore — home and features (Google Drive)](https://drive.google.com/file/d/12iZsyoezbCMqtQZ41sj2DYzmkoVPaW8o/view?usp=sharing)

Laravel ecommerce project for selling watches with:

1. Storefront pages (home, products, product detail, cart, checkout, contact)
2. Admin panel with authentication and role protection
3. Product, order, order item, and user management
4. Server-side Yajra DataTables in admin pages
5. Session-based cart and checkout order placement
6. Contact / support form: messages stored in the database, emailed to the owner (`MAIL_CONTACT_TO`), and listed under **Admin → Messages**

## Tech Stack

1. Laravel 11
2. PHP 8.2+
3. MySQL/MariaDB (XAMPP)
4. Blade templates
5. Yajra DataTables

## One-Time Setup

1. Start Apache and MySQL in XAMPP Control Panel.
2. Open project folder in terminal.
3. Install PHP dependencies:

composer install

4. Install frontend dependencies:

npm install

5. Build frontend assets:

npm run build

6. Create environment file if missing:

copy .env.example .env

7. Generate app key:

php artisan key:generate

8. Create MySQL database from phpMyAdmin, for example ecommerce_web.

9. Configure database in [.env](.env):

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_web
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci

10. Run migrations:

php artisan migrate

11. Seed demo data:

php artisan db:seed

## Run Project

1. Start Laravel server:

php artisan serve

2. (Optional) In another terminal, run Vite for hot reload during frontend work:

npm run dev

3. Open browser:

http://127.0.0.1:8000

## Demo Accounts

1. Admin

Email: admin@watchstore.test

Password: password

2. Customer

Email: customer@watchstore.test

Password: password

## Contact Form Mail Setup

Current target recipient:

MAIL_CONTACT_TO in [.env](.env)

### Option A: Mailtrap (recommended for class/testing)

1. Create a Mailtrap inbox.
2. Copy SMTP credentials into [.env](.env):

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@watchstore.test
MAIL_FROM_NAME="WatchStore"
MAIL_CONTACT_TO="shahzaib.appdev@mail.com"

3. Clear config cache:

php artisan config:clear

### Option B: Real SMTP (Gmail or another provider)

1. Set SMTP host/port/username/password in [.env](.env).
2. Keep MAIL_CONTACT_TO="shahzaib.appdev@mail.com".
3. Run:

php artisan config:clear

## Admin DataTables Pages

1. Products: /admin/products
2. Orders: /admin/orders
3. Order Items: /admin/order-items
4. Users: /admin/users
5. Support messages (contact form inbox): /admin/contact-messages

## Common Errors and Fixes

1. composer is not recognized

Cause: Composer is not in PATH.

Fix: Install Composer and restart terminal, or use full path to composer.bat.

2. php is not recognized

Cause: PHP not in PATH.

Fix: Add XAMPP PHP path to PATH, usually C:\xampp\php.

3. Unknown collation utf8mb4_0900_ai_ci

Cause: MySQL 8 collation used with MariaDB/XAMPP.

Fix: In [.env](.env), set DB_COLLATION=utf8mb4_unicode_ci and run php artisan config:clear.

4. SQLSTATE Access denied for user root

Cause: Wrong DB credentials.

Fix: Update DB_USERNAME and DB_PASSWORD in [.env](.env), then run php artisan config:clear.

5. Vite manifest not found

Cause: Frontend assets not built.

Fix: Run npm install then npm run build.

6. Contact form submits but email not received

Cause: MAIL_MAILER=log or incorrect SMTP credentials.

Fix: Configure SMTP in [.env](.env), run php artisan config:clear, then test again.

## Extra Software or Extensions

Required:

1. PHP
2. Composer
3. XAMPP
4. Node.js and npm

Useful optional tools:

1. phpMyAdmin (included with XAMPP)
2. Mailtrap account for testing mail
3. VS Code extension: Laravel Extension Pack

## Important Project Files

1. Routes: [routes/web.php](routes/web.php)
2. Mail config: [config/mail.php](config/mail.php)
3. Contact controller: [app/Http/Controllers/ContactController.php](app/Http/Controllers/ContactController.php)
4. Contact mailable: [app/Mail/ContactFormMail.php](app/Mail/ContactFormMail.php)
5. Contact page: [resources/views/store/contact.blade.php](resources/views/store/contact.blade.php)
6. Contact messages model: [app/Models/ContactMessage.php](app/Models/ContactMessage.php)
7. Admin support messages: [app/Http/Controllers/Admin/ContactMessageController.php](app/Http/Controllers/Admin/ContactMessageController.php)
8. Store layout (header, nav): [resources/views/components/layouts/store.blade.php](resources/views/components/layouts/store.blade.php)
9. Admin dashboard: [resources/views/admin/dashboard.blade.php](resources/views/admin/dashboard.blade.php)
