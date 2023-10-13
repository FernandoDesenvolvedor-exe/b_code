<?php   
    include('conexao.php');
    include('function.php');

    $tipo = $_GET["tipo"];
    $id = $_GET["id"];
    $descricao = $_POST['nCategoria'];

    if($tipo == 'I'){        
        
        $sql = validaBanco($descricao);
        
    }elseif($tipo == 'U') {          

        $sql = "UPDATE categorias" 
                ." SET descricao = '".$descricao."'"
                ." WHERE idCategoria =".$id.";"; 

    }elseif($tipo == 'D') {
        $sql= "DELETE FROM categorias"
                ." WHERE id=".$id."";
    }

    $result = mysqli_query($conn,$sql);
    
    mysqli_close($conn);  

    header('location: ../categoria.php');
?>