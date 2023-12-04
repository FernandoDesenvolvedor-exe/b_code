<?php     

    function optionProdutos($idProduto){

        include('connection.php');

        if ($idProduto != 0){
    
            $select = "";
    
            $sql = "SELECT idProduto, descricao, peso FROM produtos WHERE ativo = 1 AND idProduto = ".$idProduto.";";
    
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
    
            if(mysqli_num_rows($result) > 0){
                $array = array();
    
                while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
    
                foreach($array as $campo){
                    $select .= "<option value =".$campo['idProduto']."> ".$campo['descricao']." - ".$campo['peso']."g </option>";
                }
            }            
        } else if ($idProduto != 0){

            $select = "<option value=''> Selecione uma opção </option>";
    
            $sql = "SELECT idProduto, descricao FROM produtos WHERE ativo = 1;";
    
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
    
            if(mysqli_num_rows($result) > 0){
                $array = array();
    
                while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }
    
                foreach($array as $campo){
                    $select .= "<option value =".$campo['idProduto']."> ".$campo['descricao']." </option>";
                }
            }


        }

        return $select;
    }

    function dataTableProduto(){

        include('connection.php');

        $sql = "SELECT p.idProduto as idP, "
                ." p.descricao as produto, " 
                ." p.peso as peso,"
                ." p.imagem as img,"
                ." f.descricao as molde,"
                ." f.idFerramental as idMolde," 
                ." t.idTiposFerramental as idTipo," 
                ." t.descricao as tipo"
                ." FROM ferramental as f" 
                ." INNER JOIN produtos as p"
                ." ON p.idProduto = f.idProduto"
                ." LEFT JOIN tipos_ferramental as t"
                ." ON t.idTiposFerramental = f.idTiposFerramental" 
                ." where p.ativo = 1;";

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
                        "<tr align-items='center';>"
                            ."<td>".$campo['produto']."</td>"
                            ."<td>".$campo['peso']."g</td>"
                            ."<td>".$campo['molde']."</td>"
                            ."<td>".$campo['tipo']."</td>"
                            ."<td>"                            
                                ."<button type='button' class='btn btn-info margin-5' data-toggle='modal' data-target='#EditaModal".$campo['idP']."'>"
                                    ."Alterar"
                                ."</button>"

                                ."<button type='button' class='btn btn-danger margin-5' data-toggle='modal' data-target='#ExcluiModal".$campo['idP']."'>"
                                    ."Desativar"
                                ."</button>"                               
                            ."</td>"

                            ."<div class='modal fade' id='ExcluiModal".$campo['idP']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                            .'<form method="POST" action="php/saveProdutos.php? validacao=DPF&idProduto='.$campo["idP"].'">'
                                                .'<label> Confirmar esta ação? </label>'
                                                .'<div align-items="right">'
                                                    .'<button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                                .'</div>'
                                            .'</form>'
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'


                            ."<div class='modal fade' id='EditaModal".$campo['idP']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog modal-lg' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Alterar produto e/ou molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                            .'<form method="POST" class="form-horizontal"  enctype="multipart/form-data" action= "php/saveProdutos.php?validacao=UPF&idProduto='.$campo['idP'].'&idFerramental='.$campo['idMolde'].'">'
                                                .'<div class="card-body">'
                                                    
                                                    .'<h4 class="card-title">Produto e molde</h4>'

                                                    .'<div class="form-group row">'
                                                        .'<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do produto</label>'
                                                        .'<div class="col-sm-9">'
                                                            .'<input type="text" class="form-control" id="iProduto" name= "nProduto" placeholder="Nome do material">'
                                                        .'</div>'
                                                    .'</div> '

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Imagem do produto</label>'
                                                        .'<div class="col-md-9">'
                                                            .'<input type="file" class="form-control" id="iImagem" name="nImagem" accept="image/*">'
                                                        .'</div>'
                                                    .'</div>'

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Descrição do ferramental</label>'
                                                        .'<div class="col-sm-9">'
                                                            .'<input type="text" class="form-control" id="iMolde" name= "nMolde" placeholder="Nome do material">'
                                                        .'</div>'
                                                    .'</div>'

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Peso</label>'
                                                        .'<div class="col-sm-9">'
                                                            .'<input type="number" class="form-control" id="iQtd" name= "nQtd" placeholder="Peso do material em gramas + peso do canal">'
                                                        .'</div>'
                                                    .'</div>'

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Tipo de ferramental</label>'
                                                        .'<div class="col-md-9">'
                                                            .'<select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                                                                .''.optionTipoFerramental().''                                         
                                                            .'</select>'
                                                        .'</div>'
                                                    .'</div>' 
                                                .'</div>    '

                                                .'<div class="border-top">'
                                                    .'<div class="card-body">'
                                                        .'<button type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">Salvar</button>'
                                                    .'</div>'
                                                .'</div>'
                                            .'</form>'
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'


                        ."</tr>";      

            }
        }        

        return $table;
    }
    function cardProduto(){       

        include('connection.php');

        $card = "";    

        $sql = 'SELECT * FROM produtos WHERE ativo = 1;';
                    
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            
            $card='';
            foreach($array as $campo){

                $card .='   <div class="w-25 p-3" height="100px">
                                <div class="card">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1">                                          
                                            <img src="'.$campo['imagem'].'" alt="user" />
                                            <div class="el-overlay">
                                                <ul class="list-style-none el-info">
                                                    <li class="el-item">
                                                        <a class="btn default btn-outline image-popup-vertical-fit el-link" href="'.$campo['imagem'].'">
                                                            <i class="mdi mdi-magnify-plus">
                                                            </i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="el-card-content">
                                            <form method="POST" action="receitas.php?idProduto='.$campo['idProduto'].'&pr='.$campo['descricao'].'">
                                                <h4 id="idProduto" name="nProduto" class="m-b-0">'.$campo['descricao'].'</h4> <span class="text-muted"></span>
                                                <button style="width: auto; border-radius: 5px;" type="submit" class="btn btn-info margin-5">
                                                    Selecionar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }   
        }  

        return $card;
    }
?>