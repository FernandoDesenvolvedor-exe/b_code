<?php 
function optionTipoFerramental(){

    include('connection.php');

    $select = "<option> Selecione uma opção </option>";

    $sql = "SELECT * FROM tipos_ferramental WHERE ativo = 1;";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if(mysqli_num_rows($result) > 0){
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);            
        }

        foreach($array as $campo){
            $select .= "<option value ='".$campo['idTiposFerramental']."'>".$campo['descricao']."</option>";
        }
    }

    return $select;
}

function optionMaquina(){

    include('connection.php');

    $select = "<option> Selecione uma opção </option>";

    $sql = "SELECT * FROM maquinas WHERE ativo = 1;";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if(mysqli_num_rows($result) > 0){
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);            
        }

        foreach($array as $campo){

            $select .= "<option value ='".$campo['idMaquina']."'>".$campo['descricao']."</option>";

        }
    }

    return $select;
}

function optionFerramental(){

    include('connection.php');

    $select = "<option> Selecione uma opção </option>";

    $sql = "SELECT * FROM `ferramental` WHERE ativo = 1;";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if(mysqli_num_rows($result) > 0){
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);            
        }

        foreach($array as $campo){
            $select .= "<option value ='".$campo['idFerramental']."'>".$campo['descricao']."</option>";
        }
    }

    return $select;
}

?>