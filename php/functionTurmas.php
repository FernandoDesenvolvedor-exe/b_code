<?php 
    function optionTurmas(){
        include('connection.php');
        $sqlMatutino = "select idTurma, nomeTurma from turma where ativo='S' and turno='M';";
        $sqlVespertino = "select idTurma, nomeTurma from turma where ativo='S' and turno='V';";
        $sqlNoturno = "select idTurma,nomeTurma from turma where ativo='S' and turno='N';";
        $listaTurmas = "<option value=null>Select turma</option>";
        //Matutino
        $result = mysqli_query($conn, $sqlMatutino);
        if(mysqli_num_rows($result)>0){
            $listaTurmas.="<optgroup label='Matutino'>";
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            $listaTurmas .= "</optgroup>";
        }
        //Vespertino
        $result = mysqli_query($conn, $sqlVespertino);
        if(mysqli_num_rows($result)>0){
            $listaTurmas .= "<optgroup label='Vespertino'>";
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            $listaTurmas .= "</optgroup>";
        }
        //Noturno
        $result = mysqli_query($conn, $sqlNoturno);
        if(mysqli_num_rows($result)>0){
            $listaTurmas .= "<optgroup label='Noturno'>";
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            $listaTurmas .= "</optgroup>";
        }
        mysqli_close($conn);
        return $listaTurmas;
    }
?>