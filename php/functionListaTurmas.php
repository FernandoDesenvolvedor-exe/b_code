<?php 
/*
<option>Select</option>
    <optgroup label="Matutino">
        <option value="MT-1">mofas com a pomba na balaia</option>
    </optgroup>
    <optgroup label="Vespertino">
        <option value="VP-1">aaaai chaves</option>
    </optgroup>
    <optgroup label="Noite">
        <option value="NT-1">To indo ali</option>
    </optgroup>
*/
    function listaTurmas(){
        include('connection.php');
        $sqlMatutino = "select idTurma, nomeTurma from turmas where ativo=1 and turno='M';";
        $sqlVespertino = "select idTurma, nomeTurma from turmas where ativo=1 and turno='V';";
        $sqlNoturno = "select idTurma,nomeTurma from turmas where ativo=1 and turno='N';";
        $listaTurmas = "<option>Select</option>";

        //Matutino
        $listaTurmas.="<optgroup label='Matutino'>";

        $result = mysqli_query($conn, $sqlMatutino);
        mysqli_close($conn);
        
        if(mysqli_num_rows($result)>0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            
        }
        $listaTurmas .= "</optgroup>";
        
        //Vespertino
        $listaTurmas .= "<optgroup label='Vespertino'>";

        $result = mysqli_query($conn, $sqlVespertino);
        mysqli_close($conn);

        if(mysqli_num_rows($result)>0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>;";
            }
            
        }
        $listaTurmas .= "</optgroup>";

        //Noturno
        $listaTurmas .= "<optgroup label='Noturno'>";

        $result = mysqli_query($conn, $sqlNoturno);
        mysqli_close($conn);

        if(mysqli_num_rows($result)>0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>;";
            }
        }
        $listaTurmas .= "</optgroup>";

        return $listaTurmas;
    }
?>