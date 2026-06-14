@echo off
REM Cafeteria Management System - Server Startup Script

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║   CAFETERIA MANAGEMENT SYSTEM - START SERVER              ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

REM Check if PHP is available
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ ERROR: PHP is not in PATH
    echo.
    echo Please add PHP to your PATH or start the server manually:
    echo   cd c:\DEV\p..1\cafeteria-management-system
    echo   php -S localhost:8000 -t public
    echo.
    pause
    exit /b 1
)

echo 🚀 Starting PHP Development Server...
echo.
echo 📝 Server URL: http://localhost:8000
echo 🔐 Login Page: http://localhost:8000/login
echo.
echo Test Credentials:
echo   Email: sara.ahmed@company.com
echo   Password: password
echo.
echo Press Ctrl+C to stop the server
echo.

cd /d "%~dp0"
php -S localhost:8000 -t public

pause
