<?php
    function selectTipUsuario(){
        include('connection.php');
        $sqlMatutino = "select * from tipos_usuario;";

        $tiposUsu = "<select class='select2 form-control custom-select' style='width: 100%; height:100%;'>"
        ."<option>Select turma</option>";

        //Matutino
        $tiposUsu.="<optgroup label='Matutino'>";

        $result = mysqli_query($conn, $sqlMatutino);
        
        
        if(mysqli_num_rows($result)>0){
            
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $tiposUsu .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
        }else{

        }
        
        
        return $tiposUsu;

    }
    
?>