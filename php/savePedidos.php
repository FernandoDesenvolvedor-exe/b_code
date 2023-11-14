<?php
    session_start();

    include("connection.php");
    include("function.php");    

    if ($_GET['validacao'] == 'I'){ // INSERT

        $qtde = stripslashes($_POST['nQtdeProduto']);
        $obs = stripslashes($_POST['nObservacoes']);

        // set default timezone
        date_default_timezone_set('America/Sao_Paulo'); // CDT

        $info = getdate();
        $dia = $info['mday'];
        $mes = $info['mon'];
        $ano = $info['year'];
        $hora = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];

        $data = "$ano-$mes-$dia";
        $horario = "$hora:$min:$sec";

        $current_date = "$data $horario";

        if ($_POST['nStatus'] == 1){
            
            $sql = 'INSERT INTO pedidos(idUsuario,
                        idReceita,
                        idMaquina,
                        status,
                        observacoes,
                        quantidade,
                        ativo)
                        VALUES('.$_SESSION['idUsuario'].',
                        '.$_GET['id'].',
                        '.$_POST['nMaquina'].',
                        "'.$current_date.'",
                        '.$_POST['nStatus'].',
                        "'.$obs.'",
                        '.$qtde.',
                        1);';

        } else {

            $sql = 'INSERT INTO pedidos(idUsuario,
                        idReceita,
                        idMaquina,
                        dataHora_aberto,
                        status,
                        observacoes,
                        quantidade,
                        ativo)
                        VALUES('.$_SESSION['idUsuario'].',
                        '.$_GET['id'].',
                        '.$_POST['nMaquina'].',
                        "'.$current_date.'",
                        '.$_POST['nStatus'].',
                        "'.$obs.'",
                        '.$qtde.',
                        1);';
        }
        

        $result = mysqli_query($conn, $sql);        

        $arrayReceitas = receitas($_GET['id']);
        var_dump($arrayReceitas);
        die();

        $sql='INSERT INTO historico';

        mysqli_close($conn);

    } else if($_GET['validacao'] == 'D'){ // DESATIVAR RECEITA

        $sql = 'UPDATE pedidos SET ativo = 0 WHERE idPedido = '.$_GET['id'].';';

    }else if($_GET['validacao'] == 'DR'){ // DESATIVAR RECEITA

        $sql = 'UPDATE receitas SET ativo = 0 WHERE idReceita = '.$_GET['id'].';';
        
        header('location:../receitas.php? idProduto='.$_GET['id'].'&pr='.$_GET['pr'].'');

    } else if($_GET['validacao'] == 'A'){

        date_default_timezone_set('America/Sao_Paulo'); // CDT

        $info = getdate();
        $dia = $info['mday'];
        $mes = $info['mon'];
        $ano = $info['year'];
        $hora = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];

        $data = "$ano-$mes-$dia";
        $horario = "$hora:$min:$sec";

        $current_date = "$data $horario";

        if ($_GET['stats'] == 1){

            $sql = 'UPDATE pedidos SET status = 2 WHERE idPedido = '.$_GET['id'].';';

        } else if ($_GET['stats'] == 2){

            $sql = 'UPDATE pedidos SET status = 3, dataHora_fechado="'.$current_date.'" WHERE idPedido = '.$_GET['id'].';';

        }  

    } else if ($_GET['validacao'] == 'U'){

        $sql ='UPDATE pedidos SET observacoes = "'.$_POST['nObs'].'" WHERE idPedido = '.$_GET['id'].';';

    }

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    header('location:../producao.php');
?>