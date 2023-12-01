<?php

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php'); 

    $validacao = $_GET["validacao"]; 

    if($validacao == 'IP') {    //insert pigmento

        $descricao = stripslashes($_POST['nDescricao']);
        $observacoes = stripslashes($_POST['nObservacoes']);
        $codigo = stripslashes($_POST['nCodigo']);
        $lote = stripslashes($_POST['nLote']);   

        //Script SQL que insere na tabela pigmentos so valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO pigmentos(descricao, idTipoPigmento, quantidade, codigo, lote, ativo, observacoes)" 
                ." VALUES('".$descricao."',".$_POST['nTipo'].",".$_POST['nQuandtidade'].",'".$codigo."','".$lote."', 1, '".$observacoes."');";

        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql); 

        //Traz o id dos dados Inseridos acima na tabela 
        $idMaterial = buscaId("pigmentos","idPigmento");

        //Script SQL a ser enviado ao banco de dados
        $sql =" INSERT INTO pigmento_fornecedor(idPigmento, idFornecedor) VALUES (".$idMaterial.",".$_POST['nFornecedor'].");";
        
        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql); 

        if (count($_POST['nMateriaPrima']) > 0){ 

            for($n = 0; $n < count($_POST['nMateriaPrima']); $n++){
                
                $sql = "INSERT INTO materia_pigmento(idMateriaPrima, idPigmento)"
                        ."VALUES(".$_POST['nMateriaPrima'][$n].", ".$idMaterial.");";

                $result = mysqli_query($conn, $sql);
            } 
        }        

        //fecha a conexão
        mysqli_close($conn);

    } else if($validacao == 'IT'){    // insert tipo pigmentos

        $descricao = stripslashes($_POST['nTipoPigmento']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO tipo_pigmentos (descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);
    
    } else if($validacao == 'D'){  // DESATIVA UM CADASTRO DE PIGMENTO

        $sql='UPDATE pigmentos SET ativo=0 WHERE idPigmento='.$_GET['id'].'';    

        $result = mysqli_query($conn,$sql); 
        mysqli_close($conn);

    } else if($validacao == 'U'){  // ATUALIZA UM CADASTRO DE PIGMENTO

        $descricao = stripslashes($_POST['nDescricao']);
        $obs = stripslashes($_POST['nObservacoes']);
        $codigo = stripslashes($_POST['nCodigo']);
        $lote = stripslashes($_POST['nLote']);


        if (isset($descricao) == true && $descricao != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE pigmentos'
                    .' SET descricao ="'.$descricao.'"'
                    .' WHERE idPigmento = '.$_GET['id'].';';
        
            $result = mysqli_query($conn,$sql);
        }

        if (isset($_POST['nQuandtidade']) == true && $_POST['nQuandtidade'] != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE pigmentos'
                    .' SET quantidade ="'.$_POST['nQuandtidade'].'"'
                    .' WHERE idPigmento = '.$_GET['id'].';';
        
            $result = mysqli_query($conn,$sql);
        }

        if (isset($obs) == true && $obs != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE pigmentos'
                    .' SET observacoes ="'.$obs.'"'
                    .' WHERE idPigmento = '.$_GET['id'].';';
        
            $result = mysqli_query($conn,$sql);  
        }

        if (isset($_POST['nTipo']) == true && $_POST['nTipo'] != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE pigmentos'
                    .' SET idTipoPigmento ="'.$_POST['nTipo'].'"'
                    .' WHERE idPigmento = '.$_GET['id'].';';

            $result = mysqli_query($conn,$sql);  
        }
        
        if (isset($_POST['nFornecedor']) == true && $_POST['nFornecedor'] != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE pigmento_fornecedor'
                    .' SET idFornecedor ="'.$_POST['nFornecedor'].'"'
                    .' WHERE idPigmento = '.$_GET['id'].';';

            $result = mysqli_query($conn,$sql);        
        }
        
        mysqli_close($conn);

    }

    header('location: ../pigmentos.php');
?>