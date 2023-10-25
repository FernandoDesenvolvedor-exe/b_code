<?php 
    function optionProdutos(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";

        $sql = "SELECT idProduto, descricao FROM produtos WHERE ativo = 1;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQL_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                $select .= "<option value = '".$campo['idProduto']."'> ".$descricao." </option>";
            }
        }

        return $select;
    }
?>