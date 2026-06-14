@echo off
REM Cafeteria Management System - Windows Database Setup Script

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║   CAFETERIA MANAGEMENT SYSTEM - DATABASE SETUP (WINDOWS)   ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

REM Step 1: Check if MySQL is available
where mysql >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ ERROR: MySQL/MariaDB is not in PATH
    echo.
    echo Please add MySQL/MariaDB to your PATH:
    echo   XAMPP:    Add C:\xampp\mysql\bin to PATH
    echo   MySQL:    Add C:\Program Files\MySQL\MySQL Server 8.0\bin to PATH
    echo   MariaDB:  Add C:\Program Files\MariaDB 10.x\bin to PATH
    echo.
    pause
    exit /b 1
)

echo 📊 Setting up database...
echo.

REM Step 2: Create database
echo Step 1: Creating database...
mysql -u root -e "DROP DATABASE IF EXISTS cafeteria; CREATE DATABASE cafeteria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if %errorlevel% equ 0 (
    echo ✅ Database created
) else (
    echo ❌ Failed to create database
    pause
    exit /b 1
)

REM Step 3: Import schema
echo.
echo Step 2: Importing schema...
mysql -u root cafeteria < database/schema.sql

if %errorlevel% equ 0 (
    echo ✅ Schema imported
) else (
    echo ❌ Failed to import schema
    pause
    exit /b 1
)

REM Step 4: Run seeds
echo.
echo Step 3: Seeding test data...
mysql -u root cafeteria < database/seed.sql

if %errorlevel% equ 0 (
    echo ✅ Test data seeded
) else (
    echo ❌ Failed to seed data
    pause
    exit /b 1
)

REM Step 5: Verify
echo.
echo Step 4: Verifying setup...
for /f %%i in ('mysql -u root cafeteria -e "SELECT COUNT(*) FROM users;" ^| findstr /r "[0-9]"') do set USERS=%%i

echo ✅ Database setup complete!
echo   📊 Tables created and configured
echo   👥 Users seeded: %USERS%
echo.

echo ╔════════════════════════════════════════════════════════════╗
echo ║              ✅ SETUP COMPLETE!                            ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo 📝 Test Credentials:
echo    Email: sara.ahmed@company.com
echo    Password: password
echo.
echo 🔐 Admin Credentials:
echo    Email: admin@cafeteria.com
echo    Password: password
echo.
pause
