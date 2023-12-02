<?php
/*
VALIDAÇÕES
-login - ok
*/
    include('function.php');
    include('connection.php');
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $abreHTMLalert = '<div class="input-group mb-3">
                        <div class="input-group-prepend" style="width: 100%; height:100%;">
                            <div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    $login = stripslashes($_POST['nLogin']);
    $senha = stripslashes($_POST['nSenha']);
    $_SESSION['msgLogin'] = '';
    if(!validarDado(2,$login)){
        $_SESSION['msgLogin'] = $abreHTMLalert.'Email inválido!'.$fechaHTMLalert;
        header('location: ../login.php');
        die();
    }
    if(!validarDado(3,$senha)){
        $_SESSION['msgLogin'] = $abreHTMLalert.'Senha inválida!'.$fechaHTMLalert;
        header('location: ../login.php');
        die();
    }
    $sql = 'SELECT user.idUsuario, 
                user.senha as password,
                user.nome as name,
                user.sobrenome as surname,
                user.tipo as nivel,
                user.ativo as active,
                turma.turno as turn,
                turma.nomeTurma as class
                FROM usuarios as user
                LEFT JOIN turma 
                ON user.idTurma = turma.idTurma      
                WHERE user.login = "'.$login.'";';

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);     

    //valida Email
    if (mysqli_num_rows($result) > 0) {        
        
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);            
        }

        foreach($array as $campo){      

            //validar Senha
            if($campo['password'] == md5($_POST['nSenha'])){
                    
                //valida se conta esta ativa
                if($campo['active'] == 1){

                    $_SESSION['user']               = 1;
                    $_SESSION['idUsuario']          = $campo['idUsuario'];
                    $_SESSION['login']              =$login;
                    $_SESSION['nome']               = ''.$campo['name'].' '.$campo['surname'];
                    $_SESSION['tipo']               = $campo['nivel'];
                    $_SESSION['turma']              = $campo['class'];
                    $_SESSION['turno']              = $campo['turn'];
                    $_SESSION['filtroHistorico']    = '1 = 1';
                    $_SESSION['filtro']             = 0;

                    header('location:../producao');
                }else{
                    //usuario Inativo
                    $_SESSION['user'] = 0;
                    $_SESSION['msgLogin'] = $abreHTMLalert.'Usuário inativo'.$fechaHTMLalert;
                    header('location:../login');
                    die();
                }
            }else{
                //senha incorreta
                $_SESSION['user'] = 0;
                $_SESSION['msgLogin'] = $abreHTMLalert.'Senha incorreta'.$fechaHTMLalert;
                header('location:../login');
                die();
            }
        }
        
    } else {
        //menssagem de email nao cadastrado
        $_SESSION['user'] = 0;
        $_SESSION['msgLogin'] = $abreHTMLalert.'Email não cadastrado'.$fechaHTMLalert;
        header('location:../login');
    };
?>