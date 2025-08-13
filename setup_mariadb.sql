-- MariaDB Setup Script for Laravel Authentication System
-- Run this script as root user in MariaDB

-- Create the database
CREATE DATABASE IF NOT EXISTS laravel_auth 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Create dedicated user for Laravel
CREATE USER IF NOT EXISTS 'laravel_user'@'localhost' 
IDENTIFIED BY 'your_secure_password_here';

-- Grant privileges to the user
GRANT ALL PRIVILEGES ON laravel_auth.* TO 'laravel_user'@'localhost';

-- Grant additional privileges for Laravel operations
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON laravel_auth.* TO 'laravel_user'@'localhost';

-- Apply all changes
FLUSH PRIVILEGES;

-- Verify the setup
SHOW DATABASES;
SELECT User, Host FROM mysql.user WHERE User = 'laravel_user';

-- Show user privileges
SHOW GRANTS FOR 'laravel_user'@'localhost';

-- Use the database
USE laravel_auth;

-- Show current database
SELECT DATABASE();

-- Exit
EXIT;
