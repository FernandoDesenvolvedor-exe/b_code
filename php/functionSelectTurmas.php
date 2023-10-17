<?php 
    function selectTurmas(){
        include('connection.php');
        $sqlMatutino = "select idTurma, nomeTurma from turma where ativo='S' and turno='M';";
        $sqlVespertino = "select idTurma, nomeTurma from turma where ativo='S' and turno='V';";
        $sqlNoturno = "select idTurma,nomeTurma from turma where ativo='S' and turno='N';";

        $listaTurmas = "<select class='select2 form-control custom-select' style='width: 100%; height:100%;'>"
        ."<option>Select turma</option>";

        //Matutino
        $listaTurmas.="<optgroup label='Matutino'>";

        $result = mysqli_query($conn, $sqlMatutino);
        
        
        if(mysqli_num_rows($result)>0){
            
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            
        }else{
            $listaTurmas .="<option value='0'>Sem turmas</option>";
        }
        $listaTurmas .= "</optgroup>";
        
        //Vespertino
        $listaTurmas .= "<optgroup label='Vespertino'>";

        $result = mysqli_query($conn, $sqlVespertino);
        

        if(mysqli_num_rows($result)>0){
            
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            
        }else{
            $listaTurmas .="<option value='0'>Sem turmas</option>";
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
                $listaTurmas .= "<option value='".$campo['idTurma']."'>".$campo['nomeTurma']."</option>";
            }
            
        }else{
            $listaTurmas .="<option value='0'>Sem turmas</option>";
        }
        $listaTurmas .= "</optgroup></select>";
        return $listaTurmas;
    }
?>