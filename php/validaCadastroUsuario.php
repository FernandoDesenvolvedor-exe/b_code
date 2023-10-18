<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include("connection.php");
    $nome = stripslashes($_POST["nNome"]);
    $sobrenome = stripslashes($_POST["nSobrenome"]);
    $email = stripslashes($_POST["nEmail"]);
    $senha = stripslashes($_POST["nSenha"]);
    $confirmSenha = stripslashes($_POST["nConfirmSenha"]);
    $turma = stripslashes($_POST["nTurma"]);
    $tipoUsu = stripslashes($_POST["nTipoUsu"]);

    var_dump($nome,$sobrenome,$email,$senha,$confirmSenha,$turma,$tipoUsu);
    var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
    
    $_SESSION['msgAviso'] = '';

    if($turma!='null' and $tipoUsu!='null'){
        
    }else{
        $_SESSION['msgAviso'] = '<div class="input-group mb-3"><div class="input-group-prepend" style="width: 100%; height:100%;">'
        .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">Selecione todos os campos*</div></div></div>';
        header('location: ../cadastroUsuario.php');
        die();
    }


    
    
?>