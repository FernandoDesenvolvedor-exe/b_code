<?php   
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php'); 

    $validacao = $_GET["validacao"]; 
    $descricao = $_POST['nDescricao'];
    
    //INSERT na tabela materia_prima e na tabela material_fornecedor
    if($validacao == 'IM'){       
        
        $quantidade = $_POST['nQuandtidade'];
        $classe = $_POST['nClasse'];       
        $tipoMaterial = $_POST['nTipo'];
        $observacoes = $_POST['nObservacoes'];
        $fornecedor = $_POST['nFornecedor'];

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

    //INSERT na tabela pigmentos e na tabela pigmento_fornecedor
    }else if($validacao == 'IP') {

        $quantidade = $_POST['nQuandtidade'];          
        $tipoMaterial = $_POST['nTipo'];
        $observacoes = $_POST['nObservacoes'];
        $fornecedor = $_POST['nFornecedor'];
        $codigo = $_POST['nCodigo'];
        $lote = $_POST['nLote'];   

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

    }else if($validacao == 'IF') {

        //Script SQL que insere na tabela fornecedores os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO fornecedores(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);
        
    }

    $result = mysqli_query($conn,$sql);    
    mysqli_close($conn);      
?>