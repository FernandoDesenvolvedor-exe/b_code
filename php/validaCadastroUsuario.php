<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include('function.php');
    include("connection.php");
    $nome = stripslashes($_POST["nNome"]);
    $sobrenome = stripslashes($_POST["nSobrenome"]);
    $email = stripslashes($_POST["nEmail"]);
    $senha = stripslashes($_POST["nSenha"]);
    $confirmSenha = stripslashes($_POST["nConfirmSenha"]);
    $turma = stripslashes($_POST["nTurma"]);
    $tipoUsu = stripslashes($_POST["nTipoUsu"]);

    //var_dump($nome,$sobrenome,$email,$senha,$confirmSenha,$turma,$tipoUsu);
    //var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));

    $_SESSION['msgErro'] = '';
    $abreHTMLalert = '<div class="input-group mb-3"><div class="input-group-prepend" style="width: 100%; height:100%;">'
                .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';

    //_________________________SEGURANÇA CONTRA ATAQUE DE INSERÇÃO DE CÓDIGO NO CADASTRO_________________________

    //Apenas letras e espaço
    if(!validarDado(1,$nome)){
        $_SESSION['msgErro'] = $abreHTMLalert.'Nome inválido! Somente letras (a-z) e espaços são permitidos.'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die(); 
    }
    //Apenas letras e espaço
    if(!validarDado(1,$sobrenome)){
        $_SESSION['msgErro'] = $abreHTMLalert.'Sobrenome inválido! Somente letras (a-z) e espaços são permitidos.'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();
    }

    //Apenas letras, numeros e ponto
    if(!validarDado(2,$email)){
        $_SESSION['msgErro'] = $abreHTMLalert.'Email inválido! Somente letras (a-z), números (0-9) e ponto (.) são permitidos.'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();
    }
    //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).
    if(!validarDado(3,$senha)){
        $_SESSION['msgErro'] = $abreHTMLalert.'Senha inválida! Somente letras (a-z), números (0-9) e caracters especiais (., !, @, #, $, %, -, _) são permitidos.'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();
    }

    //_____________________________________________________________VALIDAÇÃO DOS DADOS__________________________________________________
    
    //Valida se adm n tem turma 
    var_dump($tipoUsu, $turma);
    if($tipoUsu==1 and $turma!=''){
        $_SESSION['msgErro'] = $abreHTMLalert.'Tipo de usuario não pode ter turma!'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();     
    }
    //Valida se comum tem turma
    if($tipoUsu==2 and $turma==''){
        $_SESSION['msgErro'] = $abreHTMLalert.'Tipo de usuario deve ter turma!'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();  
    }
    //Valida email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['msgErro'] = $abreHTMLalert.'Email inválido!'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();
    }
    //Valida se senhas são iguais
    if($senha!=$confirmSenha){
        $_SESSION['msgErro'] = $abreHTMLalert.'Senhas não são iguais!'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();
    }

    //Valida se email existe
    $sqlEmail = "select login from usuarios where login='".$email."'";

    $result = mysqli_query($conn, $sqlEmail);
    mysqli_close($conn);
    if(mysqli_num_rows($result)>0){
        $_SESSION['msgErro'] = $abreHTMLalert.'Email já cadastrado. Tente outro email.'.$fechaHTMLalert;
        header('location: ../cadastroUsuario.php');
        die();
    }
    //Inserir dados no Banco
    INSERT INTO `usuarios` (`login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
('a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', 1, 1, 'S'),
('b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 'S'),
('c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 'N');
    $sqlInsert = "Insert into usuarios (login, senha, nome , sobrenome, idTurma, tipo , ativo) values"
                ."('login', md5('senha'), 'nome' , 'sobrenome', idTurma, tipo , 'ativo')";
    mysqli_query($conn, $sqlInsert);

?>