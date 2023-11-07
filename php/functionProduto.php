<?php 

    function dataTableReceitas($idProduto){

        include('connection.php');

        $sql = 'SELECT r.idReceita as idReceita,'
                    .' r.idProduto as idPr,'      //  RECEITA
                    .' r.idMateriaPrima as idMat,'
                    .' r.idPigmento as idCor,'
                    .' r.quantidadeMaterial as qtdeM,'
                    .' r.quantidadePigmento as qtdeP,'
                    .' r.observacoes as obs,'

                    .' pr.descricao as produto,'
                    .' pr.imagem as img,'           // PRODUTO/MOLDE
                    .' f.descricao as molde,'         

                    .' mat.descricao as material,'
                    .' tm.descricao as tipoM,'       // MATERIA PRIMA
                    .' c.descricao as classe,'

                    .' pg.descricao as cor,'          //PIGMENTO
                    .' tp.descricao as tipoP'

                    .' FROM receitas as r'
                    
                    .' LEFT JOIN produtos as pr'
                    .' ON r.idProduto = pr.idProduto'

                    .' RIGHT JOIN ferramental as f'
                    .' ON f.idProduto = pr.idProduto'

                    .' LEFT JOIN materia_prima as mat'
                    .' ON mat.idMateriaPrima = r.idMateriaPrima'
                    
                    .' RIGHT JOIN tipo_materia_prima as tm'
                    .' ON tm.idTipoMateriaPrima = mat.idTipoMateriaPrima'   
        
                    .' RIGHT JOIN classe_material as c'
                    .' ON c.idClasse = mat.idClasse' 

                    .' LEFT JOIN pigmentos as pg'
                    .' ON pg.idPigmento = r.idPigmento' 
        
                    .' RIGHT JOIN tipo_pigmentos as tp'
                    .' ON tp.idTipoPigmento = pg.idTipoPigmento' 

                    .' WHERE pr.ativo = 1'
                    .' AND r.idProduto =  '.$idProduto.';';

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
                            ."<td>".$campo['material']."g</td>"
                            ."<td>".$campo['cor']."</td>"
                            ."<td>"                                
                                ."<button type='button' class='btn btn-info margin-5' data-toggle='modal' data-target='#modalPedido".$campo['idReceita']."'>"
                                    ."Selecionar"
                                ."</button>"
                            ."</td>"
                            ."<td>"                                
                                ."<button type='button' class='btn btn-info margin-5' data-toggle='modal' data-target='#modalPedido".$campo['idReceita']."'>"
                                    ."alterar"
                                ."</button>"
                            ."</td>"         

                            ."<td>" 
                                ."<button type='button' class='btn btn-danger margin-5' data-toggle='modal' data-target='#ExcluiModal".$campo['idReceita']."'>"
                                    ."Desativar"
                                ."</button>"                               
                            ."</td>"

                            ."<div class='modal fade' id='ExcluiModal".$campo['idReceita']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                            .'<form method="POST" action="php/saveProdutos.php? validacao=DPF&idProduto='.$campo["idReceita"].'">'
                                                .'<label> Confirmar esta ação? </label>'
                                                .'<div align-items="right">'
                                                    .'<button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                                .'</div>'
                                            .'</form>'
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'
                        
                            .'<div class="modal fade" id="modalPedido'.$campo['idReceita'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                            .'    <div class="modal-dialog" role="document ">                                '
                            .'        <div class="modal-content">'
                            .'            <div class="modal-header">'
                            .'                <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>'
                            .'                <button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                            .'                    <span aria-hidden="true ">&times;</span>'
                            .'                </button>'
                            .'            </div>'
                            .'            <div class="modal-body">'
                            .''
                            .'                 <form method="POST" action="php/savePedido.php? validacao=I">'
                            .'                    <div class="input-group mb-3">'
                            .'                         <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produto</label>'
                            .'                         <div class="col-sm-9">'
                            .'                              <input value="'.$campo['produto'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                         </div>'
                            .'                    </div>'                        
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Ferramental</label>'
                            .'                        <div class="col-sm-9">'
                            .'                              <input value="'.$campo['molde'].'" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'                        
                            .'                        </div>'
                            .'                    </div>'                        
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Matéria Prima</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input value="'.$campo['material'].'" id="idMaterial" name="nMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                        </div>'
                            .'                    </div>'
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de Material</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input value="'.$campo['tipoM'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                        </div>'
                            .'                    </div>'
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Classe</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input value="'.$campo['classe'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                        </div>'
                            .'                    </div>'
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Pigmento</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input value="'.$campo['cor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                        </div>'
                            .'                    </div>'
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de Pigmento</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input value="'.$campo['tipoP'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                        </div>'
                            .'                    </div>'
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantidade de produção</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input id="idQtdeProduto" name="nQtdeProduto" value="50" type="number" min="50" class="form-control" style="width: 100%; height:36px;">'
                            .'                        </div>'
                            .'                    </div>'
                            .''
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Maquina</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                            .'                                  '.optionMaquina().''
                            .'                            </select>'
                            .'                        </div>'
                            .'                    </div>'    
                            .'                </form>'
                            .'            </div>'
                            .'        </div>'
                            .'    </div>'
                            .'</div>'



                        .'</tr>';

            }
        }        

        return $table;
    }

    function optionProdutos(){

        include('connection.php');

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
                                ."<div class='modal-dialog' role='document '>"
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

            foreach($array as $campo){
                
                $card .= 
                        "<div style='display=inline;' class='row el-element-overlay'> "
                            ."<div class='col-lg-3 col-md-6'>"
                                ."<div style='border-top-left-radius: 20px; border-top-right-radius: 20px' class='card'>"
                                    ."<div style='border-bottom-left-radius: 20px; border-bottom-right-radius: 20px' class='el-card-item'>"
                                        ."<div class='el-card-avatar el-overlay-1'>"                                            
                                            ."<img style='width: 400px; height: 200px;' name='nImg' src='".$campo['imagem']."' alt='user'/>"
                                        ."</div>"
                                        ."<div class='el-card-content'>"
                                        ."  <form method='POST' action='receitas.php? idProduto=".$campo['idProduto']."'>"
                                                ."<h4 id='idProduto' name='nProduto' class='m-b-0'>".$campo['descricao']."</h4> <span class='text-muted'></span>" 
                                                .'<button style="width: auto; border-radius: 5px;" type="submit" class="btn btn-info margin-5">'
                                                    .'Selecionar'
                                                .'</button>'
                                        .'  </form>'
                                        ."</div>" 
                                    ."</div>"
                                ."</div>"
                            ."</div>"
                        ."</div>";

            }   

            
        }  
        
        return $card;
    }
?>