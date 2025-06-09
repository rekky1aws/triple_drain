# TripleDrain
TripleDrain is a (work in progress) web app made to gather pinball score data, mainly from Pinball FX (Zen Studios), to display all rankings easily and in the same place.

## Installation
Required :
 + [php](https://www.php.net/manual/en/install.php)
    + php-xml
    + php-mysql
    + php-mbstring
    + php-intl
 + mysql
 + mariadb
 + [composer](https://getcomposer.org/download/)
 + [symfony](https://symfony.com/download)

Recommended :
 + [phphMyAdmin](https://www.phpmyadmin.net)

## Initialization
### Composer packages
To install all composer dependencies, run :
```bash
composer install
```

### DB Connexion
Create a database named `triple_drain` in mysql.
Create a user named `triple_drain` in mysql.
Grant privileges on the `triple_drain` db to your `triple_drain` user.
Change `.env` file according to your configuration.

### DB Content
Create the tables in the database using :
```bash
php bin/console doctrine:migrations:migrate
# or the shorten version :
php bin/console do:mi:mi
```

Create fixtures (test data) using :
```bash
php bin/console doctrine:fixtures:load
# or the shorten version :
php bin/console do:fil:lo
```

## Run
Start the project in local:<br>
symfony server:start <br>
Go to `http://localhost:8000`

## Use
### Create an admin account
Go to `http://localhost:8000/register` and create an user.
Update your user in your database and change it's role to `["ROLE_EDITOR","ROLE_ADMIN"]`.
The user is now an admin and an editor (which is required to be an admin).

### Log In
Go to `http://localhost:8000/login` and log into your account.

### Edition
Go to `http://localhost:8000/edit` after [logging in](#log-in)