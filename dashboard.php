<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Olá, <?php echo $_SESSION['username']; ?>!</p>
        <p>Você está na página do painel do usuário.</p>
        <?php 
        if(isset($_COOKIE['user_login'])) {
            echo "<p>Você tem um cookie de login ativo.</p>";
        }
        ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>