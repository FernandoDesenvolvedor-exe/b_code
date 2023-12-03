<?php
    session_start();

    include("connection.php");
    include("function.php");    

    if ($_GET['validacao'] == 'I'){ // INSERT
        mysqli_close($conn);

        $qtde = stripslashes($_POST['nQtdeProduto']);
        $obs = stripslashes($_POST['nObservacoes']);
        $status = $_POST['nStatus'.$_GET['id'].''];

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
        
        $_SESSION['msg'] = 'Pedido aberto!';

        for ($n = 0; $n < count($_POST['nMaterial']); $n++){ 
            if(validaEstoque($_POST['nIdMaterial'][$n],$_POST['nQuantidadeMat'][$n]) == false){
                $status = 1;
                $_SESSION['msg'] .=  $_POST['nMaterial'][$n].': Material insuficiente!';
            }
        }
        
        if($status == 2){
            for ($n = 0; $n < count($_POST['nMaterial']); $n++){ 
                if(validaEstoque($_POST['nIdMaterial'][$n],$_POST['nQuantidadeMat'][$n]) == false){
                    $sql = 'UPDATE materia_prima SET quantidade = -'.($_POST['nQuantidadeMat'][$n] * $qtde).' WHERE idMateriaPrima = '.$_POST['nIdMaterial'][$n].'';

                    include('connection.php');
                    $result = mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }                                
            }
        }

        $sql = 'INSERT INTO pedidos(
                    idUsuario,
                    idReceita,';        

        if ($status == 1){

            $sql .='dataHora_aberto,';

        } else if ($status == 2){

            $sql .='idMaquina,
                    dataHora_aberto,
                    dataHora_producao,';

        }       

        $sql .=    'status,
                    observacoes,
                    producaoPrevista)
                    VALUES(
                    '.$_SESSION['idUsuario'].',
                    '.$_GET['id'].',';        

        if ($status == 1){

            $sql .= '"'.$current_date.'",';

        } else if ($status == 2){

            $sql .= ''.$_POST['nMaquina'].',
                    "'.$current_date.'",
                    "'.$current_date.'",';

        }

        $sql .=     ''.$status.',
                    "'.$obs.'",
                    '.$qtde.');';

        include('connection.php');
        $result = mysqli_query($conn, $sql);     
        mysqli_close($conn);

        $idPedido = buscaId("pedidos","idPedido");  
            
        for ($n = 0; $n < count($_POST['nMaterial']); $n++){            
            $sql = 'INSERT INTO historico_pedidos
                           (idHistorico,
                            nomeUsuario,
                            tipoUsuario,
                            turma,
                            turno,
                            idPedido,
                            materiaPrima,
                            tipoMateria_prima,
                            classeMateria_prima,
                            fornecedorMateria_Prima,
                            pigmento,
                            tipoPigmento,
                            codigo,
                            lote,
                            fornecedorPigmento,
                            produto,
                            ferramental,
                            tipoFerramental,
                            maquina,
                            producaoPrevista,
                            quantidadeMateria_prima,
                            quantidadePigmento,            
                            dataHora_aberto,
                            dataHora_producao,
                            dataHora_fechado,
                            dataHora_alterado,
                            statusPedido,
                            obsPedido)
                        VALUES(
                            '.$idPedido.',
                            "'.$_SESSION['nome'].'",
                            "'.$_SESSION['tipo'].'",
                            "'.$_SESSION['turma'].'",
                            "'.$_SESSION['turno'].'",
                            '.$idPedido.',
                            "'.$_POST['nMaterial'][$n].'",
                            "'.$_POST['nTipoMaterial'][$n].'",
                            "'.$_POST['nClasseMaterial'][$n].'",
                            "'.$_POST['nMateriaFornecedor'][$n].'",
                            "'.$_POST['nCor'].'",
                            "'.$_POST['nTipoCor'].'",
                            "'.selectCor($_POST['nPigmento'],1).'",
                            "'.selectCor($_POST['nPigmento'],2).'",
                            "'.$_POST['nCorFornecedor'].'",
                            "'.$_POST['nProduto'].'",
                            "'.$_POST['nMolde'].'",
                            "'.$_POST['nTipoMolde'].'",';

            if($status == 1){                
                $sql .='"Pendente",';
            } else if ($status == 2){
                $sql .='"'.maquinaNome($_POST['nMaquina']).'",';
            }

            $sql .=
                            ''.$qtde.',
                            '.($_POST['nQuantidadeMat'][$n]*$qtde).',
                            '.($_POST['nQtdPigmento']*$qtde).',';
            
            if($status == 1){                
                $sql .='"'.$current_date.'",
                        "0000-00-00 00:00:00",
                        "0000-00-00 00:00:00",
                        "0000-00-00 00:00:00",';
            } else if ($status == 2){
                $sql .='"'.$current_date.'",
                        "'.$current_date.'",
                        "0000-00-00 00:00:00",
                        "0000-00-00 00:00:00",';
            }

            $sql .=
                            ''.$status.',
                            "'.$obs.'");'; 
                            
            include('connection.php');
            $result = mysqli_query($conn, $sql);     
            mysqli_close($conn);            
        }        

    } else if($_GET['validacao'] == 'D'){ // DESATIVAR Pedido
        
        include("connection.php");
        $sql = 'UPDATE pedidos SET status = 0 WHERE idPedido = '.$_GET['id'].';';

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        
        include("connection.php");
        $sql = 'UPDATE historico_pedidos SET statusPedido = 0 WHERE idPedido = '.$_GET['id'].';';

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

    } else if($_GET['validacao'] == 'DR'){ // DESATIVAR RECEITA

        $sql = 'UPDATE receitas SET ativo = 0 WHERE idReceita = '.$_GET['id'].';';

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        
        header('location:../receitas.php? idProduto='.$_GET['id'].'&pr='.$_GET['pr'].'');

    } else if($_GET['validacao'] == 'A'){

        date_default_timezone_set('America/Sao_Paulo');

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

            include('connection.php');
            $sql = 'UPDATE pedidos SET 
                        status = 2, 
                        dataHora_producao="'.$current_date.'",
                        idMaquina=  
                        WHERE idPedido = '.$_GET['id'].';';
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            
            include('connection.php');
            $sql = 'UPDATE historico_pedidos 
                        SET statusPedido = 2,
                        dataHora_producao="'.$current_date.'" 
                        WHERE idPedido = '.$_GET['id'].';';
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

        } else if ($_GET['stats'] == 2){

            $sql = 'UPDATE pedidos 
                    SET status = 3, 
                    dataHora_fechado="'.$current_date.'",
                    refugo ='.$_POST['nRefugo'].',
                    producaoRealizada ='.($_POST['nReal'] - $_POST['nRefugo']).' 
                    WHERE idPedido = '.$_GET['id'].';';

            $result = mysqli_query($conn, $sql);            

            $sql = 'UPDATE historico_pedidos 
                        SET statusPedido = 3, 
                        dataHora_fechado="'.$current_date.'",
                        refugo ='.$_POST['nRefugo'].',
                        producaoRealizada ='.$_POST['nReal'].' 
                        WHERE idPedido = '.$_GET['id'].';';

            $result = mysqli_query($conn, $sql);

            mysqli_close($conn);
        }  

    } else if ($_GET['validacao'] == 'U'){

        $sql ='UPDATE pedidos SET observacoes = "'.$_POST['nObs'].'" WHERE idPedido = '.$_GET['id'].';';

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    } 
    
    header('location:../producao');
?>