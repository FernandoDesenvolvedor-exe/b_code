<?php 
    function validaMateriaPrima($descricao,$tipo,$classe,$quantidade,$observações){

        include('connection.php');

        $sql= "SELECT * FROM materia_prima;";

        if($observações == ""){
            $observacoes = 'null';
        }

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

                
                if($id == 0){
                    if($id == mysqli_num_rows($result)){
                        if($observacoes == 'null'){
                            $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, observacoes)" 
                                ." VALUES(".$classe.",".$tipo.",'".$descricao."',".$quantidade.",null);"; 
                                var_dump($tipo);                           
                            break;
    
                        }else{
                            $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, observacoes)" 
                                ." VALUES(".$classe.",".$tipo.",'".$descricao."',".$quantidade.",".$observacoes.")"; 
                            break;
    
                        }
                    } 
                }else{
                    if($id == mysqli_num_rows($result)){
                        if($observacoes == 'null'){
                            $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, observacoes)" 
                                ." VALUES(".$classe.",".$tipo.",'".$descricao."',".$quantidade.",null);"; 
                                var_dump($tipo);                           
                            break;

                        }else{
                            $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, observacoes)" 
                                ." VALUES(".$classe.",".$tipo.",'".$descricao."',".$quantidade.",".$observacoes.")"; 
                            break;

                        }
                    }
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