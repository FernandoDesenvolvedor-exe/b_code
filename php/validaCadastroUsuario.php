<?php
/*
VALIDAÇÕES
-CADASTRO - ok
-ATIVA/DESATIVA - ok
-ALTERAR - ok
*/
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include('function.php');
    include("connection.php");
    $abreHTMLalert = '<div class="input-group mb-3">
                        <div class="input-group-prepend" style="width: 100%; height:100%;">
                            <div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    if ($_GET['validacao'] == 'I'){
        $nome = stripslashes($_POST["nNome"]);
        $sobrenome = stripslashes($_POST["nSobrenome"]);
        $email = stripslashes($_POST["nEmail"]);
        $senha = stripslashes($_POST["nSenha"]);
        $confirmSenha = stripslashes($_POST["nConfirmSenha"]);
        $turma = stripslashes($_POST["nTurma"]);
        $tipoUsu = stripslashes($_POST["radioTipo"]);
        $_SESSION['msgErro'] = '';
        //_________________________SEGURANÇA CONTRA INSERÇÃO DE CÓDIGO NO CADASTRO_________________________
        //Apenas letras e espaço
        if(!validarDado(1,$nome)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Nome inválido! Somente letras (a-z) e espaços são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die(); 
        }else 
        if(!validarDado(1,$sobrenome)){     //Apenas letras e espaço
            $_SESSION['msgErro'] = $abreHTMLalert.'Sobrenome inválido! Somente letras (a-z) e espaços são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //Apenas letras, numeros e ponto
        if(!validarDado(2,$email)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Email inválido! Somente letras (a-z), números (0-9) e ponto (.) são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).
        if(!validarDado(3,$senha)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Senha inválida! Somente letras (a-z), números (0-9) e caracters especiais (., !, @, #, $, %, -, _) são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //_____________________________________________________________VALIDAÇÃO DOS DADOS__________________________________________________
        //Valida se adm n tem turma 
        if($tipoUsu==1 and $turma!='null'){
            $_SESSION['msgErro'] = $abreHTMLalert.'Tipo de usuario (administrador) não pode ter turma!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();     
        }
        //Valida se comum tem turma
        if($tipoUsu==2 and $turma=='null'){
            $_SESSION['msgErro'] = $abreHTMLalert.'Tipo de usuario (comum) deve ter turma!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();  
        }
        //Valida email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Email inválido!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //Valida se senhas são iguais
        if($senha!=$confirmSenha){
            $_SESSION['msgErro'] = $abreHTMLalert.'Senhas não são iguais!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //Valida se email existe
        $sqlEmail = "select login from usuarios where login='".$email."'";
        $result = mysqli_query($conn, $sqlEmail);
        if(mysqli_num_rows($result) > 0){
            $_SESSION['msgErro'] = $abreHTMLalert.'Email já cadastrado. Tente outro email.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            mysqli_close($conn);
            die();
        }
        //____________________________________________Inserir dados no Banco___________________________________________________________________-
        saveUsuario($email, $senha, $nome, $sobrenome, $turma, $tipoUsu);
        $abreHTMLalert = '<div class="input-group mb-3"><div class="input-group-prepend" style="width: 100%; height:100%;">'
                            .'<div class="alert alert-success" role="alert" style="width:100%; height:100%">';
        $_SESSION['msgErro'] = $abreHTMLalert.'Usuario cadastrado com sucesso.✔'.$fechaHTMLalert;
        header('location: ../usuarios.php');
        die();
    } else if ($_GET['validacao'] == 'D'){
        include('connection.php');
        $sql= 'SELECT ativo FROM usuarios WHERE idUsuario='.$_GET['id'].';';
        //echo $sql;Die();
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                if($campo['ativo']==1){
                    $sqlUpdate = 'UPDATE usuarios SET ativo = 0 WHERE idUsuario = '.$_GET['id'].';';
                    //echo 'Desativado';Die();

                }else{
                    $sqlUpdate = 'UPDATE usuarios SET ativo = 1 WHERE idUsuario = '.$_GET['id'].';';
                    //echo 'Desativado';Die();
                }
            }
        }
        $result = mysqli_query($conn,$sqlUpdate);
        mysqli_close($conn);
    } else if ($_GET['validacao'] == 'U'){
        $_SESSION['msgErro']='';
        $nome = stripslashes($_POST["nNome"]);
        $sobrenome = stripslashes($_POST["nSobrenome"]);
        $email = stripslashes($_POST["nEmail"]);
        $senha = stripslashes($_POST["nSenha"]);
        $confirmSenha = stripslashes($_POST["nConfirmSenha"]);
        $turma = stripslashes($_POST["nTurma"]);
        $tipoUsu = stripslashes($_POST["nTipoUsu"]);
        //-----VALIDA DADOS---
        if(!validarDado(1,$nome) and $nome!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Nome inválido! Somente letras (a-z) e espaços são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die(); 
        }
        if(!validarDado(1,$sobrenome) and $sobrenome!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Sobrenome inválido! Somente letras (a-z) e espaços são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die(); 
        }
        if(!validarDado(2,$email) and $email!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Email inválido! Somente letras (a-z), números (0-9) e ponto (.) são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        if(!validarDado(3,$senha) and $senha!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Senha inválida! Somente letras (a-z), números (0-9) e caracters especiais (., !, @, #, $, %, -, _) são permitidos.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die(); 
        }
        //-----VALIDAÇOES
        //Valida se adm n tem turma 
        if($tipoUsu==1 and $turma!='null'){
            $_SESSION['msgErro'] = $abreHTMLalert.'Tipo de usuario (administrador) não pode ter turma!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();     
        }else{
            $turma=null;
        }
        //Valida se comum tem turma
        if($tipoUsu==2 and $turma=='null'){
            $_SESSION['msgErro'] = $abreHTMLalert.'Tipo de usuario (comum) deve ter turma!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();  
        }
        //Valida email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) and $email!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Email inválido!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //Valida se senhas são iguais
        if($senha!=$confirmSenha and $senha!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Senhas não são iguais!'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            die();
        }
        //Valida se email existe
        $sqlEmail = "select login from usuarios where login='".$email."'";
        $result = mysqli_query($conn, $sqlEmail);
        if(mysqli_num_rows($result) > 0){
            $_SESSION['msgErro'] = $abreHTMLalert.'Email já cadastrado. Tente outro email.'.$fechaHTMLalert;
            header('location: ../usuarios.php');
            mysqli_close($conn);
            die();
        }
        //__________________________________________FAZ UPDATE___________________________________________________________________
        if (isset($_POST['nNome']) == true && $_POST['nNome'] != ""){  
            $sql='UPDATE usuarios SET nome ="'.$_POST['nNome'].'" WHERE idUsuario = '.$_GET['id'].';';
            $result = mysqli_query($conn,$sql);        
        }
        if (isset($_POST['nSobrenome']) == true && $_POST['nSobrenome'] != ""){  
            $sql='UPDATE usuarios SET sobrenome ="'.$_POST['Nsobrenome'].'" WHERE idUsuario = '.$_GET['id'].';';
            $result = mysqli_query($conn,$sql);        
        }
        if (isset($_POST['nSenha']) == true && $_POST['nSenha'] != ""){  
            $sql='UPDATE usuarios SET senha =md5("'.$_POST['nSenha'].'") WHERE idUsuario = '.$_GET['id'].';';
            $result = mysqli_query($conn,$sql);        
        }
        if (isset($_POST['nTipoUsu']) == true && $_POST['nTipoUsu'] != ""){  
            //Tira turma caso passe de comum para ADM
            if($_POST['nTipoUsu']==1){
                $sql='UPDATE usuarios SET tipo ="'.$_POST['nTipoUsu'].'", idTurma=null WHERE idUsuario = '.$_GET['id'].';';
            }else{
                $sql='UPDATE usuarios SET tipo ="'.$_POST['nTipoUsu'].'" WHERE idUsuario = '.$_GET['id'].';';
            }
            $result = mysqli_query($conn,$sql);        
        }
        if (isset($_POST['nTurma']) == true && $_POST['nTurma'] != "null"){  
            $sql='UPDATE usuarios SET idTurma ="'.$_POST['nTurma'].'" WHERE idUsuario = '.$_GET['id'].' and tipo=2;';
                                                                                                        //Bloqueia de colocar turma em ADM
            $result = mysqli_query($conn,$sql);        
        }
        mysqli_close($conn);
    }

    header('location:../usuarios.php');
?>