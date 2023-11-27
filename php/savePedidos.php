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


        $sql = 'INSERT INTO pedidos(
                    idUsuario,
                    idReceita,';        

        if ($_POST['nStatus'] == 1){

            $sql .='dataHora_aberto,';

        } else if ($_POST['nStatus'] == 2){

            $sql .='idMaquina,
                    dataHora_aberto,
                    dataHora_producao,';

        }       

        $sql .=    'status,
                    observacoes,
                    producaoPrevista,
                    ativo)
                    VALUES(
                    '.$_SESSION['idUsuario'].',
                    '.$_GET['id'].',';        

        if ($_POST['nStatus'] == 1){

            $sql .= '"'.$current_date.'",';

        } else if ($_POST['nStatus'] == 2){

            $sql .= ''.$_POST['nMaquina'].',
                    "'.$current_date.'",
                    "'.$current_date.'",';

        }

        $sql .=     ''.$_POST['nStatus'].',
                    "'.$obs.'",
                    '.$qtde.',
                    1);';

        $result = mysqli_query($conn, $sql);     

        $idPedido = buscaId("pedidos","idPedido");  
            
        for ($n = 0; $n < count($_POST['nMaterial']); $n++){            
            $sql = 'INSERT INTO historico_pedidos
                            (idPedido,
                            nomeUsuario,
                            tipoUsuario,
                            turma,
                            turno,
                            materiaPrima,
                            tipoMateria_prima,
                            classeMateria_prima,
                            pigmento,
                            tipoPigmento,
                            produto,';
            
            if ($_POST['nStatus'] == 2){
                $sql .='maquina,';
            }

            $sql .=
                            'producaoPrevista,
                            quantidadeMateria_prima,
                            quantidadePigmento,';
            
            if ($_POST['nStatus'] == 2){
                $sql .='dataHora_aberto,
                        dataHora_producao,';
            }
                
            $sql .=
                            'statusPedido,
                            obsPedido,
                            ativo)
                        VALUES(
                            '.$idPedido.',
                            "'.$_SESSION['nome'].'",
                            "'.$_SESSION['tipo'].'",
                            "'.$_SESSION['turma'].'",
                            "'.$_SESSION['turno'].'",
                            "'.$_POST['nMaterial'][$n].'",
                            "'.$_POST['nTipoMaterial'][$n].'",
                            "'.$_POST['nClasseMaterial'][$n].'",
                            "'.$_POST['nCor'].'",
                            "'.$_POST['nTipoCor'].'",
                            "'.$_POST['nProduto'].'",';
            
            if ($_POST['nStatus'] == 2){
                $sql .='"'.$_POST['nMaquina'].'",';
            }

            $sql .=
                            ''.$qtde.',
                            "'.$_POST['nQtdeMaterial'][$n].'",
                            '.$_POST['nQtdPigmento'].',';
            
            if ($_POST['nStatus'] == 2){
                $sql .='"'.$current_date.'",
                        "'.$current_date.'",';
            }

            $sql .=
                            ''.$_POST['nStatus'].',
                            "'.$obs.'",
                            1);'; 
                            
            $result = mysqli_query($conn, $sql);
            
            if($_POST['nStatus'] == 2){

                $sql2 =  'INSERT INTO historico_materia_prima(
                            idMateria,
                            nomeUsuario,
                            turma,
                            turno,
                            tipoUsuario,
                            nomeMateria,
                            quantidadeAlterada,
                            dataAlteracao,
                            ativo)
                        VALUES(
                            '.$_GET['idMateria'].',
                            "'.$_SESSION['nome'].'",
                            "'.$_SESSION['turma'].'",
                            "'.$_SESSION['turno'].'",
                            "'.$_SESSION['tipo'].'",
                            "'.$_POST['nMaterial'][$n].'",
                            '.-($qtde * $_POST['nQtdeMaterial'][$n]).',
                            '.$current_date.',
                            1);';
                                
                var_dump($sql);
                die();
                $result = mysqli_query($conn, $sql2);

            }
        }

        mysqli_close($conn);

    } else if($_GET['validacao'] == 'D'){ // DESATIVAR Pedido
        
        include("connection.php");
        $sql = 'UPDATE pedidos SET ativo = 0 WHERE idPedido = '.$_GET['id'].';';

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        
        include("connection.php");
        $sql = 'UPDATE historico_pedidos SET ativo = 0 WHERE idPedido = '.$_GET['id'].';';

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

            $sql = 'UPDATE pedidos SET 
                        status = 2, 
                        dataHora_producao="'.$current_date.'",
                        idMaquina=  
                        WHERE idPedido = '.$_GET['id'].';';
            $result = mysqli_query($conn, $sql);

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