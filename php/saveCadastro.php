<?php   
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php'); 

    $validacao = $_GET["validacao"];   

    if($validacao == 'IMP'){    //insert materia prima

        $descricao = stripslashes($_POST['nDescricao']);
        $quantidade = stripslashes($_POST['nQuandtidade']);
        $classe = stripslashes($_POST['nClasse']);       
        $tipoMaterial = stripslashes($_POST['nTipo']);
        $observacoes = stripslashes($_POST['nObservacoes']);
        $fornecedor = stripslashes($_POST['nFornecedor']);

        //Script SQL que insere na tabela materia_prima os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, ativo, observacoes)" 
                ." VALUES(".$classe.",".$tipoMaterial.",'".$descricao."',".$quantidade.", 1, '".$observacoes."');";

        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql);  
        
        //Traz o id dos dados Inseridos acima na tabela 
        $idMaterial = buscaId("materia_prima","idMateriaPrima");

        $sql =" INSERT INTO materia_fornecedor(idMateriaPrima, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";
        
        $result = mysqli_query($conn,$sql);
        
        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroMaterial.php');

    }else if($validacao == 'IP') {    //insert pigmento

        $descricao = stripslashes($_POST['nDescricao']);
        $quantidade = stripslashes($_POST['nQuandtidade']);          
        $tipoMaterial = stripslashes($_POST['nTipo']);
        $observacoes = stripslashes($_POST['nObservacoes']);
        $fornecedor = stripslashes($_POST['nFornecedor']);
        $codigo = stripslashes($_POST['nCodigo']);
        $lote = stripslashes($_POST['nLote']);   

        //Script SQL que insere na tabela pigmentos so valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO pigmentos(descricao, idTipoPigmento, quantidade, codigo, lote, ativo, observacoes)" 
                ." VALUES('".$descricao."',".$tipoMaterial.",".$quantidade.",'".$codigo."','".$lote."', 1, '".$observacoes."');";

        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql); 

        //Traz o id dos dados Inseridos acima na tabela 
        $idMaterial = buscaId("pigmentos","idPigmento");

        //Script SQL a ser enviado ao banco de dados
        $sql =" INSERT INTO pigmento_fornecedor(idPigmentos, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";
        
        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroPigmento.php');

    }else if($validacao == 'IF') {        //insert fornecedor

        $descricao = stripslashes($_POST['nFornecedor']);
        //Script SQL que insere na tabela fornecedores os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO fornecedores(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');

    }else if($validacao == 'iCM'){  //insert classe materia prima        

        $descricao = stripslashes($_POST['nClasse']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO classe_material(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');

    }else if($validacao == 'ITM'){   // insert tipo materia prima
 
        $descricao = stripslashes($_POST['nTipoMateria']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO tipo_materia_prima(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');

    }else if($validacao == 'ITP'){    // insert tipo pigmentos

        $descricao = stripslashes($_POST['nTipoPigmento']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO tipo_pigmentos (descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');
    
    }else if($validacao == 'IR'){  // Insert Relação entre um pigmento e matéria prima  

        $pigmento = $_POST['nPigmento'];

        for($i = 0; $i < count($_POST['nMateriaPrima']); $i++){
            
            $sql = "INSERT INTO materia_pigmento(idMateriaPrima, idPigmento)"
                    ."VALUES(".$_POST['nMateriaPrima'][$i].", ".$pigmento.");";

            $result = mysqli_query($conn, $sql);
        }

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroRelacao.php');
    }else if($validacao == 'IM'){   // Insert um cadastro de mauina   

        $descricao = $_POST['nMaquina'];

        $sql = "INSERT INTO maquinas(descricao, ativo)"
                ." VALUES('".$descricao."', 1);";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        header('location: ../cadastroMaquina.php');
    }
?>