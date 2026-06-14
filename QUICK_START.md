# ⚡ QUICK START - EXACT TERMINAL COMMANDS

## 📍 Current Location
```
c:\DEV\p..1\cafeteria-management-system
```

---

## 🚀 THREE SIMPLE STEPS TO GO LIVE

### **STEP 1: Set Up Database**

**Copy & Paste This Command:**

```cmd
cd c:\DEV\p..1\cafeteria-management-system && setup.bat
```

**What happens:**
- ✅ Database "cafeteria" created
- ✅ 7 tables created
- ✅ Test data seeded
- ✅ 3 test users added

**Expected time:** 5 seconds

---

### **STEP 2: Start Server**

**Copy & Paste This Command:**

```cmd
cd c:\DEV\p..1\cafeteria-management-system && php -S localhost:8000 -t public
```

Or use the batch file:

```cmd
cd c:\DEV\p..1\cafeteria-management-system && start-server.bat
```

**What happens:**
- ✅ PHP development server starts
- ✅ Listens on localhost:8000
- ✅ Auto-routes all requests to public/index.php

**Expected output:**
```
[Sun Jun 14 12:00:00 2026] PHP 8.0.x Development Server started at http://localhost:8000
[Sun Jun 14 12:00:00 2026] Listening on http://localhost:8000
[Sun Jun 14 12:00:00 2026] Document root is /c/DEV/p..1/cafeteria-management-system/public
```

**Keep this window open!** Server will stop if you close it.

---

### **STEP 3: Login to Application**

**Open Browser:**

```
http://localhost:8000/login
```

**Test Credentials:**

**Employee:**
```
Email:    sara.ahmed@company.com
Password: password
```

**Admin:**
```
Email:    admin@cafeteria.com
Password: password
```

---

## 📋 VERIFICATION COMMANDS

### Verify MySQL Connection
```cmd
mysql -u root -e "SELECT 1;"
```
Expected: `1`

### Verify Database Exists
```cmd
mysql -u root -e "SHOW DATABASES LIKE 'cafeteria';"
```
Expected: `cafeteria`

### Verify Tables Created
```cmd
mysql -u root cafeteria -e "SHOW TABLES;"
```
Expected: 7 tables

### Verify Test Users
```cmd
mysql -u root cafeteria -e "SELECT email, role FROM users;"
```
Expected:
```
admin@cafeteria.com       | admin
sara.ahmed@company.com    | user
test@company.com          | user
```

### Check Server is Running
```cmd
curl http://localhost:8000/login
```
Expected: HTML response (login page)

---

## 🎯 TEST CHECKLIST

After logging in, test these:

### Employee (sara.ahmed@company.com):
```
✅ /login              - Login page
✅ /home               - See orders menu
✅ /my-orders          - View my orders
✅ /profile            - View profile
✅ /logout             - Logout
```

### Admin (admin@cafeteria.com):
```
✅ /login              - Login page
✅ /dashboard          - Admin dashboard
✅ /orders             - View all orders
✅ /products           - Manage products
✅ /categories         - Manage categories
✅ /users              - Manage users
✅ /reports            - View reports
✅ /logout             - Logout
```

---

## 🛑 STOP SERVER

To stop the PHP server:

**In Command Prompt:**
```
Press Ctrl + C
```

Server will stop and you'll see:
```
[*] Shutdown
```

---

## 🔄 RESTART SERVER

If you need to restart:

1. Stop current server: `Ctrl + C`
2. Restart: `php -S localhost:8000 -t public`

---

## 📱 ACCESS FROM OTHER DEVICES

If you want to access from another computer on the same network:

```
http://{YOUR_IP}:8000/login
```

Find your IP:
```cmd
ipconfig
```

Look for "IPv4 Address" (usually 192.168.x.x)

---

## 💡 USEFUL DEBUGGING COMMANDS

### See Server Logs
```cmd
cd c:\DEV\p..1\cafeteria-management-system
php -S localhost:8000 -t public -d error_reporting=E_ALL
```

### See All Database Users
```cmd
mysql -u root cafeteria -e "SELECT id, name, email, role, created_at FROM users;"
```

### See All Orders
```cmd
mysql -u root cafeteria -e "SELECT o.id, u.email, o.status, o.total_amount FROM orders o JOIN users u ON o.user_id = u.id;"
```

### Clear All Sessions (if stuck)
Restart the server (step 1 above)

---

## ⚠️ COMMON ISSUES & QUICK FIXES

| Issue | Fix |
|-------|-----|
| "MySQL not found" | Add MySQL to PATH (see SETUP_GUIDE.md) |
| "PHP not found" | Add PHP to PATH (see SETUP_GUIDE.md) |
| "Cannot connect database" | Run: `mysql -u root -e "SELECT 1;"` |
| "Login fails" | Clear browser cache (Ctrl+Shift+Del) |
| "404 on routes" | Restart server, check routes.php |
| "Session lost" | Restart server, check cookies enabled |
| "Port 8000 in use" | Use different port: `php -S localhost:8001 -t public` |

---

## 🎓 LEARNING THE STRUCTURE

### Main Files to Understand

1. **Entry Point:** `public/index.php` - Starts the app
2. **Routes:** `routes.php` - Defines all URLs
3. **Config:** `config.php` - Database settings
4. **Controllers:** `controllers/` - Handle requests
5. **Views:** `views/` - Display HTML
6. **Core:** `core/` - Framework classes

### Creating a New Route

1. Add to `routes.php`:
   ```php
   $router->get('/new-page', 'controllers/new-page.php');
   ```

2. Create `controllers/new-page.php`:
   ```php
   <?php
   userOnly(); // Optional: require login
   view('new-page.view.php', $data);
   ```

3. Create `views/new-page.view.php`:
   ```php
   <?php require base_path('views/partials/head.php'); ?>
   <!-- Your HTML here -->
   <?php require base_path('views/partials/footer.php'); ?>
   ```

---

## 📞 NEED HELP?

Check these files:
- `SETUP_GUIDE.md` - Detailed setup instructions
- `GO_LIVE_CHECKLIST.md` - Full verification checklist
- `public/index.php` - Application entry point
- `routes.php` - All available routes
- `config.php` - Database configuration

---

**Status: ✅ READY TO GO LIVE**

**Time to production: ~2 minutes**

