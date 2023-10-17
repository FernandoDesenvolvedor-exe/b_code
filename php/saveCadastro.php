<?php   
    include('connection.php');
    include('function.php');

    $tipo = $_GET["tipo"];
    $descricao = $_POST['nDescricao'];
    $r_material = $_POST['nMateria'];
    $r_pigmento = $_POST['nPigmento'];
    $classe = $_POST['nClasse'];
    $tipoMaterial = $_POST['nTipo'];
    $fornecedor = $_POST['nFornecedor'];
    $quantidade = $_POST['nQuandtidade'];
    $observacoes = $_POST['nObservacoes'];    

    if($tipo == 'IM'){        
        
        $sql = validaMateriaPrima($descricao,$tipo,$classe,$quantidade,$observações);
        
    }elseif($tipo == 'IP') {          

        $sql = "UPDATE categorias" 
                ." SET descricao = '".$descricao."'"
                ." WHERE idCategoria =".$id.";"; 

    }elseif($tipo == 'AF') {
        $sql= validaFornecedor($fornecedor);
    }

    $result = mysqli_query($conn,$sql);
    
    mysqli_close($conn);  

    header('location: ../cadastroFornecedor.php');
?>