# TripleDrain
TripleDrain is a (work in progress) web app made to gather pinball score data, mainly from Pinball FX (Zen Studios), to display all rankings easily and in the same place.

## Install
Required :
 + [php](https://www.php.net/manual/en/install.php)
    + php-xml
 + mariadb
 + mysql
 + [composer](https://getcomposer.org/download/)
 + [symfony](https://symfony.com/download)


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

## Run
Start the project in local:<br>
symfony server:start <br>
Go to `http://localhost:8000`
