<?php 

function dataTablePedido(){

    include('connection.php');

    $sql = 'SELECT ped.idPedido as pedidoId,
                ped.idUsuario as userId,   
                ped.idReceita as receitaId, 
                ped.idMaquina as maquinaId,
                ped.dataHora_aberto as openDateTime,
                ped.dataHora_fechado as closeDateTime,     
                ped.status as stats,         
                ped.observacoes as obs,       
                ped.quantidade as qtdR,    

                usu.idTurma as turmaId,    
                usu.nome as name,                        
                usu.sobrenome as sobName,    

                tur.nomeTurma as turma,  
                tur.turno as turno, 

                maq.descricao as maquina,

                rec.idProduto as produtoId,
                rec.idMateriaPrima as maquinaId,            
                rec.idPigmento as pigmentoId,
                rec.quantidadeMaterial as qtdMat,
                rec.quantidadePigmento as qtdPig,

                mat.idClasse as classeId,                    
                mat.idTipoMateriaPrima as tipoMatId,    
                mat.descricao as material,   

                tmat.descricao as tipoMat,
                cmat.descricao as classeMat, 

                forM.descricao as fornecedorM,     

                forP.descricao as fornecedorP,

                pig.descricao as cor,          
                pig.idTipoPigmento as tipoCorId,
                pig.descricao as cor,                      
                pig.codigo as codCor,      
                pig.lote as loteCor,     

                tpig.descricao as tipoCor,  

                pro.descricao as produto,
                pro.peso as pesoPro,                    
                pro.imagem as img,      

                fer.descricao as molde,                      
                fer.idTiposFerramental as tipoMoldeId,

                tfer.descricao as tipoMolde             
            
                FROM pedidos as ped
                LEFT JOIN usuarios as usu
                ON ped.idUsuario = usu.idUsuario
                
                LEFT JOIN turma as tur
                ON usu.idTurma = tur.idTurma

                LEFT JOIN maquinas as maq
                ON ped.idMaquina = maq.idMaquina

                LEFT JOIN receitas as rec
                ON ped.idReceita = rec.idReceita

                LEFT JOIN produtos as pro
                ON rec.idProduto = pro.idProduto

                LEFT JOIN ferramental as fer
                ON pro.idProduto = fer.idProduto

                LEFT JOIN tipos_ferramental as tfer
                ON fer.idTiposFerramental = tfer.idTiposFerramental

                LEFT JOIN materia_prima as mat
                ON rec.idMateriaPrima = mat.idMateriaPrima

                LEFT JOIN tipo_materia_prima as tmat
                ON mat.idTipoMateriaPrima = tmat.idTipoMateriaPrima

                LEFT JOIN classe_material as cmat
                ON mat.idClasse = cmat.idClasse

                LEFT JOIN materia_fornecedor as format
                ON mat.idMateriaPrima = format.idMateriaPrima

                LEFT JOIN fornecedores as forM
                ON format.idFornecedor = forM.idFornecedor

                LEFT JOIN pigmentos as pig
                ON rec.idPigmento = pig.idPigmento

                LEFT JOIN tipo_pigmentos as tpig
                ON pig.idTipoPigmento = tpig.idTipoPigmento

                LEFT JOIN pigmento_fornecedor as forpig
                ON pig.idPigmento = forpig.idPigmento

                LEFT JOIN fornecedores as forP
                ON forP.idFornecedor = forpig.idFornecedor          

                WHERE ped.ativo = 1;';
            

    $table = "";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        foreach($array as $campo){

            $dataAberto =  substr($campo['openDateTime'], 0, 10);
            $horaAberto = substr($campo['openDateTime'], 11, 8);
            
            $dataFechado =  substr($campo['closeDateTime'], 0, 10);
            $horaFechado = substr($campo['closeDateTime'], 11, 8);

            $table .=   
                    '<tr align-items="center";>'
                        .'<td>'.$campo['pedidoId'].'</td>'
                        .'<td>'.$campo['produto'].'</td>'
                        .'<td>'.$campo['material'].'</td>'
                        .'<td>'.$campo['cor'].'</td>'
                        .'<td>'.$dataAberto.'</td>';
            
            if ($campo['stats'] == 1){
                
                $table .=
                        '<td>                                                                       
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                Em aberto
                            </button>
                        </td>'
                        .'<td>Não fechado</td>';

            } else if ($campo['stats'] == 2) {

                $table .=
                        '<td>                                                                       
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                Em Produção
                            </button>
                        </td>'
                        .'<td>Não fechado</td>';

            } else if ($campo['stats'] == 3) {

                $table .=
                        '<td>Concluido</td>'
                        .'<td>'.$dataFechado.'</td>';

            } else if ($campo['stats'] == 0) {

                $table .=
                        '<td>Cancelado</td>'
                        .'<td>Não fechado</td>';

            }

            $table .=
                        '<td>
                            <div class="divButtons">
                                <div class="div1">                                                                         
                                    <button style="width: auto; border-radius: 5px;" type="button;" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$campo['pedidoId'].'">
                                        Visualizar
                                    </button>
                                </div>
                                <div class="div2">
                                    <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$campo['pedidoId'].'">
                                        Desativar
                                    </button>
                                </div>
                            <div>
                        </td>'

                        // MODAL DESATIVA MATERIA_PRIMA
                        ."<div class='modal fade' id='modalExclui".$campo['pedidoId']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                            ."<div class='modal-dialog' role='document '>"
                                ."<div class='modal-content'>"
                                    .'<div class="modal-header">'
                                        .'<h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>'
                                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                            .'<span aria-hidden="true ">&times;</span>'
                                        .'</button>'
                                    .'</div>'                                  
                                    .'<div class="modal-body">'
                                        .'<form method="POST" action="php/savePedidos.php? validacao=D&id='.$campo["pedidoId"].'">'
                                            .'<label> Confirmar esta ação? </label>'
                                            .'<div align-items="right">'
                                                .'<button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                            .'</div>'
                                        .'</form>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'
                        .'</div>' 

                        // MODAL DESATIVA MATERIA_PRIMA
                        .'<div class="modal fade" id="modalAltera'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="php/savePedidos.php? validacao=A&id='.$campo["pedidoId"].'&stats='.$campo['stats'].'">
                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>' 

                        //MODAL SELECIONA PEDIDO
                        .'<div class="modal fade" id="modalPedido'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                        .'    <div class="modal-dialog" role="document ">                                '
                        .'        <div class="modal-content">'
                        .'            <div class="modal-header">'
                        .'                <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>'
                        .'                <button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                        .'                    <span aria-hidden="true ">&times;</span>'
                        .'                </button>'
                        .'            </div>'
                        .'            <div class="modal-body">'
                        .'                <div>'
                        .'                    <h4>Autor da ordem de produção</h4>'
                            .'                <div class="input-group mb-3">'
                            .'                     <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Autor</label>'
                            .'                     <div class="col-sm-9">'
                            .'                          <input value="'.$campo['name'].' '.$campo['sobName'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                     </div>'
                            .'                </div>'
                            .''
                            .'                <div class="input-group mb-3">'
                            .'                     <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">turma</label>'
                            .'                     <div class="col-sm-9">'
                            .'                         <input value="'.$campo['turma'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                     </div>'
                            .'                </div>'
                            .'            </div>'
                            .'            <div>'
                            .''
                            .'                <h4>Produto</h4>'
                            .'                <div class="input-group mb-3">'
                            .'                     <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produto</label>'
                            .'                     <div class="col-sm-9">'
                            .'                          <input value="'.$campo['produto'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                     </div>'
                            .'                </div>'
                            .''
                            .'                <div class="input-group mb-3">'
                            .'                     <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Peso do Produto</label>'
                            .'                     <div class="col-sm-9">'
                            .'                          <input value="'.$campo['pesoPro'].'g" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                     </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">quantidade de produtos</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['qtdR'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Ferramental</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['molde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de Ferramental</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['tipoMolde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div>'
                            .'                    <div class="form-group row">'
                            .'                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Máquina</label>'
                            .'                        <div class="col-sm-9">'
                            .'                            <input value="'.$campo['maquina'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                        </div>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'           </div>'
                            .'           <div syle="display:grid;">'
                            .''
                            .'                <h4>Matéria Prima Usada</h4>'
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Matéria Prima</label>'
                            .'                    <div class="col-sm-9">'
                            .'                          <input value="'.$campo['material'].'" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'                        
                            .'                    </div>'
                            .'                </div>'                         
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantidade Usada</label>'
                            .'                    <div class="col-sm-9">'
                            .'                          <input value="'.($campo['qtdMat'] * $campo['qtdR']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'                        
                            .'                    </div>'
                            .'                </div>'                        
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de material</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['tipoMat'].'" id="idMaterial" name="nMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Classe do Material</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['classeMat'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['fornecedorM'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'            </div>'
                            .'            <div>'
                            .''
                            .'                <h4>Pigmento Usado</h4>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Pigmento</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['cor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>' 
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Código</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['codCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>' 
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Lote</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['loteCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'                         
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantidade Usada</label>'
                            .'                    <div class="col-sm-9">'
                            .'                          <input value="'.($campo['qtdPig'] * $campo['qtdR']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'                        
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de Pigmento</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['tipoCor'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .''
                            .'                <div class="form-group row">'
                            .'                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>'
                            .'                    <div class="col-sm-9">'
                            .'                        <input value="'.$campo['fornecedorP'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>'
                            .'                    </div>'
                            .'                </div>'
                            .'            </div>'
                            .'            <div>
                                                <form method="POST" action="php/savePedidos.php? validacao=U&id='.$campo['pedidoId'].'">                     
                                                    <h4> Observações </h4>       
                                                    <textarea style="width:100%;" id="iObs" name="nObs">'.$campo['obs'].'</textarea>
                                                    <button type="submit">
                                                        Alterar observação
                                                    </button>
                                                </form>
                                           </div>' 
                        .'            </div>'
                        .'        </div>'
                        .'    </div>'
                        .'</div>'

                        
                    ."</tr>";

        }
    }        

    return $table;
}

?>