<?php
    session_start();

    include("connection.php");
    include("function.php");    

    if ($_GET['validacao'] == 'I'){

        $qtde = stripslashes($_POST['nQtdeProduto']);
        $obs = stripslashes($_POST['nObservacoes']);

        if ($_POST['nStatus'] == 1){

            $sql = 'INSERT INTO pedidos(idUsuario,'
                    .' idReceita,'
                    .' idMaquina,'
                    .' status,'
                    .' observacoes,'
                    .' quantidade,'
                    .' ativo)'
                    .' VALUES('.$_SESSION['idUsuario'].','
                    .' '.$_GET['id'].','
                    .' '.$_POST['nMaquina'].','
                    .' '.$_POST['nStatus'].','
                    .' "'.$obs.'",'
                    .' '.$qtde.','
                    .' 1);';

        } else if ($_POST['nStatus'] == 2) {

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

            $sql = 'INSERT INTO pedidos(idUsuario,'
                    .' idReceita,'
                    .' idMaquina,'
                    .' dataHora_aberto,'
                    .' status,'
                    .' observacoes,'
                    .' quantidade,'
                    .' ativo)'
                    .' VALUES('.$_SESSION['idUsuario'].','
                    .' '.$_GET['id'].','
                    .' '.$_POST['nMaquina'].','
                    .' "'.$current_date.'",'
                    .' '.$_POST['nStatus'].','
                    .' "'.$obs.'",'
                    .' '.$qtde.','
                    .' 1);';
        }

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        header('location:../pedidos.php');
    }
?>