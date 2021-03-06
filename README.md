
## Blog

This is a laravel blog pratice using `Laravel 6.x` and `php 7.3`.

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
php artisan migrate:fresh
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


### Create Validation for input files

Import  `use Illuminate\Support\Facades\Validator;`.

Laravel provides diffent validatiors.
Here is a example.
```php
Validator::make($request->all(), [
    'blog_title' => 'required|max:255',
    'blog_textarea' => 'required',
]);

// Each rule is speated by |
// required means not null and length > 0
```


### Create logging by slack

1. Get the web hook url from slack.
2. Add web hook url in `.env`
```
LOG_SLACK_WEBHOOK_URL={{YOUR_HOOK_URL}}
```
3. Add slack channel to the default channel `stack` in `config/logging.php`

Add channels `slack`
```php
'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'slack'],
            'ignore_exceptions' => false,
],
```

4. Refresh cache
```sh
php artisan config:cache
```

5. Test
```php
use Illuminate\Support\Facades\Log;

Log::critical('This is a critical message sent from Laravel App');
```




