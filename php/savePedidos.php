<?php
    session_start();

    include("connection.php");
    include("function.php");    

    if ($_GET['validacao'] == 'I'){

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

    } else if($_GET['validacao'] == 'D'){

        $sql = 'UPDATE pedidos SET ativo = 0 WHERE idPedido = '.$_GET['id'].';';

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