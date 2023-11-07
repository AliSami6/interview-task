# Laravel Role Permission Management System - Laravel `8.x` `9.x`

A project which manage Role, Permissions , Quiz and every actions of your Laravel application. 
**Live Demo:** http://laravel-role.herokuapp.com
```
Username - super@gmail.com
password - 12345678
```
> **Note:** Don't try to modify the Super Admin (Role & admin) data, just for Heroku deployment.

## Requirements:
- Laravel `8.x` | `9.7`
- Spatie role permission package  `5.5`




- Laravel `9.7` & PHP - `8.x`


## Project Setup
Git clone -
```console
git clone https://github.com/AliSami6/interview-task.git
```

Go to project folder -
```console
cd interview-task
```

Install Laravel Dependencies -
```console
composer install
```

Create database called - `interview_task`

Create `.env` file by copying `.env.example` file

Generate Artisan Key (If needed) -
```console
php artisan key:generate
```

Migrate Database with seeder -
```console
php artisan migrate --seed
```

Run Project -
```php
php artisan serve
```


So, You've got the project of Laravel Role & Permission Management on your http://localhost:8000

## How it works
1. Login using Super Admin Credential -
    1. Username - `super@gmail.com`
    1. Password - `12345678`
2. Create Admin
3. Create Role
4. Assign Permission to Roles
5. Assign Multiple Role to an admin
6. Check by login with the new credentials.
7. If you've not enough permission to do any task, you'll get a warning message.




## Contribution
Contribution is open. Create Pull-request and I'll add it to the project if it's good enough.
