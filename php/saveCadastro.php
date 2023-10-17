<?php   
    include('connection.php');
    include('function.php');

    $tipo = $_GET["tipo"];
    $r_pigmento = $_GET['nPigmento'];
    $descricao = $_POST['nDescricao'];
    $r_material = $_POST['nMateria'];        
    $classe = $_POST['nClasse'];
    $tipoMaterial = $_POST['nTipo'];
    $fornecedor = $_POST['nFornecedor'];
    $quantidade = $_POST['nQuandtidade'];
    $observacoes = $_POST['nObservacoes']; 
    
    var_dump($r_material);
    die();

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