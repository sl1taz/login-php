<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();
    
    // Verificar se já existe um cookie de login
    if(isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
        $username = stripslashes($_COOKIE['user_login']);
        $username = mysqli_real_escape_string($con, $username);
        
        // Verificar se o usuário existe no banco de dados
        $query = "SELECT * FROM `users` WHERE username='$username'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);
        
        if($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirecionar para o painel do usuário
            header("Location: dashboard.php");
            exit();
        }
    }
    
    // Quando o formulário for enviado, verificar e criar a sessão do usuário
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // remove barras invertidas
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        // Verificar se o usuário existe no banco de dados
        $query = "SELECT * FROM `users` WHERE username='$username' 
                  AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);
        
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            
            // Verificar se o usuário marcou a opção "Lembrar-me"
            if(isset($_POST['remember']) && $_POST['remember'] == 'on') {
                // Definir cookie para lembrar o usuário (validade de 30 dias)
                setcookie('user_login', $username, time() + (86400 * 30), "/");
            }
            
            // Redirecionar para o painel do usuário
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<div class='form'>
                  <h3>Nome de usuário/senha incorretos.</h3><br/>
                  <p class='link'>Clique aqui para <a href='login.php'>Login</a> novamente.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Lembrar-me</label>
        </div>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Não tem uma conta? <a href="registration.php">Registre-se agora</a></p>
    </form>
<?php
    }
?>
</body>
</html>