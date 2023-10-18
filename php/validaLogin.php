<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }      

    //stripslashes coloca uma barra dps de um caractere especial para evitar errro no codigo sql

    $login = stripslashes($_POST['nLogin']);
    $senha = stripslashes($_POST['nSenha']);
    $tipoAcesso = $_GET['tipo'];

    //var_dump($login.''.$senha);
    //die();

    include('connection.php');

    $_SESSION['msgLogin'] = '';
    
    $sql = "SELECT *"
            ." FROM usuarios" 
            ." WHERE login = '".$login."';";

    //var_dump($sql);

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);     

    //valida Email
    if (mysqli_num_rows($result) > 0) {        
        
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);            
        }

        foreach($array as $campo){      
            //var_dump($campo['senha'].'/'.md5($_POST['nSenha']));
            //die(); //teste para caso senha esteja errada

            //validar Senha
            if($campo['senha'] == md5($_POST['nSenha'])){
                    
                //valida se conta esta ativa
                if($campo['ativo'] == 'S'){

                    //joga o usuario pra dela de acordo com o nivel de acesso dele

                    $_SESSION['tipo'] = $campo['tipo'];

                    switch($campo['idUsuario']){
                        case 1:
                            header('location:../telaAdmin.php?tipo');
                        break;

                        case 2:
                            header('location:../telaComum.php');
                        break;

                        default:
                            $_SESSION['msgLogin'] = 'Nivel de acesso do usuário invalido';
                            header('location:../login.php');
                            die();
                        break;
                    }

                }else{
                    //usuario Inativo
                    $_SESSION['msgLogin'] = 'usuario Inativo';
                    header('location:../login.php');
                    die();
                }
            }else{
                //senha incorreta
                $_SESSION['msgLogin'] = 'senha incorreta';
                header('location:../login.php');
                die();
            }
        }
        
    } else {
        //menssagem de email nao cadastrado
        $_SESSION['msgLogin'] = 'email nao cadastrado';
        header('location:../login.php');
    };
?>