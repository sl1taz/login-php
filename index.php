<?php
// Iniciar a sessão
session_start();

// Incluir arquivo de conexão com o banco de dados
require('db.php');

// Verificar se já existe uma sessão ativa
if(isset($_SESSION['username'])) {
    // Usuário já está logado via sessão, redirecionar para o dashboard
    header("Location: dashboard.php");
    exit();
}

// Verificar se existe cookie de login
if(isset($_COOKIE['user_login'])) {
    $username = stripslashes($_COOKIE['user_login']);
    $username = mysqli_real_escape_string($con, $username);
    
    // Verificar se o usuário existe no banco de dados
    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);
    
    if($rows == 1) {
        // Usuário válido encontrado, criar sessão e redirecionar
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    }
}

// Se não estiver logado (nem por sessão, nem por cookie), redirecionar para a página de login
header("Location: login.php");
exit();
?>