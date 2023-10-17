<?php
    include("connection.php");
    $nome = stripslashes($_POST["nNome"]);
    $sobrenome = stripslashes($_POST["nSobrenome"]);
    $email = stripslashes($_POST["nEmail"]);
    $senha = stripslashes($_POST["nSenha"]);
    $confirmSenha = stripslashes($_POST["nConfirmSenha"]);
    $turma = stripslashes($_POST["nTurma"]);
    
    
    
?>