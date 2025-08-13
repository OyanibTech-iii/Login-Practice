@echo off
echo ========================================
echo Laravel Authentication System Setup
echo MariaDB Database Configuration
echo ========================================
echo.

echo Step 1: Checking MariaDB Service...
sc query MariaDB >nul 2>&1
if %errorlevel% equ 0 (
    echo MariaDB service found. Starting...
    net start MariaDB
    if %errorlevel% equ 0 (
        echo MariaDB started successfully!
    ) else (
        echo Failed to start MariaDB service.
        echo Please check if MariaDB is installed and running.
        pause
        exit /b 1
    )
) else (
    echo MariaDB service not found.
    echo Please install MariaDB first: https://mariadb.org/download/
    pause
    exit /b 1
)

echo.
echo Step 2: Setting up database...
echo Please run the following commands in MariaDB:
echo.
echo 1. Connect to MariaDB as root:
echo    mysql -u root -p
echo.
echo 2. Run the setup script:
echo    source setup_mariadb.sql
echo.
echo 3. Or manually create database and user:
echo    CREATE DATABASE laravel_auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
echo    CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'your_password';
echo    GRANT ALL PRIVILEGES ON laravel_auth.* TO 'laravel_user'@'localhost';
echo    FLUSH PRIVILEGES;
echo    EXIT;
echo.

echo Step 3: Updating .env file...
if not exist .env (
    echo Creating .env file...
    copy .env.example .env
    echo .env file created from .env.example
    echo Please update the database credentials in .env file
) else (
    echo .env file already exists
    echo Please ensure database credentials are correct
)

echo.
echo Step 4: Generating application key...
php artisan key:generate
if %errorlevel% equ 0 (
    echo Application key generated successfully!
) else (
    echo Failed to generate application key.
    echo Please check PHP installation and Laravel setup.
)

echo.
echo Step 5: Running database migrations...
php artisan migrate
if %errorlevel% equ 0 (
    echo Database migrations completed successfully!
) else (
    echo Failed to run migrations.
    echo Please check database connection and credentials.
)

echo.
echo Step 6: Clearing caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
echo Caches cleared!

echo.
echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Start the development server: php artisan serve
echo 2. Open your browser to: http://localhost:8000
echo 3. Test the authentication system
echo.
echo For testing, follow the guide in TEST_AUTH.md
echo For troubleshooting, check MARIA_DB_SETUP.md
echo.
pause
