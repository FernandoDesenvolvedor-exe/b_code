<?php   
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php');  

    if($validacao == 'IM'){ 
        $validacao = $_GET["validacao"];
        $descricao = $_POST['nDescricao'];
        $classe = $_POST['nClasse'];
        $tipoMaterial = $_POST['nTipo'];
        $fornecedor = $_POST['nFornecedor'];
        $quantidade = $_POST['nQuandtidade'];
        $observacoes = $_POST['nObservacoes'];       
        
        $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, ativo, observacoes)" 
                ." VALUES(".$classe.",".$tipoMaterial.",'".$descricao."',".$quantidade.", 1, '".$observacoes."');";

        $result = mysqli_query($conn,$sql);  
        
        $idMaterial = buscaId("materia_prima","idMateriaPrima");

        $sql =" INSERT INTO materia_fornecedor(idMateriaPrima, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";
        
        $result = mysqli_query($conn,$sql);
        
        mysqli_close($conn);

        header('location: ../cadastroMaterial.php');
        
    }elseif($validacao == 'IP') {
        
        $validacao = $_GET["validacao"];
        $descricao = $_POST['nDescricao'];
        $codigo = $_POST['nCodigo'];
        $lote = $_POST['nLote'];    
        $tipoMaterial = $_POST['nTipo'];
        $fornecedor = $_POST['nFornecedor'];
        $quantidade = $_POST['nQuandtidade'];
        $observacoes = $_POST['nObservacoes']; 

        $sql = "INSERT INTO pigmentos(descicao, idTipoPigmento, quantidade, codigo, lote, observacoes, ativo)" 
                ." VALUES(".$descricao.",".$tipoMaterial.",'".$quantidade."',".$codigo.",".$lote.", 1, '".$observacoes."');";

        $result = mysqli_query($conn,$sql); 

        $idMaterial = buscaId("pigmentos","idPigmento");

        $sql =" INSERT INTO pigmento_fornecedor(idMateriaPrima, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";

        mysqli_close($conn);

        header('location: ../cadastroPigmento.php');

    }elseif($validacao == 'AF') {
        $sql= validaFornecedor($fornecedor);
    }

    $result = mysqli_query($conn,$sql);    
    mysqli_close($conn);      
?>