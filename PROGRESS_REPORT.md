# Cafeteria Management System – Progress Report

## Project Status

The project foundation and authentication module have been completed and pushed to the repository.

---

# Completed Work

## 1. Project Structure

Implemented a custom MVC architecture using PHP.

### Structure

```text
Controllers/
Core/
Views/
public/
routes.php
config.php
```

### Core Components

* Router
* Database Class (PDO)
* Session Management
* Helper Functions
* View Rendering System
* Authorization Helpers

---

## 2. Database Design

Created and finalized database schema.

### Tables

* users
* rooms
* categories
* products
* orders
* order_items

### Removed

* password_resets table
* unnecessary order fields

### Relationships

Users → Rooms

Products → Categories

Orders → Users

Orders → Rooms

Order Items → Orders

Order Items → Products

---

## 3. Authentication Module

### Login

Implemented:

* Login form
* User lookup by email
* Password verification using password_verify()
* Session creation after successful login

### Session Data

```php
[
    'id',
    'name',
    'email',
    'role'
]
```

### Role-Based Redirection

Admin:

```text
/dashboard
```

User:

```text
/home
```

---

## 4. Authorization

Protected pages from unauthorized access.

Implemented:

* Authentication checks
* Role checks
* Redirect to login when session does not exist

---

## 5. Logout

Implemented logout functionality.

Features:

* Session destruction
* Redirect to login page
* Browser cache prevention

Users cannot access protected pages after logout.

---

## 6. Forgot Password

Implemented custom password reset flow.

### Step 1

Forgot Password page

User enters email.

System verifies email existence.

### Step 2

Reset Password page

User enters:

* New Password
* Confirm Password

### Step 3

Password is hashed using:

```php
password_hash()
```

Database is updated.

User is redirected back to login page.

---

## 7. Profile Page

Implemented profile page.

Displayed information:

* Name
* Email
* Role
* Extension
* Room Number

Room data is retrieved using JOIN.

---

## 8. Dynamic Sidebar

Sidebar user information is no longer static.

Now displays:

* User initials
* User name
* User role

Data is loaded from session.

---

## 9. Dynamic Navbar

Navbar now displays current authenticated user information.

Removed hardcoded values.

---

## 10. Dashboard Improvements

Implemented dashboard statistics.

Current statistics:

* Products Count
* Categories Count
* Users Count
* Orders Count
* Processing Orders Count

Implemented Recent Orders section.

Data is loaded directly from database.

---

## 11. Database Seed Data

Created sample data for:

* Rooms
* Users
* Categories
* Products
* Orders
* Order Items

Default Password:

```text
123456
```

---

# Git Workflow

## First Time Setup

```bash
git clone <repository-url>

cd cafeteria-management-system

git checkout develop
```

---

## Daily Workflow

```bash
git checkout develop

git pull origin develop

git checkout feature/<module-name>
```

---

## Before Starting Work

Always update develop first:

```bash
git checkout develop

git pull origin develop
```

---

## Commit Convention

Feature:

```bash
feat: add product management
```

Bug Fix:

```bash
fix: resolve login validation issue
```

Refactor:

```bash
refactor: improve dashboard queries
```

Documentation:

```bash
docs: update project setup guide
```

---

## Push Changes

```bash
git add .

git commit -m "feat: your message"

git push origin feature/<module-name>
```

---

# Existing Branches

```text
develop

feature/auth
feature/products
feature/categories
feature/orders
feature/users
feature/reports
```

---

# Important Notes

* Do not push directly to main.
* Work only on assigned feature branches.
* Pull latest develop before starting any task.
* Use meaningful commit messages.
* Keep code style consistent with the existing MVC structure.
* Reuse existing Database, Session, Router, and Helper classes.

---

# Current Project Status

Completed:

* MVC Structure
* Database Design
* Authentication
* Authorization
* Session Management
* Profile Page
* Dashboard Statistics
* Forgot Password
* Logout

Remaining Modules:

* Products Management
* Categories Management
* Users Management
* Orders Management
* Reports Module

Project is ready for team development.
