<?php 
function getIdFerramental($idProduto){
    include('connection.php');

    $sql = 'SELECT idFerramental as id FROM ferramental WHERE idProduto = '.$idProduto.'';

    $id = "";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0){
        $array = array();
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        foreach($array as $campo){            
            $id = $campo['id'];
        }
    }

    return $id;
}
function dataTableMaquina(){

    include('connection.php');

    $sql = "SELECT idMaquina, descricao FROM maquinas WHERE ativo = 1;";

    $table = "";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        $a = '';

        foreach($array as $campo){
            
            $table .=   
                    '<tr align-items="center";>'
                        .'<td>'.$campo['idMaquina'].'</td>'
                        .'<td>'.$campo['descricao'].'</td>'
                        .'<td>'                                                
                            .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAlteraMaquina'.$campo['idMaquina'].'">'
                                .'Alterar'
                            .'</button>'
                            .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalExcluiMaquina'.$campo['idMaquina'].'">'
                                .'Desativar'
                            .'</button>'
                            .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddRelacao'.$campo['idMaquina'].'">'
                                .'Moldes Compatíveis'
                            .'</button>'
                        .'</td>'

                        // MODAL DESATIVA MAQUINA
                        ."<div class='modal fade' id='modalExcluiMaquina".$campo['idMaquina']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                            .'<form method="POST" action="php/saveProdutos.php? validacao=DM&idMaquina='.$campo["idMaquina"].'">'
                                                .'<label> Confirmar esta ação? </label>'
                                                .'<div align-items="right">'
                                                    .'<button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                                .'</div>'
                                            .'</form>'
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'

                        //MODAL ADD RELAÇÃO ENTRE MAQUINA E MOLDE-->
                        .'<div class="modal fade" id="modalAddRelacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                            .'<div class="modal-dialog" role="document ">'
                                .'<div class="modal-content">'
                                    .'<div class="modal-header">'
                                        .'<h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>'
                                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                        .'  <span aria-hidden="true ">&times;</span>'
                                        .'</button>'
                                    .'</div>'
                                    .'<div class="modal-body">'
                                        .'<form method="POST" class="form-horizontal" action= "php/saveProdutos.php? validacao=IRMF">'
                                            .'<div class="card-body">'
                                                .'<h4 class="card-title">Compatibilidade maquina/molde</h4>'
                                                
                                                .'<div class="form-group row">'
                                                    .'<label class="col-md-3 m-t-15" style="text-align: right;">Máquina</label>'
                                                    .'<div class="col-md-9">'
                                                        .'<select id="iRMaquina" name="nRMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                                                            .''. optionMaquina(0).''                                         
                                                        .'</select>'
                                                    .'</div>'
                                                .'</div>'

                                                .'<div class="form-group row">'
                                                    .'<label class="col-md-3 m-t-15" style="text-align: right;">Ferramental</label>'
                                                    .'<div class="col-md-9">'
                                                        .'<select id="iRFerramental" name="nRFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                                                        .'    '. optionFerramental().'' 
                                                        .'</select>'
                                                    .'</div>'
                                                .'</div>'
                                            .'</div>'
                                            
                                            .'<div class="border-top">'

                                                .'<div class="card-body">'
                                                    .'<button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>'
                                                .'</div>'

                                            .'</div>'
                                        .'</form>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'
                        .'</div>'

                        .'<div class="modal fade" id="modalAlteraMaquina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                            .'<div class="modal-dialog" role="document ">'
                                .'<div class="modal-content">'
                                    .'<div class="modal-header">'
                                        .'<h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>'
                                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                            .'<span aria-hidden="true ">&times;</span>'
                                        .'</button>'
                                    .'</div>'
                                    .'<div class="modal-body">'
                                        .'<!-- Cria um formulário para registrar maquinas -->'
                                        .'<form method="POST" class="form-horizontal" action= "php/saveProdutos.php? validacao=UM&idMaquina='.$campo['idMaquina'].'">'
                                            .'<div class="card-body">'
                                                .'<!-- Titulo da div -->'
                                                .'<h4 class="card-title">Máquina</h4>'
                                                .'<div class="form-group row">'
                                                    .'<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome da máquina</label>'
                                                    .'<div class="col-sm-9">'
                                                        .'<input type="text" class="form-control" id="iMaquina" name= "nMaquina" placeholder="Ex: máquina">'
                                                    .'</div>'
                                                .'</div> '

                                                .'<div class="form-group row">'
                                                    .'<label class="col-md-3 m-t-15" style="text-align: right;">Observações</label>'
                                                    .'<div class="col-sm-9">'
                                                        .'<textarea class="form-control" id= "iMObservacoes" name="nMObservacoes" placeholder="Campo não obrigatório"></textarea>'
                                                    .'</div>'
                                                .'</div>'
                                            .'</div>'
                                            
                                            .'<div class="border-top">'

                                                .'<div class="card-body">'
                                                    .'<button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>'
                                                .'</div>'

                                            .'</div>'
                                        .'</form>'
                                    .'</div> '           
                                .'</div>'
                            .'</div>'
                        .'</div>'

                        
                    ."</tr>";

        }
    }        

    return $table;
}

function optionTipoFerramental(){

    include('connection.php');

    $select = "<option value=''> Selecione uma opção </option>";

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

function optionMaquina($caso){

    include('connection.php');

    if ($caso == '0'){

        $select ="<option value='' disabled> Selecione uma opção </option>";
    
        $sql = "SELECT * FROM maquinas WHERE ativo = 1;";
    
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    
        if(mysqli_num_rows($result) > 0){
            $array = array();
    
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }
    
            foreach($array as $campo){
    
                $select .= "<option value='".$campo['idMaquina']."'>".$campo['descricao']."</option>";
    
            }
        }

    } else {

        $select ="<option value=''> Selecione uma opção </option>";
    
        $sql = 'SELECT maq.idMaquina as id,
                    maq.descricao as maquina
                    FROM ferramental_maquina as fm
                    INNER JOIN maquinas as maq
                    ON maq.idMaquina = fm.idMaquina
                    WHERE ativo = 1
                    AND idFerramental = '.$caso.';';
    
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    
        if(mysqli_num_rows($result) > 0){
            $array = array();
    
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }
    
            foreach($array as $campo){
    
                $select .= "<option value='".$campo['id']."'>".$campo['maquina']."</option>";
    
            }
        }

    }

    return $select;
}

function optionFerramental(){

    include('connection.php');

    $select = "<option value=''> Selecione uma opção </option>";

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

function maquinaNome($id){

    if($id == ''){
        $id=0;
    }

    include('connection.php');

    $sql ='SELECT descricao FROM maquinas WHERE idMaquina = '.$id.';';

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    $maquina = '';

    if(mysqli_num_rows($result) > 0){
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array,$linha);
        }
        foreach($array as $campo){
            $maquina = $campo['descricao'];
        }
    }

    return $maquina;
}
?>