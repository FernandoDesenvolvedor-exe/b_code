<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include("function.php");    
    include('connection.php');
    $abreHTMLalert = '<div class="input-group mb-3">
                        <div class="input-group-prepend" style="width: 100%; height:100%;">
                            <div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    if ($_GET['validacao'] == 'I'){ // INSERT
        mysqli_close($conn);

        $qtde = stripslashes($_POST['nQtdeProduto']);
        $obs = stripslashes($_POST['nObservacoes']);
        $status = $_POST['nStatus'.$_GET['id'].''];

        
        if(!validarDado(2,$obs) && $obs!=''){
            $_SESSION['msgErro'] = $abreHTMLalert.'Observação. Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../receitas.php?&idProduto='.$_GET['idProduto'].'&pr='.$_GET['pr']);
            die();
        }

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
        
        $_SESSION['msgSucesso'] = ' <h4 class="alert-heading">Sucesso!</h4><br>
                                        <p>Ordem de produção Registrada!</p><br>                                
                                        <hr>';

        $_SESSION['msgAviso'] = ' <h4 class="alert-heading">Aviso!</h4><br>
                                        <p>Ordem de produção Registrada!</p><br>                                
                                        <hr>';

        /*$_SESSION['msgPerigo'] = '     <h4 class="alert-heading">Sucesso!</h4><br>
                                        <p>Ordem de produção Registrada!</p><br>                                
                                        <hr>
                                        <p>Descontado do estoque</p>';*/

        // valida se a quantidade de material no estoque supre a 
        // quantidade necessária do pedido se o mesmo for registrado em andamento.

        if($status == 2){           
            for ($n = 0; $n < count($_POST['nMaterial']); $n++){ 
                $valorTotal = $_POST['nQuantidadeMat'][$n] * $_POST['nQtdeProduto'];
                $tabela = 'materia_prima';
                $chavePrimaria = 'idMateriaPrima'; 

                if(validaEstoque($_POST['nIdMaterial'][$n],$valorTotal,$tabela,$chavePrimaria) == false){
                    $status = 1;
                    $_SESSION['msgAviso'] .= '<p class="mb-0">'.$_POST['nMaterial'][$n].': Material insuficiente!</p><br>';              
                }
            }

            $valorTotal = $_POST['nQtdPigmento'][$n] * $_POST['nQtdeProduto'];
            $tabela = 'pigmentos';
            $chavePrimaria = 'idPigmento'; 

            if(validaEstoque($_POST['nPigmento'],$valorTotal,$tabela,$chavePrimaria) == false){
                $status = 1;
                $_SESSION['msgAviso'] .= '  <p class="mb-0">'.$_POST['nCor'][$n].'- '.$_POST['nTipoCor'].': Material insuficiente!</p><br>';
            }
            
            if($status == 1){                
                $_SESSION['ativaMsgA'] = 1; 
                $_SESSION['msgAviso'] .= '<p>Status da OP: '.nomeStatus($status).'</p>';
            }

            //se qualquer um dos materiais requisitados não forem o suficiente, 
            //o pedido fica em aberto e grava uma menssagem mostrando quais materiais estão em falta

            //Um pedido só pode ser inicializado quando o estoque tiver material o suficiente para supri-lo
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

            //Cria um registro em historico_pedidos para cada materia prima 

            $sql = 'INSERT INTO historico_pedidos
                           (idHistorico,
                            nomeUsuario,
                            tipoUsuario,
                            turma,
                            turno,
                            idPedido,
                            idMateriaPrima,
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
                            idFerramental,
                            ferramental,
                            tipoFerramental,
                            maquina,
                            producaoPrevista,
                            quantidadeMateria_prima,
                            quantidadeReciclado,
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
                            '.$_POST['nIdMaterial'][$n].',
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
                            "'.getIdFerramental($_GET['idProduto']).'",
                            "'.$_POST['nMolde'].'",
                            "'.$_POST['nTipoMolde'].'",';

            if($status == 1){                
                $sql .='"Pendente",';
            } else if ($status == 2){
                $sql .='"'.maquinaNome($_POST['nMaquina']).'",';
            }

            $sql .=
                            ''.$qtde.',
                            '.$_POST['nQuantidadeMat'][$n].',
                            0,
                            '.$_POST['nQtdPigmento'].',';
            
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
                            
            //var_dump($sql);
            //die();               
            include('connection.php');            
            $result = mysqli_query($conn, $sql);     
            mysqli_close($conn);      
        }
                
        if($status == 2){     
            alteraEstoque($idPedido);
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

    } else if($_GET['validacao'] == 'DR'){ // DESATIVAR/ATIVAR RECEITA
        include('connection.php');
        if($_GET['op']==1){
            $sqlUpdate = 'UPDATE receitas SET ativo = 1 WHERE idReceita = '.$_GET['id'].' AND ativo=0;';     
            $result = mysqli_query($conn,$sqlUpdate);
            mysqli_close($conn);
        }else{
            $sqlUpdate = 'UPDATE receitas SET ativo = 0 WHERE idReceita = '.$_GET['id'].' AND ativo=1;';
            $result = mysqli_query($conn,$sqlUpdate);
            mysqli_close($conn);
        }
        header('location:../receitas.php?idProduto='.$_GET['idProduto'].'&pr='.$_GET['pr']);
        die();

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

            alteraEstoque($_GET['id']);

            if($_SESSION['ativaMsgS'] == 1 && $_SESSION['ativaMsgA'] == 0){
                include('connection.php');
                $sql = 'UPDATE pedidos SET status = 2, 
                            dataHora_producao="'.$current_date.'",
                            idMaquina='.$_POST['nMaquina'].' 
                            WHERE idPedido = '.$_GET['id'].';';
                $result = mysqli_query($conn, $sql);
                mysqli_close($conn);            
    
                include('connection.php');
                $sql = 'UPDATE historico_pedidos 
                            SET statusPedido = 2,
                            dataHora_producao="'.$current_date.'", 
                            maquina = "'.maquinaNome($_POST['nMaquina']).'"
                            WHERE idPedido = '.$_GET['id'].';';
                $result = mysqli_query($conn, $sql);
                mysqli_close($conn);
            }
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

    } else if($_GET['validacao'] == 'U'){
        include("connection.php");
        if(!validarDado(2,$_POST['nObs'])){
            $_SESSION['msgErro'] = $abreHTMLalert.'Observação. Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../producao');
            die();
        }
        $sql ='UPDATE pedidos SET observacoes = "'.$_POST['nObs'].'" WHERE idPedido = '.$_GET['id'].';';
        $result = mysqli_query($conn, $sql);
        $sql ='UPDATE historico_pedidos SET obsPedido = "'.$_POST['nObs'].'" WHERE idPedido = '.$_GET['id'].';';
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    } else if($_GET['validacao'] == 'UR'){
        $sql = 'SELECT quantidadeReciclado FROM historico_pedidos WHERE idPedido = '.$_GET['idPedido'].';';

        include("connection.php");
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        $pedidoReciclado = '';

        if(mysqli_num_rows($result) > 0){            
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            $n = 1;

            foreach($array as $campo){
                $pedidoReciclado = $campo['quantidadeReciclado'];
            }
        }

        $soma = $pedidoReciclado + $_POST['nqtdReciclado'];

        $sql = 'UPDATE historico_pedidos SET quantidadeReciclado = '.$soma.' WHERE idPedido = '.$_GET['idPedido'].'';

        include("connection.php");
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }else if($_GET['validacao'] == 'R'){

        $sql = 'UPDATE historico_pedidos set statusPedido = '.$_GET['stats'].' where idPedido = '.$_GET['id'].'';

        include("connection.php");
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    
    header('location:../producao');
    die();
?>