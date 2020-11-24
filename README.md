
## Blog

### Create Database

Find the settings of the database in `config/database/php`.
Change the settings in `.env`.

**postgresql**

Add public schema
```
psql
CREATE DATABASE dbname;
CREATE SCHEMA public;
```

Create model
```
php artisan make:model User
```
Add additional data to model file User in `app/User.php`.


Create migrations
```          
php artisan make:migration create_users_table
php artisan make:migration create_password_resets_table
php artisan make:migration create_failed_jobs_table
```
Add additional data to migration file in `database/migrations`.

Create table
```
php artisan migrate 
```

Recreate database
```
php artisan fresh
```

