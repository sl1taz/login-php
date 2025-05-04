<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // Quando o formulário for enviado, inserir valores no banco de dados.
    if (isset($_REQUEST['username'])) {
        // remove barras invertidas
        $username = stripslashes($_REQUEST['username']);
        // escapa caracteres especiais em uma string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        // Verificar se o username já existe
        $check_username_query = "SELECT * FROM `users` WHERE username='$username'";
        $check_username_result = mysqli_query($con, $check_username_query) or die(mysqli_error($con));
        $username_exists = mysqli_num_rows($check_username_result);
        
        // Verificar se o email já existe
        $check_email_query = "SELECT * FROM `users` WHERE email='$email'";
        $check_email_result = mysqli_query($con, $check_email_query) or die(mysqli_error($con));
        $email_exists = mysqli_num_rows($check_email_result);
        
        if ($username_exists > 0) {
            echo "<div class='form'>
                  <h3>Erro: Nome de usuário já existe!</h3><br/>
                  <p class='link'>Clique aqui para <a href='registration.php'>tentar novamente</a> com outro nome de usuário.</p>
                  </div>";
        } 
        else if ($email_exists > 0) {
            echo "<div class='form'>
                  <h3>Erro: Email já está em uso!</h3><br/>
                  <p class='link'>Clique aqui para <a href='registration.php'>tentar novamente</a> com outro email.</p>
                  </div>";
        }
        else {
            $create_datetime = date("Y-m-d H:i:s");
            $query    = "INSERT into `users` (username, password, email, create_datetime)
                         VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
            $result   = mysqli_query($con, $query);
            
            if ($result) {
                echo "<div class='form'>
                      <h3>Você foi registrado com sucesso.</h3><br/>
                      <p class='link'>Clique aqui para <a href='login.php'>Login</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Campos obrigatórios estão faltando ou ocorreu um erro.</h3><br/>
                      <p class='link'>Clique aqui para <a href='registration.php'>registro</a> novamente.</p>
                      </div>";
                // Para depuração, você pode descomentar a linha abaixo
                // echo "<p>Erro: " . mysqli_error($con) . "</p>";
            }
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registro</h1>
        <input type="text" class="login-input" name="username" placeholder="Nome de usuário" required />
        <input type="email" class="login-input" name="email" placeholder="Endereço de Email" required>
        <input type="password" class="login-input" name="password" placeholder="Senha" required>
        <input type="submit" name="submit" value="Registrar" class="login-button">
        <p class="link">Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
    </form>
<?php
    }
?>
</body>
</html>