# Create a Registration and Login System with PHP and MySQL

How to create a Registration and Login System with PHP and MySQL. In this tutorial, we walk through the complete process of creating a user registration system. Users can create an account by providing username, password, email. After the account was created, the user can log in to their own account. Once the user login, it will redirect to the Dashboard page. Moreover, the user can logout from his panel. This whole system we are developed using PHP and MySQL.

## Create a Database and Database Table

First, you have to log in to PHPMyAdmin. Next, click on the Database tab to create a new database. Enter your database name and click on create database button.

```sql
CREATE DATABASE LoginSystem;
```

Once you create a database, the second step to creating a user table.

```sql
CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);
```

## Connect to the Database(db.php)

```php
<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","root","LoginSystem");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
```

## Session Create for Logged in User(auth_session.php)
Next, we have to create a session for the user. 

```php
<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
?>
```
## Creating a Registration Form(registration.php)
## Creating a Login Form(login.php)
## Making a Dashboard Page(dashboard.php)
## Create a Logout(logout.php)
## CSS File Create(style.css)


## License
[MIT](https://choosealicense.com/licenses/mit/)