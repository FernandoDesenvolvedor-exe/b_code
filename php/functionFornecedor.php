<?php

    function dataTableFornecedor(){

        include('connection.php');

        $sql = "SELECT * FROM fornecedores WHERE ativo = 1";

        $table = "";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if (mysqli_num_rows($result) > 0){

            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                
                $table .=   
                        '<tr align-items="center";>'
                            .'<td>'.$campo['descricao'].'</td>'
                            .'<td>'                                                
                                .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAlteraFornecedor'.$campo['idFornecedor'].'">'
                                    .'Alterar'
                                .'</button>'                            
                                .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExcluiFornecedor'.$campo['idFornecedor'].'">'
                                    .'Desativar'
                                .'</button>'
                            .'</td>'

                            // MODAL DESATIVA MATERIA_PRIMA
                            ."<div class='modal fade' id='modalExcluiFornecedor".$campo['idFornecedor']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                            .'<form method="POST" action="php/saveFornecedor.php? validacao=D&id='.$campo["idFornecedor"].'">'
                                                .'<label> Confirmar esta ação? </label>'
                                                .'<div align-items="right">'
                                                    .'<button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                                .'</div>'
                                            .'</form>'
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>' 

                            // MODAL NOVA MATÈRIA PRIMA -->
                            .'<div class="modal fade" id="modalAlteraFornecedor'.$campo['idFornecedor'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                            .'    <div class="modal-dialog" role="document ">'
                            .'        <div class="modal-content">'
                            .'            <div class="modal-header">'
                            .'                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>'
                            .'                <button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                            .'                    <span aria-hidden="true ">&times;</span>'
                            .'                </button>'
                            .'            </div>'
                            .'            <div class="modal-body">'
                            .''                                                        
                            .'                <form method="POST" class="form-horizontal" action= "php/saveFornecedor.php? validacao=U&id='.$campo['idFornecedor'].'">'
                            .'                    <div class="card-body">'
                            .''                        
                            .'                        <!-- Titulo da div -->'
                            .'                        <h4 class="card-title">Matéria Prima</h4>'
                            .'                        <div class="form-group row">'
                            .'                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do material</label>'
                            .'                            <div class="col-sm-9">'
                            .'                                <input type="text" class="form-control" id="iDescricao" name= "nDescricao" placeholder="Nome do Fornecedor"></input>'
                            .'                            </div>'
                            .'                        </div>'                        
                            .''                    
                            .'                    <div class="border-top">'
                            .'                        <div class="card-body">'
                            .'                            <button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>'
                            .'                        </div>'
                            .'                    </div>'
                            .'                </form>'
                            .''
                            .'            </div>'
                            .'        </div>'
                            .'    </div>'
                            .'</div>'
                            .''
                            
                        ."</tr>";

            }
        }        

        return $table;

    }

    function materiaFornecedor($idMateria){

        include('connection.php');

        $sql = 'SELECT f.descricao as descricao
                    FROM materia_prima mat
                    INNER JOIN materia_fornecedor mfor
                    ON mfor.idMateriaPrima = mat.idMateriaPrima
                    LEFT JOIN fornecedores f 
                    ON mfor.idFornecedor = f.idFornecedor
                    WHERE mat.idMateriaPrima = '.$idMateria.';';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $fornecedor = '';

        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                $fornecedor = $campo['descricao'];
            }
        }

        return $fornecedor;
    }

    function pigmentoFornecedor($idPigmento){

        include('connection.php');

        $sql = 'SELECT f.descricao as descricao
                    FROM pigmentos pig
                    INNER JOIN pigmento_fornecedor pfor
                    ON pig.idPigmento = pfor.idPigmento
                    LEFT JOIN fornecedores f 
                    ON pfor.idFornecedor = f.idFornecedor
                    WHERE pig.idPigmento = '.$idPigmento.';';

        $result=mysqli_query($conn,$sql);
        mysqli_close($conn);

        $fornecedor = '';

        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                $fornecedor = $campo['descricao'];
            }
        }

        return $fornecedor;
    }
?>