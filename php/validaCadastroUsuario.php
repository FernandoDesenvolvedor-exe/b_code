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

    $_SESSION['msgErro'] = '';
    //Valida email
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        //Valida se senhas são iguais
        if($senha==$confirmSenha){
            //Valida se email existe
            $sqlEmail = "select login from usuarios where login='".$email."'";

            $result = mysqli_query($conn, $sqlEmail);
            mysqli_close($conn);
            if(mysqli_num_rows($result)<=0){
                var_dump('ola');
                die();
            }else{
                $_SESSION['msgErro'] = '<div class="input-group mb-3"><div class="input-group-prepend" style="width: 100%; height:100%;">'
                                      .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">Email já cadastrado. Tente outro email.</div></div></div>';
                header('location: ../cadastroUsuario.php');
                die();
            }
        }else{
            $_SESSION['msgErro'] = '<div class="input-group mb-3"><div class="input-group-prepend" style="width: 100%; height:100%;">'
                                  .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">Senhas não são iguais!</div></div></div>';
            header('location: ../cadastroUsuario.php');
            die();
        }
    }else{
        $_SESSION['msgErro'] = '<div class="input-group mb-3"><div class="input-group-prepend" style="width: 100%; height:100%;">'
                              .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">Email inválido!</div></div></div>';
        header('location: ../cadastroUsuario.php');
        die();
    }
?>