# MariaDB Setup Guide for Laravel Authentication System

## Prerequisites

### 1. Install MariaDB Server
Download and install MariaDB from: https://mariadb.org/download/

**For Windows:**
- Download the MSI installer
- Run as administrator
- Choose "Typical" installation
- Set root password during installation
- Keep default port (3306)

**For Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install mariadb-server
sudo mysql_secure_installation
```

**For macOS:**
```bash
brew install mariadb
brew services start mariadb
```

### 2. Install PHP MySQL Extension
Ensure your PHP installation includes the MySQL extension:

**For Windows:**
- Uncomment `extension=pdo_mysql` in php.ini
- Uncomment `extension=mysqli` in php.ini

**For Linux:**
```bash
sudo apt install php-mysql
```

**For macOS:**
```bash
brew install php
# MySQL extension is usually included by default
```

## Database Setup

### 1. Create Database and User

Connect to MariaDB as root:
```bash
mysql -u root -p
```

Create the database and user:
```sql
-- Create database
CREATE DATABASE laravel_auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user (replace 'your_password' with a secure password)
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'your_password';

-- Grant privileges
GRANT ALL PRIVILEGES ON laravel_auth.* TO 'laravel_user'@'localhost';

-- Apply changes
FLUSH PRIVILEGES;

-- Verify
SHOW DATABASES;
SELECT User, Host FROM mysql.user;

-- Exit
EXIT;
```

### 2. Environment Configuration

Create or update your `.env` file with these database settings:

```env
APP_NAME="Laravel App"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_auth
DB_USERNAME=laravel_user
DB_PASSWORD=your_password

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_APP_KEY}"
VITE_PUSHER_PORT="${PUSHER_APP_KEY}"
VITE_PUSHER_SCHEME="${PUSHER_APP_KEY}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_KEY}"
```

## Laravel Setup Commands

### 1. Generate Application Key
```bash
php artisan key:generate
```

### 2. Run Database Migrations
```bash
php artisan migrate
```

### 3. (Optional) Seed Database
```bash
php artisan db:seed
```

### 4. Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### 5. Start Development Server
```bash
php artisan serve
```

## Database Verification

### 1. Check Connection
```bash
php artisan tinker
```

In Tinker, test the connection:
```php
DB::connection()->getPdo();
// Should return PDO object if successful
exit
```

### 2. Verify Tables
```bash
php artisan migrate:status
```

Should show all migrations as completed.

### 3. Check Database Structure
Connect to MariaDB and verify:
```sql
USE laravel_auth;
SHOW TABLES;
DESCRIBE users;
DESCRIBE password_resets;
DESCRIBE failed_jobs;
DESCRIBE personal_access_tokens;
```

## Troubleshooting

### Common Issues

#### 1. Connection Refused
**Error:** `SQLSTATE[HY000] [2002] Connection refused`
**Solution:**
- Ensure MariaDB service is running
- Check if port 3306 is correct
- Verify firewall settings

#### 2. Access Denied
**Error:** `SQLSTATE[HY000] [1045] Access denied for user`
**Solution:**
- Verify username and password in .env
- Check user privileges in MariaDB
- Ensure user can connect from localhost

#### 3. Database Not Found
**Error:** `SQLSTATE[HY000] [1049] Unknown database`
**Solution:**
- Create the database manually
- Check database name in .env
- Verify database exists: `SHOW DATABASES;`

#### 4. PHP Extension Missing
**Error:** `Class 'PDO' not found`
**Solution:**
- Install PHP MySQL extension
- Enable in php.ini
- Restart web server

### MariaDB Service Management

**Windows:**
```cmd
# Start service
net start MariaDB

# Stop service
net stop MariaDB

# Check status
sc query MariaDB
```

**Linux:**
```bash
# Start service
sudo systemctl start mariadb

# Stop service
sudo systemctl stop mariadb

# Check status
sudo systemctl status mariadb

# Enable auto-start
sudo systemctl enable mariadb
```

**macOS:**
```bash
# Start service
brew services start mariadb

# Stop service
brew services stop mariadb

# Check status
brew services list | grep mariadb
```

## Security Best Practices

### 1. User Privileges
- Use dedicated user for Laravel (not root)
- Grant only necessary privileges
- Use strong passwords

### 2. Network Security
- Bind to localhost only (127.0.0.1)
- Use firewall rules if needed
- Consider SSL for production

### 3. Database Security
```sql
-- Remove anonymous users
DELETE FROM mysql.user WHERE User='';

-- Remove test database
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';

-- Apply changes
FLUSH PRIVILEGES;
```

## Performance Optimization

### 1. MariaDB Configuration
Edit `/etc/mysql/mariadb.conf.d/50-server.cnf`:

```ini
[mysqld]
# Buffer pool size (adjust based on available RAM)
innodb_buffer_pool_size = 256M

# Query cache
query_cache_type = 1
query_cache_size = 64M

# Connection settings
max_connections = 150
```

### 2. Laravel Database Optimization
```php
// In config/database.php
'mysql' => [
    // ... other settings
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        PDO::MYSQL_ATTR_PERSISTENT => true, // Connection pooling
    ]) : [],
],
```

## Backup and Recovery

### 1. Create Backup
```bash
mysqldump -u laravel_user -p laravel_auth > backup_$(date +%Y%m%d_%H%M%S).sql
```

### 2. Restore Backup
```bash
mysql -u laravel_user -p laravel_auth < backup_file.sql
```

### 3. Laravel Backup Commands
```bash
# Backup database
php artisan db:backup

# Restore from backup
php artisan db:restore
```

## Monitoring

### 1. Check Database Status
```sql
SHOW STATUS LIKE 'Connections';
SHOW STATUS LIKE 'Threads_connected';
SHOW PROCESSLIST;
```

### 2. Performance Queries
```sql
-- Slow queries
SHOW VARIABLES LIKE 'slow_query_log';
SHOW VARIABLES LIKE 'long_query_time';

-- Table sizes
SELECT 
    table_name,
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.tables 
WHERE table_schema = 'laravel_auth'
ORDER BY (data_length + index_length) DESC;
```

## Next Steps

After successful MariaDB setup:

1. **Test Authentication System** - Follow TEST_AUTH.md
2. **Create Sample Users** - Use registration form
3. **Monitor Performance** - Check database queries
4. **Set Up Backups** - Regular database backups
5. **Production Deployment** - Optimize for production use

## Support

- **MariaDB Documentation:** https://mariadb.com/kb/
- **Laravel Database Docs:** https://laravel.com/docs/database
- **Community Forums:** https://mariadb.org/community/
