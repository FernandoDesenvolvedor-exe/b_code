<?php   
    include('connection.php');
    include('function.php');  

    $validacao = $_GET["validacao"];
    $descricao = $_POST['nDescricao'];      
    $classe = $_POST['nClasse'];
    $tipoMaterial = $_POST['nTipo'];
    $fornecedor = $_POST['nFornecedor'];
    $quantidade = $_POST['nQuandtidade'];

    if($_POST['nObservacoes'] == ""){
        $observacoes = " ";
    }

    $observacoes = $_POST['nObservacoes']; 

    if($validacao == 'IM'){        
        
        $sql = validaMateriaPrima($descricao,$tipoMaterial,$classe,$quantidade,$observações);
        
    }elseif($validacao == 'IP') {          

        $sql = "UPDATE categorias" 
                ." SET descricao = '".$descricao."'"
                ." WHERE idCategoria =".$id.";"; 

    }elseif($validacao == 'AF') {
        $sql= validaFornecedor($fornecedor);
    }

    $result = mysqli_query($conn,$sql);    
    mysqli_close($conn);  

    header('location: ../cadastroMaterial.php');
?>