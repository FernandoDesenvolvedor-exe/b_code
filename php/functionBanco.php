<?php 

    function buscaId ($tableName, $idName){

        include('connection.php');

        $sql = "SELECT ".$idName." FROM ".$tableName.";";
        $id = '';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
        
        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                $id = $campo['idMateriaPrima'];
            }
        }

        return ($id);
    }
?>