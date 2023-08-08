<p align="center">
    <a href="https://laravel.com/docs/10.x/starter-kits#laravel-breeze">
        <img src="https://github.com/laravel/breeze/blob/1.x/art/logo.svg" alt="Laravel Breeze Logo">
    </a>
</p>

<p align="center">
    <a href="https://packagist.org/packages/laravel/breeze">
        <img src="https://img.shields.io/packagist/dt/laravel/breeze" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/breeze">
        <img src="https://img.shields.io/packagist/v/laravel/breeze" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/breeze">
        <img src="https://img.shields.io/packagist/l/laravel/breeze" alt="License">
    </a>
</p>

<br>

## Attention!

Execute those commands to install dependencies, create `.env` file and create `APP_KEY` (Application key) int the same file.

```
composer install 
cp .env.example .env 
php artisan cache:clear 
composer dump-autoload 
php artisan key:generate
```

When execute the migrations, is necessary use the commands to create some populated tables to some selection fields at forms.

```
php artisan migrate --seed
```

Or using the commands:
```
php artisan migrate
php artisan db:seed
```

With help of [Laravel Spatie](https://spatie.be/docs/laravel-permission/v5/introduction), exist two roles user: **Admin** e **User**. Making certains roles user has more privileges than others, is very important you execute the seeds to those users be created.

* Name: Mario
```
Email: mario@world.com
Password: 12345678
Roles: Admin, User
Permissions: NULL
```

* Name: Luigi
```
Email: luigi@world.com
Password: 12345678
Roles: User
Permissions: NULL
```

Some functionality are exclusives to **Admin**, others types of roles has not the same privileges.

Read more on [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze).

## Login
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Login.png?raw=true)

## Register
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Register.png?raw=true)

## Forgot Password
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/ForgotPassword.png?raw=true)

## Email Notification
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/EmailNotification.png?raw=true)

## Password Reset
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/PasswordReset.png?raw=true)

## Dashboard
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Dashboard.png?raw=true)

## Fighter
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Fighter.png?raw=true)

## Master
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Master.png?raw=true)

## Dojo
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Dojo.png?raw=true)

## Fight
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Fight.png?raw=true)

## Permissions
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Permissions.png?raw=true)

## Trash of permissions
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/TrashPermission.png?raw=true)

## Roles
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Roles.png?raw=true)

## Trash of roles
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/TrashRole.png?raw=true)

## Users
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/Users.png?raw=true)

## Trash of users
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/TrashUser.png?raw=true)

## Change password
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/ChangePassword.png?raw=true)

## Change email
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/ChangeEmail.png?raw=true)

## Delete user (Permanently)
![](https://github.com/Iury189/street_breeze/blob/main/public/imagens/DeleteUser.png?raw=true)
