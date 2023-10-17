<?php 
    function validaMateriaPrima($descricao,$relacao,$classe,$tipo,$fornecedor,$quantidade,$observacoes){

        include('conexao.php');

        $sql= "SELECT * FROM materia_prima;";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){    
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }
            foreach($array as $campo){
                $id = $campo['idMateriaPrima'];
                $nome = $campo['descricao'];  
                
                if ($id == 0) {
                    $sql = "INSERT INTO categorias(idClasse,idTipoMateriaPrima,descricao,quantidade,observacoes)" 
                            ." VALUES(".$classe.",".$tipo.",".$descricao.",".$quantidade.",".$observacoes.")"
                            ." WHERE idMateriaPrima = ".$id.";";
                            
                    break;
                }            
            }
        }    
        
        return ($sql);
    }

    function validaFornecedor(){

        include('conexao.php');

        $sql= "SELECT * FROM materia_prima;";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){    
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }
            foreach($array as $campo){
                $id = $campo['idMateriaPrima'];
                $nome = $campo['descricao'];  
                
                if ($id == 0) {
                    $sql = "INSERT INTO categorias(idClasse,idTipoMateriaPrima,descricao,quantidade,observacoes)" 
                            ." VALUES(".$classe.",".$tipo.",".$descricao.",".$quantidade.",".$observacoes.")"
                            ." WHERE idMateriaPrima = ".$id.";";
                            
                    break;
                }            
            }
        }    
        
        return ($sql);
    }
?>