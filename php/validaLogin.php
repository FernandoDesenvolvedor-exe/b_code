<?php
    session_start();

    //stripslashes coloca uma barra dps de um caractere especial para evitar errro no codigo sql

    $login = stripslashes($_POST['nLogin']);
    $senha = stripslashes($_POST['nSenha']);
    $_SESSION['msgLogin'] = '';

    $abreHTMLalert = '<div class="input-group mb-3">'
                        .'<div class="input-group-prepend" style="width: 100%; height:100%;">'
                            .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    

    //var_dump($login.''.$senha);
    //die();

    include('connection.php');

    $_SESSION['msgLogin'] = '';
    
    $sql = 'SELECT user.idUsuario, 
                user.login as login,
                user.senha as senha,
                user.nome as name,
                user.sobrenome as surname,
                user.tipo as tipo,
                user.ativo as ativo
                turma.turno as turno,
                turma.nomeTurma as turma
                FROM usuarios as user
                LEFT JOIN turma 
                ON user.idTurma = turma.idTurma      
                WHERE user.login = "'.$login.'";';

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

            //validar Senha
            if($campo['senha'] == md5($_POST['nSenha'])){
                    
                //valida se conta esta ativa
                if($campo['ativo'] == 1){

                    //joga o usuario pra tela de acordo com o nivel de acesso dele
                    $_SESSION['idUsuario']= $campo['idUsuario'];
                    $_SESSION['nome']= ''.$campo['name'].' '.$campo['surname'];
                    $_SESSION['tipo'] = $campo['tipo'];
                    $_SESSION['turma'] = $campo['turma'];
                    $_SESSION['turno'] = $campo['turno'];

                    header('location:../index.php');

                }else{
                    //usuario Inativo
                    $_SESSION['msgLogin'] = $abreHTMLalert.'Usuário inativo'.$fechaHTMLalert;
                    header('location:../login.php');
                    die();
                }
            }else{
                //senha incorreta
                $_SESSION['msgLogin'] = $abreHTMLalert.'Senha incorreta'.$fechaHTMLalert;
                header('location:../login.php');
                die();
            }
        }
        
    } else {
        //menssagem de email nao cadastrado
        $_SESSION['msgLogin'] = $abreHTMLalert.'Email não cadastrado'.$fechaHTMLalert;
        header('location:../login.php');
    };
?>