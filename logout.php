<?php
    session_start();
    
    // Remover cookie de login
    if(isset($_COOKIE['user_login'])) {
        setcookie('user_login', '', time() - 3600, '/'); // tempo no passado para excluir o cookie
    }
    
    // Destruir sessão
    if(session_destroy()) {
        // Redirecionando para a página inicial
        header("Location: login.php");
    }
?>