
# 🍽️ Cafeteria Management System

### A University Project — Built with Pure PHP, MySQL & PDO

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Git](https://img.shields.io/badge/Git-Flow-F05032?style=for-the-badge&logo=git&logoColor=white)](https://git-scm.com/)
[![License](https://img.shields.io/badge/License-Academic-blue?style=for-the-badge)](./LICENSE)

---

*A full-stack web application for managing cafeteria orders, products, users, and reports — built from scratch using native PHP with an MVC-inspired architecture.*



---

## 📋 Table of Contents

1. [Project Overview](#-1-project-overview)
2. [Team Workflow](#-2-team-workflow)
3. [Branch Strategy](#-3-branch-strategy)
4. [First-Time Setup](#-4-first-time-setup--read-before-touching-any-code)
5. [Daily Workflow](#-5-daily-workflow--do-this-every-single-day)
6. [Commit Rules](#-6-commit-rules)
7. [Push Rules](#-7-push-rules)
8. [Pull Request Workflow](#-8-pull-request-workflow)
9. [Team Responsibilities](#-9-team-responsibilities)
10. [Project Coding Rules](#-10-project-coding-rules)
11. [Database Setup](#-11-database-setup)
12. [Troubleshooting](#-12-troubleshooting)
13. [Git Commands Cheat Sheet](#-13-git-commands-cheat-sheet)
14. [Development Roadmap](#-14-development-roadmap)

---

## 🎯 1. Project Overview

### What Is This Project?

The **Cafeteria Management System** is a web-based application developed as a university project. It enables a cafeteria to manage its daily operations digitally — replacing manual paper-based processes with a clean, role-based web interface.

### Core Objectives

| # | Objective |
|---|-----------|
| 1 | Allow users to browse the cafeteria menu and place orders online |
| 2 | Allow administrators to manage products, categories, and users |
| 3 | Provide admins with a real-time view of current orders |
| 4 | Enable admins to generate reports and summaries of orders |
| 5 | Implement secure, session-based authentication with role separation |
| 6 | Build the entire system without a framework — using pure PHP and PDO |

### System Roles

```
┌─────────────────────────────────────────────────────────────────┐
│                     SYSTEM ROLES                                │
├────────────────────┬────────────────────────────────────────────┤
│  👤 Regular User   │  Browse menu, place orders, view history,  │
│                    │  cancel pending orders                      │
├────────────────────┼────────────────────────────────────────────┤
│  🔑 Admin          │  Full CRUD on products, categories, users  │
│                    │  Manage orders, create manual orders,       │
│                    │  access reports and checks                  │
└────────────────────┴────────────────────────────────────────────┘
```

### Tech Stack

| Layer           | Technology                                      |
| --------------- | ----------------------------------------------- |
| Backend         | PHP 8.x (Pure PHP, No Framework)                |
| Database        | MySQL 8.x                                       |
| DB Access       | PDO with Prepared Statements                    |
| Frontend        | HTML5, CSS3, JavaScript                         |
| UI Framework    | Bootstrap 5                                     |
| Architecture    | Front Controller + Custom Router (MVC-inspired) |
| Local Server    | Laragon                                         |
| Version Control | Git & GitHub                                    |

### Project Structure

```
cafeteria-management-system/
│
├── public/                  ← Web root — only folder exposed to browser
│   ├── index.php            ← Front Controller (single entry point)
│   ├── .htaccess            ← Rewrites all requests to index.php
│   ├── css/
│   ├── js/
│   └── uploads/products/
│
├── Core/                    ← Infrastructure classes (DO NOT EDIT without approval)
│   ├── Database.php
│   ├── Router.php
│   ├── Session.php
│   ├── Validator.php
│   ├── Response.php
│   ├── Auth.php
│   └── functions.php
│
├── Controllers/             ← One file per action
│   ├── auth/
│   ├── products/
│   ├── categories/
│   ├── users/
│   ├── orders/
│   └── reports/
│
├── views/                   ← HTML templates
│   ├── partials/            ← Shared layout pieces
│   ├── errors/
│   ├── auth/
│   ├── products/
│   ├── categories/
│   ├── users/
│   ├── orders/
│   └── reports/
│
├── database/
│   ├── schema.sql           ← Table definitions
│   └── seed.sql             ← Sample data
│
├── config.php               ← DB credentials & app settings
├── routes.php               ← All route definitions
└── README.md
```

---

## 👥 2. Team Workflow

### How the Team Collaborates

This project follows a **feature branch workflow**. Each team member works on their own branch and never pushes directly to `main` or `develop`.

```
main  ←─────────── develop  ←────────────────────────────────────
                      ↑          ↑          ↑          ↑
                 feature/  feature/  feature/  feature/
                   auth    products  orders    reports
```

### The Golden Rules

> 🔴 **NEVER** push directly to `main`
> 🔴 **NEVER** push directly to `develop`
> 🟡 **ALWAYS** pull from `develop` before starting work each day
> 🟡 **ALWAYS** test your code before pushing
> 🟢 **ALWAYS** open a Pull Request to merge your feature into `develop`
> 🟢 **ALWAYS** write meaningful commit messages

### Communication Rules

- If you are about to edit a **shared file** (navbar, sidebar, head, footer, config), announce it in the group first
- If you encounter a **merge conflict**, do not resolve it alone — ask the team lead
- If you are **done with a feature**, open a Pull Request and notify the team

---

## 🌿 3. Branch Strategy

### Branch Overview

| Branch | Type | Purpose | Who Works Here |
|--------|------|---------|----------------|
| `main` | Protected | Stable, production-ready code. Only receives merges from `develop` after full review | Team Lead only |
| `develop` | Integration | All completed features merge here first. This is the "staging" branch | All members (via PR) |
| `feature/auth` | Feature | Login, Logout, Forgot Password, Password Reset | Member 1 |
| `feature/products` | Feature | Products CRUD, image upload, category linking | Member 2 |
| `feature/categories` | Feature | Categories CRUD | Member 3 |
| `feature/users` | Feature | Users CRUD, role management | Member 4 |
| `feature/orders` | Feature | User order flow + Admin order management | Member 5 |
| `feature/reports` | Feature | Reports, checks, CSV export | Member 6 |

### Branch Lifecycle

```
1. Branch created from develop
        ↓
2. Member codes their feature
        ↓
3. Member pushes to their feature branch
        ↓
4. Member opens a Pull Request → develop
        ↓
5. Team Lead reviews & approves
        ↓
6. Merged into develop
        ↓
7. At project completion, develop → main
```

### Branch Naming Convention

```bash
# Feature branches — always lowercase with hyphens
feature/auth
feature/products
feature/categories
feature/users
feature/orders
feature/reports

# Bug fix branches (if needed)
fix/login-redirect
fix/cart-total-calculation

# Hotfix on main (if needed)
hotfix/session-security
```

---

## 🚀 4. First-Time Setup ⚠️ READ BEFORE TOUCHING ANY CODE

> **This section is for every team member setting up the project for the first time.**
> Follow every step in order. Do not skip any step.

---

### Step 1 — Install Required Software

#### 1A. Install Laragon

1. Go to [https://laragon.org/download/](https://laragon.org/download/)
2. Download **Laragon Full** (includes Apache, MySQL, PHP)
3. Run the installer and follow the wizard
4. After installation, open **Laragon** from your desktop
5. Click **Start All** — both Apache and MySQL should turn green ✅

> **Verify:** Open your browser and visit `http://localhost` — you should see the Laragon welcome page.

#### 1B. Install Git

1. Go to [https://git-scm.com/downloads](https://git-scm.com/downloads)
2. Download and install **Git for Windows**
3. During installation, select **"Git Bash Here"** option ✅
4. Leave all other settings as default

> **Verify:** Right-click anywhere on your Desktop → you should see **"Git Bash Here"** in the menu.

---

### Step 2 — Clone the Repository

1. Go to the GitHub repository page
2. Click the green **`<> Code`** button
3. Copy the HTTPS URL

Then open **Git Bash** and run:

```bash
# Navigate to Laragon's www folder (where all projects live)
cd /c/laragon/www

# Clone the project
git clone https://github.com/YOUR_ORG/cafeteria-management-system.git

# Enter the project folder
cd cafeteria-management-system
```

> ✅ You should now see all project files in `C:\laragon\www\cafeteria-management-system\`

---

### Step 3 — View All Available Branches

After cloning, see all branches that exist on GitHub:

```bash
# List all remote branches
git branch -a
```

You should see output like:

```
* main
  remotes/origin/main
  remotes/origin/develop
  remotes/origin/feature/auth
  remotes/origin/feature/products
  remotes/origin/feature/categories
  remotes/origin/feature/users
  remotes/origin/feature/orders
  remotes/origin/feature/reports
```

---

### Step 4 — Set Up Your Feature Branch

Switch to your **assigned feature branch** (ask the team lead which one is yours):

```bash
# Switch to the develop branch first
git checkout develop

# Pull the latest code from develop
git pull origin develop

# Switch to your assigned feature branch
# Replace "feature/auth" with YOUR branch name
git checkout feature/auth

# Pull the latest code for your branch
git pull origin feature/auth
```

> ✅ You are now on your personal feature branch and ready to code.

---

### Step 5 — Set Up the Database

See the full [Database Setup](#-11-database-setup) section below.

---

### Step 6 — Open the Project in Your Browser

1. Make sure **Laragon is running** (click Start All)
2. Open your browser
3. Visit: `http://localhost/cafeteria-management-system/public/`

> ✅ The project home page should appear.

---

### Step 7 — Open the Project in Your Code Editor

1. Open **VS Code** (or any editor)
2. File → Open Folder
3. Select `C:\laragon\www\cafeteria-management-system\`

> 💡 Install the **PHP Intelephense** extension in VS Code for PHP autocomplete.

---

## 📅 5. Daily Workflow ⚠️ DO THIS EVERY SINGLE DAY

> **Every day before you write a single line of code, follow these steps.**
> This keeps your branch up to date and prevents conflicts.

---

```
┌──────────────────────────────────────────────────────────────┐
│                   DAILY START ROUTINE                        │
│                                                              │
│  Step 1 → Open Git Bash                                      │
│  Step 2 → Navigate to project folder                         │
│  Step 3 → Switch to develop & pull latest                    │
│  Step 4 → Switch to your feature branch                      │
│  Step 5 → Merge develop into your branch                     │
│  Step 6 → Start Laragon & start coding                       │
│  Step 7 → Commit & push your work before you stop            │
└──────────────────────────────────────────────────────────────┘
```

---

### Step 1 — Open Git Bash

Right-click on your Desktop → **Git Bash Here**

---

### Step 2 — Navigate to the Project Folder

```bash
cd /c/laragon/www/cafeteria-management-system
```

Confirm you are in the right place:

```bash
ls
# You should see: public/ Core/ Controllers/ views/ config.php routes.php ...
```

---

### Step 3 — Switch to `develop` and Pull Latest Changes

```bash
git checkout develop
git pull origin develop
```

> This downloads any work your teammates pushed yesterday.

---

### Step 4 — Switch to Your Feature Branch

```bash
# Replace "feature/auth" with YOUR branch
git checkout feature/auth
```

---

### Step 5 — Merge `develop` Into Your Branch

This brings the latest changes from your teammates into your branch:

```bash
git merge develop
```

> If there are no conflicts, you will see: `Already up to date.` or a merge commit message.
> If there ARE conflicts, see the [Troubleshooting](#-12-troubleshooting) section.

---

### Step 6 — Start Laragon and Start Coding

1. Open **Laragon** → Click **Start All**
2. Open your code editor
3. Write your code ✍️

---

### Step 7 — Commit & Push Before You Stop

At the end of your session (or whenever you finish a meaningful piece of work):

```bash
# See what files you changed
git status

# Stage all your changes
git add .

# Commit with a descriptive message
git commit -m "feat(auth): implement login form with session creation"

# Push to your feature branch on GitHub
git push origin feature/auth
```

> 🔒 Never stop working without pushing. If your computer crashes, your unpushed work is gone.

---

## ✍️ 6. Commit Rules

### Commit Message Format

Every commit message **must** follow this format:

```
type(scope): short description in lowercase
```

| Part | Description | Example |
|------|-------------|---------|
| `type` | Category of change | `feat`, `fix`, `style`, `docs`, `db` |
| `scope` | Module affected | `auth`, `products`, `orders`, `core` |
| `description` | What you did, in plain English | `add login form validation` |

---

### Commit Types

| Type | When to Use | Example |
|------|-------------|---------|
| `feat` | New feature or functionality | `feat(auth): create login controller` |
| `fix` | Bug fix | `fix(orders): correct total price calculation` |
| `style` | CSS, layout, UI changes (no logic) | `style(products): improve card hover effect` |
| `docs` | README or documentation changes | `docs: update daily workflow section` |
| `db` | Database changes (schema, seed) | `db: add status column to orders table` |
| `refactor` | Code improvement without changing behavior | `refactor(core): simplify Database singleton` |
| `test` | Testing related | `test(auth): verify session expiry behavior` |
| `chore` | Config, tooling, non-code changes | `chore: update .gitignore` |

---

### ✅ Good Commit Examples

```bash
# Authentication
git commit -m "feat(auth): create login form and session handler"
git commit -m "feat(auth): add logout route and session destroy"
git commit -m "feat(auth): implement forgot password token generation"
git commit -m "fix(auth): resolve redirect loop after login"
git commit -m "fix(auth): fix validation not showing on wrong password"

# Products
git commit -m "feat(products): build product list view with category filter"
git commit -m "feat(products): implement image upload with validation"
git commit -m "feat(products): add create product form and store controller"
git commit -m "fix(products): prevent duplicate product names"
git commit -m "style(products): fix broken layout on mobile screen"

# Categories
git commit -m "feat(categories): create categories CRUD controllers"
git commit -m "feat(categories): block deletion if products are assigned"
git commit -m "fix(categories): fix empty name validation"

# Users
git commit -m "feat(users): add user list with role badge display"
git commit -m "feat(users): implement password hashing on user creation"
git commit -m "fix(users): prevent admin from deleting own account"

# Orders
git commit -m "feat(orders): build home page with product browsing"
git commit -m "feat(orders): implement order placement with DB transaction"
git commit -m "feat(orders): add cancel order for pending status only"
git commit -m "feat(orders): create admin manual order form"

# Reports
git commit -m "feat(reports): build date range order filter"
git commit -m "feat(reports): implement CSV export functionality"

# Database
git commit -m "db: create orders and order_items tables"
git commit -m "db: add seed data for categories and products"
git commit -m "db: add index on orders.status column"

# Style / Docs
git commit -m "style(layout): fix sidebar collapse on small screens"
git commit -m "docs: add database setup instructions to README"
```

### ❌ Bad Commit Examples — Never Do This

```bash
git commit -m "update"           # ❌ Tells nothing
git commit -m "fix"              # ❌ Fix what?
git commit -m "asdfgh"           # ❌ Meaningless
git commit -m "DONE FINALLY"     # ❌ Unprofessional
git commit -m "changed stuff"    # ❌ Too vague
git commit -m "wip"              # ❌ Never commit "work in progress" as a push
```

---

## 📤 7. Push Rules

### When to Push

| Situation | Should You Push? |
|-----------|-----------------|
| Finished a complete feature (form, controller, view) | ✅ Yes, push immediately |
| Fixed a bug | ✅ Yes, push immediately |
| End of your coding session for the day | ✅ Yes, always push before closing |
| Middle of writing a function (code is broken) | ❌ No, finish it first |
| Something doesn't work and you haven't tested | ❌ No, fix it first |
| Pushing a file with your DB password in plain text | ❌ Absolutely not |

### How Often to Push

> Push **at least once per coding session**. Ideally, push every time you complete a meaningful piece of work — a form, a controller, a view, a bug fix.

### Push Commands

```bash
# 1. Check what files changed
git status

# 2. See the actual code changes (optional but recommended)
git diff

# 3. Stage all changed files
git add .

# 4. Or stage a specific file only
git add Controllers/auth/store.php

# 5. Commit your staged changes
git commit -m "feat(auth): add login session creation"

# 6. Push to YOUR feature branch (never to main or develop directly)
git push origin feature/auth
```

### Before Every Push — Checklist

```
□ Does the page load without PHP errors?
□ Does the feature work as expected?
□ Did you test with both valid and invalid inputs?
□ Is config.php excluded from your commit (check .gitignore)?
□ Are there no debug dd() or var_dump() calls left in the code?
□ Is your commit message descriptive and follows the convention?
```

### What NEVER to Push

```bash
# These should be in .gitignore and NEVER committed:
config.php          # Contains DB passwords
.env                # Environment secrets
/uploads/*          # User-uploaded files
/vendor/*           # Composer dependencies (if used)
*.log               # Log files
.DS_Store           # Mac system files
Thumbs.db           # Windows system files
```

---

## 🔀 8. Pull Request Workflow

### The Flow

```
feature/auth  ──→  Pull Request  ──→  develop  ──→  Pull Request  ──→  main
                   (your work)         (team review)                  (final)
```

### How to Open a Pull Request

1. Go to the GitHub repository
2. Click the **"Pull requests"** tab
3. Click **"New pull request"**
4. Set:
   - **Base branch:** `develop`
   - **Compare branch:** `feature/auth` (your branch)
5. Click **"Create pull request"**
6. Fill in the PR form:

```
Title:    feat(auth): complete authentication module

Description:
- Implemented login with session creation
- Added logout and session destroy
- Built forgot password with token generation
- Added auth guard on all protected routes

Tested:
- [x] Login with correct credentials → redirects to dashboard
- [x] Login with wrong password → shows error
- [x] Logout destroys session and redirects to /login
- [x] Forgot password generates token in DB
```

7. Assign a **reviewer** (your Team Lead)
8. Click **"Create pull request"** ✅

### Review Process

| Step | Who | Action |
|------|-----|--------|
| Open PR | Feature member | Push code + open PR into `develop` |
| Review | Team Lead | Read the code, leave comments or request changes |
| Fix | Feature member | Address review comments, push fixes |
| Approve | Team Lead | Approves PR after all issues resolved |
| Merge | Team Lead | Merges into `develop` using "Squash and merge" |
| Delete | Team Lead | Deletes the feature branch after merge |
| Final merge | Team Lead | At project end, `develop` → `main` via PR |

### PR Rules

- ✅ Every PR must have at least **1 reviewer approval** before merging
- ✅ The branch must be **up to date with `develop`** before merge
- ❌ Do not merge your own PR without review
- ❌ Do not merge if CI/tests are failing

---

## 👨‍💻 9. Team Responsibilities

### Module Assignment

| Member | Branch | Module | Core Responsibilities |
|--------|--------|--------|-----------------------|
| **Member 1** | `feature/auth` | 🔐 Authentication | Login, Logout, Forgot Password, Password Reset, Session guard, Auth middleware |
| **Member 2** | `feature/products` | 📦 Products | Products CRUD, image upload/validation, category linking, availability toggle |
| **Member 3** | `feature/categories` | 🏷️ Categories | Categories CRUD, prevent deletion if products assigned, dropdown integration |
| **Member 4** | `feature/users` | 👤 Users | Users CRUD, role management, password hashing, prevent self-deletion |
| **Member 5** | `feature/orders` | 🛒 Orders | User order placement, My Orders view, Cancel Order, Admin order queue, Manual order creation |
| **Member 6** | `feature/reports` | 📊 Reports | Order reports by date/user/status, product sales summary, CSV export |

---

### Detailed Responsibilities

<details>
<summary><strong>🔐 Member 1 — Authentication Module</strong></summary>

**Controllers to build:**
- `Controllers/auth/index.php` — Show login form
- `Controllers/auth/store.php` — Validate credentials, create session
- `Controllers/auth/destroy.php` — Destroy session, redirect to login
- `Controllers/auth/forgot.php` — Show forgot password form
- `Controllers/auth/reset.php` — Generate reset token, save to DB

**Views to build:**
- `views/auth/login.php`
- `views/auth/forgot-password.php`

**Security requirements:**
- Use `password_verify()` to check passwords
- Store user ID, name, and role in session
- Redirect admin → `/admin/dashboard`, user → `/`
- All protected routes must call `Auth::requireLogin()`
- All admin routes must call `Auth::requireAdmin()`

</details>

<details>
<summary><strong>📦 Member 2 — Products Module</strong></summary>

**Controllers to build:**
- `Controllers/products/index.php` — List all products (with category join)
- `Controllers/products/create.php` — Show create form (load categories)
- `Controllers/products/store.php` — Validate, upload image, INSERT
- `Controllers/products/edit.php` — Load product by ID, show edit form
- `Controllers/products/update.php` — Validate, update product
- `Controllers/products/destroy.php` — Delete product, remove image file

**Views to build:**
- `views/products/index.php`
- `views/products/create.php`
- `views/products/edit.php`

**Image upload rules:**
- Allowed: jpg, jpeg, png, webp only
- Max size: 2MB
- Use `uniqid()` for filename to avoid collisions
- Store in `public/uploads/products/`

</details>

<details>
<summary><strong>🏷️ Member 3 — Categories Module</strong></summary>

**Controllers to build:**
- `Controllers/categories/index.php`
- `Controllers/categories/create.php`
- `Controllers/categories/store.php`
- `Controllers/categories/edit.php`
- `Controllers/categories/update.php`
- `Controllers/categories/destroy.php`

**Views to build:**
- `views/categories/index.php`
- `views/categories/create.php`
- `views/categories/edit.php`

**Key logic:**
- Show product count per category in the index view
- Block category deletion if products are assigned to it
- Category names must be unique

</details>

<details>
<summary><strong>👤 Member 4 — Users Module</strong></summary>

**Controllers to build:**
- `Controllers/users/index.php`
- `Controllers/users/create.php`
- `Controllers/users/store.php`
- `Controllers/users/edit.php`
- `Controllers/users/update.php`
- `Controllers/users/destroy.php`

**Views to build:**
- `views/users/index.php`
- `views/users/create.php`
- `views/users/edit.php`

**Security requirements:**
- Always use `password_hash(PASSWORD_DEFAULT)` — never store plain passwords
- Validate email is unique before insert
- An admin cannot delete their own account
- Role field must be validated server-side: only `admin` or `user` allowed

</details>

<details>
<summary><strong>🛒 Member 5 — Orders Module</strong></summary>

**Controllers to build:**
- `Controllers/orders/create.php` — Home: browse products by category
- `Controllers/orders/store.php` — Submit new order (DB transaction)
- `Controllers/orders/index.php` — My Orders: user history
- `Controllers/orders/cancel.php` — Cancel pending order
- `Controllers/orders/admin-index.php` — Admin: all current orders
- `Controllers/orders/manual.php` — Admin: manual order form
- `Controllers/orders/manual-store.php` — Admin: submit manual order

**Views to build:**
- `views/orders/home.php`
- `views/orders/my-orders.php`
- `views/orders/admin-orders.php`
- `views/orders/manual.php`

**Key logic:**
- Use DB transactions when inserting orders + order_items
- Calculate total as `SUM(quantity × unit_price)`
- Only `pending` orders can be cancelled

</details>

<details>
<summary><strong>📊 Member 6 — Reports Module</strong></summary>

**Controllers to build:**
- `Controllers/reports/index.php` — Reports overview with filters
- `Controllers/reports/export.php` — CSV export

**Views to build:**
- `views/reports/index.php`

**Report types to implement:**
- Orders by date range
- Orders by user
- Orders by status
- Product sales summary (units sold, revenue)

**CSV Export:**
- Use PHP `fputcsv()` with `Content-Type: text/csv` header
- Filename: `report_YYYY-MM-DD.csv`
- Always include column headers in the first row

</details>

---

## 📏 10. Project Coding Rules

> These rules apply to **everyone**. Breaking these rules = broken project for the whole team.

---

### Architecture Rules

| Rule | Details |
|------|---------|
| ✅ Keep MVC structure | Controllers handle logic. Views display data. Core handles infrastructure. Never mix them. |
| ✅ Thin controllers | A controller file should not exceed ~50 lines. Move complex logic to helper functions. |
| ✅ No HTML in controllers | Controllers must never echo HTML directly. Always load a view. |
| ✅ No PHP logic in views | Views must not contain database queries or business logic. Only display variables. |
| 🔒 Do NOT edit Core/ | Never edit any file in `Core/` without written approval from the Team Lead. |
| 🔒 Do NOT edit shared partials | Never edit `views/partials/` files (navbar, sidebar, head, footer) without notifying the team first. |

### Database Rules

```php
// ✅ CORRECT — Always use PDO prepared statements
$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

// ❌ WRONG — Never interpolate user input into SQL
$result = $db->query("SELECT * FROM products WHERE id = $id"); // SQL INJECTION RISK!
```

### Naming Conventions

| What | Convention | Example |
|------|-----------|---------|
| PHP files | `snake_case.php` | `admin_index.php` |
| PHP functions | `camelCase()` | `getUserById()` |
| PHP variables | `$camelCase` | `$productList` |
| DB table names | `snake_case` (plural) | `order_items` |
| DB column names | `snake_case` | `created_at` |
| CSS classes | `kebab-case` | `.product-card` |
| JS variables | `camelCase` | `const productId` |
| HTML IDs | `kebab-case` | `id="product-form"` |

### Security Rules

```php
// ✅ Always escape output
echo htmlspecialchars($product['name']); // or use e() helper

// ✅ Always hash passwords
$hash = password_hash($password, PASSWORD_DEFAULT);

// ✅ Always verify passwords (never compare plain text)
if (password_verify($input, $hash)) { ... }

// ✅ Validate file uploads server-side
$allowed = ['image/jpeg', 'image/png', 'image/webp'];
if (!in_array($_FILES['image']['type'], $allowed)) {
    // Reject the upload
}

// ✅ Use CSRF tokens on all forms
// Hidden field: <input type="hidden" name="_token" value="<?= Session::token() ?>">
```

### Code Quality Rules

- Write clean, readable code with proper indentation (4 spaces)
- Add a comment above any non-obvious code block
- Remove all `dd()`, `var_dump()`, and `print_r()` before pushing
- Do not leave commented-out dead code in your files
- Every form must have server-side validation — never trust client-side only

---

## 🗄️ 11. Database Setup

### Step 1 — Create the Database

1. Make sure **Laragon is running**
2. Open your browser and go to: `http://localhost/phpmyadmin`
3. Click **"New"** in the left sidebar
4. Enter database name: `cafeteria_db`
5. Select collation: `utf8mb4_unicode_ci`
6. Click **"Create"**

Or use SQL:

```sql
CREATE DATABASE cafeteria_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

### Step 2 — Import the Schema

1. In phpMyAdmin, click on `cafeteria_db`
2. Click the **"Import"** tab
3. Click **"Choose File"** → select `database/schema.sql`
4. Click **"Go"**

Or via command line:

```bash
# Open Git Bash in the project folder
mysql -u root -p cafeteria_db < database/schema.sql
```

### Step 3 — Import Seed Data (Optional but Recommended)

```bash
mysql -u root -p cafeteria_db < database/seed.sql
```

This creates a default admin account and sample categories/products so you can log in immediately.

> **Default admin credentials after seeding:**
> - Email: `admin@cafeteria.com`
> - Password: `Admin@123`

### Step 4 — Configure `config.php`

Open `config.php` and update your database credentials:

```php
<?php

// Application settings
define('APP_URL', 'http://localhost/cafeteria-management-system/public');
define('APP_NAME', 'Cafeteria Management System');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'cafeteria_db');
define('DB_USER', 'root');        // Change this if your MySQL username is different
define('DB_PASS', '');            // Change this if your MySQL has a password
define('DB_CHARSET', 'utf8mb4');
```

> ⚠️ **`config.php` is listed in `.gitignore` and must NEVER be committed to GitHub.** Each developer has their own local copy.

### Database Tables Overview

```
┌─────────────────┐     ┌─────────────────┐
│    users        │     │   categories    │
├─────────────────┤     ├─────────────────┤
│ id              │     │ id              │
│ name            │     │ name            │
│ email           │     │ description     │
│ password        │     │ created_at      │
│ role            │     └────────┬────────┘
│ created_at      │              │
└────────┬────────┘              │
         │                  ┌────▼────────────┐
         │                  │    products     │
         │                  ├─────────────────┤
         │                  │ id              │
         │                  │ category_id (FK)│
         │                  │ name            │
         │                  │ price           │
         │                  │ image           │
         │                  │ status          │
         │                  │ created_at      │
         │                  └────────┬────────┘
         │                           │
    ┌────▼────────────────────────────▼────┐
    │              orders                   │
    ├───────────────────────────────────────┤
    │ id                                    │
    │ user_id (FK → users)                  │
    │ room_id (FK → rooms)                  │
    │ status (pending/processing/completed) │
    │ total                                 │
    │ notes                                 │
    │ created_at                            │
    └────────────────┬──────────────────────┘
                     │
              ┌──────▼──────────┐
              │  order_items    │
              ├─────────────────┤
              │ id              │
              │ order_id (FK)   │
              │ product_id (FK) │
              │ quantity        │
              │ unit_price      │
              └─────────────────┘
```

---

## 🔧 12. Troubleshooting

### 🔴 Git Push Rejected

**Error:**
```
! [rejected]   feature/auth -> feature/auth (non-fast-forward)
error: failed to push some refs
```

**Cause:** Someone else pushed to the same branch, or your local branch is behind.

**Fix:**
```bash
# Pull the latest changes first
git pull origin feature/auth

# Resolve any conflicts if they appear (see Merge Conflicts below)
# Then push again
git push origin feature/auth
```

---

### 🔴 Merge Conflicts

**You will see something like:**
```
CONFLICT (content): Merge conflict in Controllers/orders/store.php
Automatic merge failed; fix conflicts and then commit the result.
```

**Fix:**
```bash
# Step 1: See which files have conflicts
git status

# Step 2: Open the conflicting file in VS Code
# You will see sections like this:
# <<<<<<< HEAD
# Your code here
# =======
# Their code here
# >>>>>>> develop

# Step 3: Edit the file — keep the correct version, delete the markers
# Step 4: Stage the resolved file
git add Controllers/orders/store.php

# Step 5: Complete the merge
git commit -m "fix: resolve merge conflict in orders store controller"

# Step 6: Push
git push origin feature/orders
```

> 💡 **Tip:** Open the file in VS Code — it highlights conflicts in red/green and gives you clickable buttons to "Accept Current Change" or "Accept Incoming Change".

---

### 🔴 CSS / JS Not Loading (404 in Browser Console)

**Cause:** Wrong asset URL or `.htaccess` not working.

**Fix:**
```php
// Use the asset() helper in your views, not hardcoded paths
<link rel="stylesheet" href="<?= asset('css/app.css') ?>">
<script src="<?= asset('js/app.js') ?>"></script>

// Make sure APP_URL in config.php is correct:
define('APP_URL', 'http://localhost/cafeteria-management-system/public');
```

Also verify `.htaccess` is in the `public/` folder:
```apache
Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```

---

### 🔴 Laragon Not Working / Apache Won't Start

**Fix options:**

1. **Port conflict** — Another program is using port 80 (usually Skype or IIS)
   - Open Laragon → Menu → Preferences → Port → Change to `8080`
   - Then visit `http://localhost:8080/...`

2. **MySQL won't start** — Port 3306 conflict
   - Open Task Manager → find `mysqld.exe` → End Task → restart Laragon

3. **Virtual host not found** — Clear Laragon's virtual host cache
   - Laragon → Menu → Apache → Restart

---

### 🔴 Wrong Branch / Accidentally Committed to Wrong Branch

**If you committed to `develop` or `main` by mistake:**

```bash
# Step 1: Copy your commit hash (find it with git log)
git log --oneline -5

# Step 2: Go to your correct feature branch
git checkout feature/auth

# Step 3: Cherry-pick the commit to your feature branch
git cherry-pick <commit-hash>

# Step 4: Go back to the wrong branch and undo the commit
git checkout develop
git reset --hard HEAD~1  # ⚠️ Only if you have NOT pushed yet

# If you already pushed the wrong commit, contact the Team Lead immediately
```

---

### 🔴 Permission Denied / 403 Forbidden

**Cause:** Trying to access an admin route as a regular user, or the auth guard redirected you.

**Fix:**
```php
// Every admin controller must start with:
require_once __DIR__ . '/../../Core/Auth.php';
Auth::requireAdmin(); // Redirects to 403 if not admin

// Every protected (non-admin) controller must start with:
Auth::requireLogin(); // Redirects to /login if not logged in
```

---

### 🔴 `config.php` Not Found

**Fix:** Make sure your `config.php` exists at the project root and is included in `public/index.php`:

```php
// In public/index.php
require_once __DIR__ . '/../config.php';
```

---

### 🔴 `git: command not found` in Terminal

**Fix:** Git is not in your system PATH.

- Windows: Reinstall Git and check **"Add Git to PATH"** during setup
- Or use **Git Bash** instead of Command Prompt (Git Bash always has Git available)

---

## 📖 13. Git Commands Cheat Sheet

### Setup & Identity

```bash
# Set your name and email (do this once on every machine)
git config --global user.name "Your Full Name"
git config --global user.email "your@email.com"

# Check current config
git config --list
```

### Cloning & Initializing

```bash
# Clone a repository from GitHub
git clone https://github.com/org/repo.git

# Check which remote URLs are set
git remote -v
```

### Branches

```bash
# List local branches
git branch

# List all branches (local + remote)
git branch -a

# Create a new branch
git branch feature/new-thing

# Switch to a branch
git checkout feature/auth

# Create AND switch in one command
git checkout -b feature/new-thing

# Delete a local branch (after it's merged)
git branch -d feature/auth

# Rename current branch
git branch -m new-name
```

### Staging & Committing

```bash
# See what changed
git status

# See actual code differences
git diff

# Stage all changes
git add .

# Stage a specific file
git add Controllers/auth/store.php

# Unstage a file (keeps your changes)
git restore --staged Controllers/auth/store.php

# Commit staged changes
git commit -m "feat(auth): implement login controller"

# Amend the last commit message (before pushing)
git commit --amend -m "feat(auth): implement login controller and session"
```

### Pulling & Pushing

```bash
# Pull latest from remote branch
git pull origin develop

# Push your branch to GitHub
git push origin feature/auth

# Push for the first time (sets upstream)
git push -u origin feature/auth

# Force push (⚠️ dangerous — only use on your own branch, never on main/develop)
git push --force origin feature/auth
```

### Merging

```bash
# Merge develop into your current branch
git merge develop

# Abort a merge in progress
git merge --abort
```

### Viewing History

```bash
# See commit history
git log

# See compact one-line history
git log --oneline

# See last 5 commits
git log --oneline -5

# See history with a graph (all branches)
git log --oneline --graph --all
```

### Undoing Things

```bash
# Discard all uncommitted changes (IRREVERSIBLE)
git checkout -- .

# Undo last commit but KEEP the code changes
git reset --soft HEAD~1

# Undo last commit and DISCARD code changes (IRREVERSIBLE)
git reset --hard HEAD~1

# Create a new commit that reverses a previous commit (safe for shared branches)
git revert <commit-hash>
```

### Stashing

```bash
# Save your current changes temporarily (without committing)
git stash

# List all stashes
git stash list

# Apply the most recent stash
git stash pop

# Apply a specific stash
git stash apply stash@{0}

# Discard a stash
git stash drop stash@{0}
```

---

## 🗺️ 14. Development Roadmap

### Current Status

| Status | Milestone |
|--------|-----------|
| ✅ Done | Database schema designed and created |
| ✅ Done | MVC architecture established |
| ✅ Done | Core classes built (Database, Router, Session, Validator, Response, Auth) |
| ✅ Done | Front Controller and routing system working |
| ✅ Done | Shared layout foundation (navbar, sidebar, partials) |
| ✅ Done | Git branches created and workflow established |

---

### Upcoming Milestones

| Status | Module | Owner | Target |
|--------|--------|-------|--------|
| ⬜ Pending | 🔐 Authentication (Login, Logout, Reset) | Member 1 | Week 1 |
| ⬜ Pending | 🏷️ Categories Module (CRUD) | Member 3 | Week 1 |
| ⬜ Pending | 📦 Products Module (CRUD + Image Upload) | Member 2 | Week 2 |
| ⬜ Pending | 👤 Users Module (CRUD + Role Management) | Member 4 | Week 2 |
| ⬜ Pending | 🛒 Orders Module (User Flow + Admin View) | Member 5 | Week 3 |
| ⬜ Pending | 📊 Reports Module (Filters + CSV Export) | Member 6 | Week 3 |
| ⬜ Pending | 🧪 Integration Testing | All Members | Week 4 |
| ⬜ Pending | 🔒 Security Hardening (CSRF, XSS) | Team Lead | Week 4 |
| ⬜ Pending | 🎨 UI Polish & Responsive Testing | Member 6 | Week 4 |
| ⬜ Pending | 🚀 Final Presentation & Demo | All Members | Week 5 |

---

### Development Dependencies

```
Categories ──────────────────────────────────────────┐
                                                      ↓
Authentication ──→ Users ──→ Orders ──→ Reports ──→  DONE
                      ↑
                  Products ─────────────────────────────┘
```

> 🔑 **Critical path:** Authentication must be done before any other module can be fully tested. Categories must be done before Products.

---



