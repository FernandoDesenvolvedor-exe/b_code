<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }      

    //stripslashes coloca uma barra dps de um caractere especial para evitar errro no codigo sql

    $login = stripslashes($_POST['nLogin']);
    $senha = stripslashes($_POST['nSenha']);
    

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
                if($campo['ativo'] == 1){

                    //joga o usuario pra tela de acordo com o nivel de acesso dele
                    $_SESSION['idUsuario']=$campo['idUsuario'];
                    $_SESSION['tipo'] = $campo['tipo'];

                    switch(intval($campo['tipo'])){
                        case 1:
                            //$_SESSION['msgLogin'] = 'Entrou Adm';
                            header('location:../index.php');
                        break;

                        case 2:
                            //$_SESSION['msgLogin'] = 'Entrou comum';
                            header('location:../index.php');
                        break;

                        default:
                            $_SESSION['msgLogin'] = 'Nivel de acesso do usuário inválido.';
                            header('location:../login.php');
                            die();
                        break;
                    }

                }else{
                    //usuario Inativo
                    $_SESSION['msgLogin'] = 'Usuário inativo.';
                    header('location:../login.php');
                    die();
                }
            }else{
                //senha incorreta
                $_SESSION['msgLogin'] = 'Senha incorreta.';
                header('location:../login.php');
                die();
            }
        }
        
    } else {
        //menssagem de email nao cadastrado
        $_SESSION['msgLogin'] = 'Email não cadastrado.';
        header('location:../login.php');
    };
?>