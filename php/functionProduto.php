<?php 
    function optionProdutos(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";

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
                ." where f.ativo = 1;";

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
                            ."<td>".$campo['peso']."</td>"
                            ."<td>".$campo['molde']."</td>"
                            ."<td>".$campo['tipo']."</td>"
                            ."<td text-align='center'>"
                                ."<button type='button' class='btn btn-info margin-5' data-toggle='modal' data-target='#EditaModal".$campo['idP']."'>"
                                    ."Alterar"
                                ."</button>"

                                ."<button type='button' class='btn btn-info margin-5' data-toggle='modal' data-target='#ExcluiModal".$campo['idP']."'>"
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
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Alterar produto e/ou molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                            .'<form method="POST" class="form-horizontal"  enctype="multipart/form-data" action= "php/saveProdutos.php?validacao=UPF">'
                                                .'<div class="card-body">'
                                                    
                                                    .'<h4 class="card-title">Produto e molde</h4>'

                                                    .'<div class="form-group row">'
                                                        .'<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do produto</label>'
                                                        .'<div class="col-sm-9">'
                                                            .'<input type="text" value="'.$campo["produto"].'" class="form-control" id="iProduto" name= "nProduto" placeholder="Nome do material">'
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
                                                            .'<input type="text" value="'.$campo['molde'].'" class="form-control" id="iMolde" name= "nMolde" placeholder="Nome do material">'
                                                        .'</div>'
                                                    .'</div>'

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Peso</label>'
                                                        .'<div class="col-sm-9">'
                                                            .'<input type="number" value="'.$campo['peso'].'" class="form-control" id="iQtd" name= "nQtd" placeholder="Peso do material em gramas + peso do canal">'
                                                        .'</div>'
                                                    .'</div>'

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Tipo de ferramental</label>'
                                                        .'<div class="col-md-9">'
                                                            .'<select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                                                                .'<option value="'.$campo["idTipo"].'">'.$campo["tipo"].'</option>'
                                                                .'<?php echo optionTipoFerramental(); ?>'                                         
                                                            .'</select>'
                                                        .'</div>'
                                                    .'</div>' 
                                                    
                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15"  style="text-align: right;">Maquinas Compatíveis</label>'
                                                        .'<div class="col-md-9">'
                                                            .'<select id="iMaquina[]" name="nMaquina[]" multiple = "multiple" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                                                                 .'<?php echo optionMaquina(); ?>'
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
                    
        $sql = "SELECT idProduto, descricao, imagem FROM produtos"
                ." WHERE ativo = 1;";
                    
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                
                $card = "<div class='col-lg-3 col-md-6'>"
                            ."<form method='POST' action='cadastroPedido.php? img=".$campo['imagem']."&produto=".$campo['descricao']."'>"
                                ."<div style='border-top-left-radius: 20px; border-top-right-radius: 20px' class='card'>"
                                    ."<div style='border-bottom-left-radius: 20px; border-bottom-right-radius: 20px' class='el-card-item'>"
                                        ."<div class='el-card-avatar el-overlay-1'> <img name='nImg' src='".$campo['imagem']."' alt='user'/>"
                                            ."<div class='el-overlay'>"
                                                ."<ul class='list-style-none el-info'>"
                                                    ."<li class='el-item'>"
                                                        ."<a class='btn default btn-outline' href='".$campo['imagem']."'>"
                                                        ."</a>"
                                                    ."</li>"
                                                    ."<li class='el-item'>"
                                                        ."<a class='btn default btn-outline el-link' href='javascript:void(0);'>"
                                                            ."<i class='mdi mdi-link'></i>"
                                                        ."</a>"
                                                    ."</li>"
                                                ."</ul>"
                                            ."</div>"
                                        ."</div>"
                                        ."<div class='el-card-content'>"
                                            ."<h4 value='".$campo['idProduto']."' id='idProduto' name='nProduto' class='m-b-0'>".$campo['descricao']."</h4> <span class='text-muted'></span>" 
                                            ."<button type='submit' value='Selecionar' class='btn btn-primary'> Selecionar </button>"
                                        ."</div>" 
                                    ."</div>"
                                ."</div>"
                            ."</form>"
                        ."</div>";
            }   

            
        }  
        
        return $card;
    }
?>