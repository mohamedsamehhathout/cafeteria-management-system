# 🚀 CAFETERIA MANAGEMENT SYSTEM - COMPLETE SETUP GUIDE

## ✅ Pre-Setup Checklist

Before starting, ensure you have:
- [ ] MySQL/MariaDB installed and running
- [ ] PHP 7.4+ installed
- [ ] Git Bash or Command Prompt available
- [ ] This project folder accessible

---

## 📋 STEP 1: Set Up MySQL/MariaDB in PATH (Windows)

### For XAMPP Users:
```
1. Open Environment Variables:
   - Press Win + R
   - Type: sysdm.cpl
   - Click "Environment Variables"

2. Add XAMPP MySQL to PATH:
   - Click "New" under System variables
   - Variable name: PATH
   - Variable value: C:\xampp\mysql\bin
   - Click OK, OK, OK

3. Test:
   - Open new Command Prompt
   - Type: mysql --version
   - Should show version info
```

### For Installed MySQL:
```
Add to PATH: C:\Program Files\MySQL\MySQL Server 8.0\bin
Or for MariaDB: C:\Program Files\MariaDB 10.x\bin
```

### For Installed PHP:
```
If PHP not in PATH, add:
- For XAMPP: C:\xampp\php
- For standalone: C:\Program Files\PHP\php-x.x.x
```

---

## 🗄️ STEP 2: Set Up Database

### Option A: Automated (Recommended)
```bash
cd c:\DEV\p..1\cafeteria-management-system
setup.bat
```

### Option B: Manual
```bash
# Create database
mysql -u root -e "DROP DATABASE IF EXISTS cafeteria; CREATE DATABASE cafeteria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import schema
mysql -u root cafeteria < database/schema.sql

# Seed test data
mysql -u root cafeteria < database/seed.sql

# Verify
mysql -u root cafeteria -e "SELECT COUNT(*) FROM users;"
```

---

## 🔧 STEP 3: Verify Database Configuration

The configuration is in **config.php**:

```php
[
    "host"    => "localhost",
    "dbname"  => "cafeteria",
    "port"    => 3306,
    "user"    => "root",
    "charset" => "utf8mb4"
]
```

**If you have a MySQL password**, edit **config.php** and add:
```php
"password" => "your_password"
```

Then also edit **database/schema.sql** and **database/seed.sql** - add password to mysql commands:
```bash
mysql -u root -p"your_password" cafeteria < file.sql
```

---

## 🚀 STEP 4: Start the Server

### Option A: Automated (Recommended)
```bash
cd c:\DEV\p..1\cafeteria-management-system
start-server.bat
```

### Option B: Manual Command
```bash
cd c:\DEV\p..1\cafeteria-management-system
php -S localhost:8000 -t public
```

---

## 🔐 STEP 5: Login & Test

Open your browser and go to:
```
http://localhost:8000/login
```

### Test Credentials:

**Employee Account:**
- Email: `sara.ahmed@company.com`
- Password: `password`

**Admin Account:**
- Email: `admin@cafeteria.com`
- Password: `password`

---

## 📊 STEP 6: Verify All Routes Work

After logging in, test these routes:

### Employee Routes:
- ✅ `/home` - Order menu
- ✅ `/my-orders` - View my orders
- ✅ `/profile` - Profile page

### Admin Routes (use admin account):
- ✅ `/dashboard` - Admin dashboard
- ✅ `/orders` - All orders
- ✅ `/products` - Product management
- ✅ `/categories` - Category management
- ✅ `/users` - User management
- ✅ `/reports` - Reports

---

## 🔍 Troubleshooting

### ❌ "MySQL is not in PATH"
**Solution:** Add MySQL to Windows PATH (see Step 1)

### ❌ "Cannot connect to database"
**Solution:** 
1. Ensure MySQL is running: `mysql -u root -e "SELECT 1;"`
2. Check config.php has correct credentials
3. Database name must be `cafeteria`

### ❌ "Login fails but no error message"
**Solution:**
1. Verify users exist: `mysql -u root cafeteria -e "SELECT * FROM users;"`
2. Clear browser cache (Ctrl+Shift+Del)
3. Check server is running

### ❌ "404 Not Found on routes"
**Solution:**
1. Server must start with: `php -S localhost:8000 -t public`
2. Check .htaccess is in public folder
3. Verify routes.php has the route defined

### ❌ "PHP not found"
**Solution:** Add PHP to PATH (see Step 1)

---

## 📁 Project Structure

```
cafeteria-management-system/
├── public/
│   ├── index.php          (Main entry point)
│   ├── .htaccess          (URL rewriting)
│   └── css/
├── controllers/           (Request handlers)
│   ├── auth/
│   ├── admin/
│   ├── orders/
│   └── ...
├── views/                 (UI templates)
│   ├── auth/
│   ├── admin/
│   ├── orders/
│   └── partials/
├── core/                  (Framework)
│   ├── Database.php
│   ├── Router.php
│   ├── Auth.php
│   ├── Session.php
│   └── functions.php
├── database/
│   ├── schema.sql         (Database structure)
│   └── seed.sql           (Test data)
├── config.php             (Database config)
├── .env                   (Environment variables)
├── routes.php             (Route definitions)
├── setup.bat              (Database setup)
└── start-server.bat       (Start development server)
```

---

## 🎯 Common Tasks

### Create a New Route:
1. Add to `routes.php`:
   ```php
   $router->get('/new-page', 'controllers/new-page.php');
   ```

2. Create `controllers/new-page.php`:
   ```php
   <?php
   view('new-page.view.php');
   ```

3. Create `views/new-page.view.php` with HTML

### Add Authentication Check:
```php
<?php
userOnly(); // Redirects to login if not authenticated
adminOnly(); // Redirects to login if not admin
```

### Query Database:
```php
<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config);

$users = $db
    ->query("SELECT * FROM users WHERE role = :role", ['role' => 'admin'])
    ->get();
```

---

## 🔒 Security Notes

⚠️ **For Development Only** - This setup is for development. For production:
1. Use environment-based configuration
2. Hash passwords with bcrypt (already done)
3. Add CSRF protection
4. Use HTTPS
5. Add input validation/sanitization
6. Implement rate limiting

---

## 📞 Support

For issues:
1. Check PHP error logs
2. Check MySQL error logs
3. Use `dd($variable)` to debug (dumps and dies)
4. Check browser console for frontend errors

---

**Happy coding! 🎉**
