
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
php artisan make:migration create_blogs_table
php artisan make:migration create_blog_responses_table
```
Add additional data to migration file in `database/migrations`.

Create table
```
php artisan migrate 
```

Reset database
```
php artisan fresh
```

### Create Routes

Routes are in `routes/web.php`.
Routes linked the urls to controllers or views.

### Create Controllers

Controllers are in `Http Controllers`.
Controllers read the request from routes and create views.

### Create views
Laravel views are often end with "blade.php".
It is important to create layouts to reuse php files.

A basic http file
```
header file
navbar file

content

footer file
```




