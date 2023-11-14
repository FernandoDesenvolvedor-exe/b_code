<?php 

function receitas($idReceita){

    include('connection.php');

    $receita='';

    $sql='SELECT * FROM receita_materia_prima WHERE idReceita='.$idReceita.';';

    $receita = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($receita) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($receita, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        $receitas = $array;
    }

    return $receitas;
}
function dataTablePedido(){

    include('connection.php');

    $sql = 'SELECT * FROM historico WHERE ativo = 1';

    $table = "";

    $result = mysqli_query($conn,$sql);

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

            $sql='SELECT idPedido FROM historico WHERE idHistorico = '.$campo['idHistorico'].';';

            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $materia = array();
                while($linha = mysqli_fetch_array($result,MYSQL_ASSOC)){
                    array_push($materia, $linha);
                }
            }

            if(count($arrayQtdMat) > 1){                      
                $n++;

                if ($n == 1){
                    $arrayMat['nome'] = array($campo['materialNome']);
                    $arrayMat['tipo'] = array($campo['tipo_materiaNome']);  
                    $arrayMat['classe'] = array($campo['classeMaterial']);
                    $arrayMat['quantidade'] = array($campo['qtdeMateria']); 
                } else {  
                    array_push($arrayMat['nome'], $campo['materialNome']);
                    array_push($arrayMat['tipo'], $campo['tipo_materiaNome']);  
                    array_push($arrayMat['classe'], $campo['classeMaterial']);
                    array_push($arrayMat['quantidade'], $campo['qtdeMateria']);   
                }
            
            }
            
            $table .=   
                    '<tr align-items="center";>
                        <td>'.$campo['pedidoId'].'</td>
                        <td>'.$campo['produto'].'</td>         
                        <td>'.$campo['cor'].'</td>
                        <td>'.$dataAberto.'</td>';
            
            if ($campo['stats'] == 1){
                
                $table .=
                        '<td>                                                                       
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                Em aberto
                            </button>
                        </td>
                        <td>Não fechado</td>';

            } else if ($campo['stats'] == 2) {

                $table .=
                        '<td>                                                                       
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                Em Produção
                            </button>
                        </td>
                        <td>Não fechado</td>';

            } else if ($campo['stats'] == 3) {

                $table .=
                        '<td>Concluido</td>
                        <td>'.$dataFechado.'</td>';

            } else if ($campo['stats'] == 0) {

                $table .=
                        '<td>Cancelado</td>
                        <td>Não fechado</td>';

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
                        </td>

                        <div class="modal fade" id="modalExclui'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>                       
                                    <div class="modal-body">
                                        <form method="POST" action="php/savePedidos.php? validacao=D&id='.$campo["pedidoId"].'">
                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalAltera'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        </div>

                        <div class="modal fade" id="modalPedido'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <h4>Autor da ordem de produção</h4>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Autor</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['name'].' '.$campo['sobName'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">turma</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['turma'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                            
                                            <h4>Produto</h4>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produto</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['produto'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                            
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Peso do Produto</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['pesoPro'].'g" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">quantidade de produtos</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['qtdeProduto'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Ferramental</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['molde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de Ferramental</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['tipoMolde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div>
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Máquina</label>
                                                    <div class="col-sm-9">
                                                        <input value="'.$campo['maquina'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                            </div>                            
                                        </div>

                                        <div syle="display:grid;">
                                            <h4>Matéria Prima Usada</h4>
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Matéria Prima</label>
                                                <div class="col-sm-9">
                                                        <input value="'.$campo['material'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>                   
                                                </div>
                                            </div>      
                    
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantidade Usada</label>
                                                <div class="col-sm-9">
                                                        <input value="'.($campo['qtdeMateria'] * $campo['qtdeProduto']).'g" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>

                            
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de material</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['tipoMat'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Classe do Material</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['classeMat'].'" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['fornecedorM'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                            
                                        </div>

                                        <div>                            
                                            <h4>Pigmento Usado</h4>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Pigmento</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['cor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Código</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['codCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Lote</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['loteCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                      
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantidade Usada</label>
                                                <div class="col-sm-9">
                                                        <input value="'.($campo['qtdePigmento'] * $campo['qtdeProduto']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['tipoCor'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['fornecedorP'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <form method="POST" action="php/savePedidos.php? validacao=U&id='.$campo['pedidoId'].'">                     
                                                <h4> Observações </h4>       
                                                <textarea style="width:100%;" id="iObs" name="nObs">'.$campo['obs'].'</textarea>
                                                <button type="submit">
                                                    Alterar observação
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </tr>';
        }
    }        

    return $table;
}

?>