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

        $sql = 'INSERT INTO pedidos(idUsuario,
                    idReceita,';
        
        if ($_POST['nStatus'] == 2){
            $sql .='idMaquina,
                    dataHora_aberto,';
        }
        
        $sql .=    'status,
                    observacoes,
                    quantidade,
                    ativo)
                    VALUES('.$_SESSION['idUsuario'].',
                    '.$_GET['id'].',';
        
        if ($_POST['nStatus'] == 2){
            $sql .= ''.$_POST['nMaquina'].',
                    "'.$current_date.'",';
        }

        $sql .=     ''.$_POST['nStatus'].',
                    "'.$obs.'",
                    '.$qtde.',
                    1);';

        $result = mysqli_query($conn, $sql);     

        $idPedido = buscaId("pedidos","idPedido");

        for ($n = 0; $n < count($_POST['nMaterial']); $n++){
        
            $sql = 'INSERT INTO historico
                        VALUES(idPedido,
                            idUsuario,
                            materiaPrima,
                            tipoMateria_prima,
                            classeMateria_prima,
                            pigmento,
                            tipoPigmento,
                            produto,
                            maquina,
                            quantidadeProduto,
                            quantidadeMateria_prima,
                            quantidadePigmento,
                            dataHora_aberto,
                            statusPedido,
                            obsPedido,
                            obsReceita)
                        VALUES(
                            '.$idPedido.',
                            '.$_SESSION['idUsuario'].',
                            '.$_POST['nMaterial'][$n].',
                            '.$_POST['idTipoMaterial'][$n].',
                            '.$_POST['idClasseMaterial'][$n].',
                            '.$_POST['nCor'].',
                            '.$_POST['nTipoCor'].',
                            '.$_POST['nProduto'].',
                            '.$_POST['nMaquina'].',
                            '.$qtde.',
                            '.$_POST['nQtdeMaterial'][$n].',
                            '.$_POST['nQtdPigmento'][$n].',
                            '.$current_date.',
                            '.$_POST['nStatus'].',
                            "'.$obs.'",
                            );';            

        }

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