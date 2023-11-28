<?php

    function dataTableHistorico(){

        include('connection.php');

        $sql = 'SELECT * FROM historico_pedidos
                    WHERE ativo = 1
                    ORDER BY idPedido DESC;';
                

        $table = "";

        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0){

            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }

            $n = 1;
            $idAnterior = 0;
            $idAtual = 0;

            foreach($array as $campo){                

                $idAtual = $campo['idPedido'];                
                
                if ($idAtual != $idAnterior){

                    $dataAberto =''.substr($campo['dataHora_aberto'], 8, 2).'/';
                    $dataAberto .=''.substr($campo['dataHora_aberto'], 5, 2).'/';
                    $dataAberto .=''.substr($campo['dataHora_aberto'], 0, 4).'';
                    $horaAberto = substr($campo['dataHora_aberto'], 11, 8);

                    $dataProducao =''.substr($campo['dataHora_producao'], 8, 2).'/';
                    $dataProducao .=''.substr($campo['dataHora_producao'], 5, 2).'/';
                    $dataProducao .=''.substr($campo['dataHora_producao'], 0, 4).'';
                    $horaProducao = substr($campo['dataHora_producao'], 11, 8);
                    
                    $dataFechado =''.substr($campo['dataHora_fechado'], 8, 2).'/';
                    $dataFechado .=''.substr($campo['dataHora_fechado'], 5, 2).'/';
                    $dataFechado .=''.substr($campo['dataHora_fechado'], 0, 4).'';
                    $horaFechado = substr($campo['dataHora_fechado'], 11, 8);

                    $table .=
                        '<tr align-items="center";>
                            <td>'.$campo['idPedido'].'</td>
                            <td>'.$campo['nomeUsuario'].'</td>
                            <td>'.$campo['produto'].'</td>
                            <td>'.maquinaNome($campo['maquina']).'</td>';
                    
                    if ($campo['statusPedido'] == 1){     

                        $table .='<td>
                                    Em aberto                              
                                </td>'; 

                    } else if ($campo['statusPedido'] == 2) {

                        $table .='<td>       
                                    Em Produção
                                </td>';

                    } else if ($campo['statusPedido'] == 3) {

                        $table .='<td>Concluido</td>';

                    } else if ($campo['statusPedido'] == 0) {

                        $table .='<td>Cancelado</td>';

                    }

                    $table .=
                        ''.materiais($campo['idPedido']).'
                        <td>
                            <div class="row">
                                <div class="col-sm-4">                                                                
                                    <button style="border:0; background-color:transparent"  type="button" data-toggle="modal" data-target="#modalPedido'.$campo['idPedido'].'">                                            
                                        <span class="fas fa-eye text-info mt-2" title="Visualizar pedido"> 
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button style="border:0; background-color:transparent" type="button" class="fas  fa-mdi-file-restore-success" data-toggle="modal" data-target="#modalRestaura'.$campo['idPedido'].'">
                                        <span class="fas fa-undo text-success mt-2" title="Restaurar pedido"> 
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button style="border:0; background-color:transparent" type="button" class="fa mdi-delete-danger" data-toggle="modal" data-target="#modalExclui'.$campo['idPedido'].'">
                                        <span class="mdi mdi-delete-forever fa-2x text-danger" title="Excluir pedido"> 
                                        </span>
                                    </button>
                                </div>
                            <div>
                        </td>                        
                        '.modalExcluiPedido($campo['idPedido']).'
                        '.modalRestauraPedido($campo['idPedido']).'    
                        
                        
                        <div class="modal fade" id="modalPedido'.$campo['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog modal-lg" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ordem de produção</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pre-scrollable">
                                        <div class="card">
                                            <h4>Autor da ordem de produção</h4>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Autor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['nomeUsuario'].'" id="iduser" name="nuser" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';
                                    
                    if($campo['tipoUsuario'] == 1){

                        $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Nivel de acesso:</label>
                                <div class="col-sm-8">
                                    <input value="Administrador" id="idAdmin" name="nAdmin" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

                    } else { 
                        $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['turma'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';
                    }

                    $table .=
                                            
                                        '</div>
                                        <div>
                                            <h4>Status da ordem de produção</h4>';

                    if ($campo['statusPedido'] == 1){

                        $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataAberto.' às '.$horaAberto.'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                <div class="col-sm-8">
                                    <input value="Pedido não foi inicializado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                <div class="col-sm-8">
                                    <input value="Pedido não foi inicializado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

                    } else if ($campo['statusPedido'] == 2){

                        $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                <div class="col-sm-8">
                                    <input value="Pedido em andamento" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

                    } else if ($campo['statusPedido'] == 3){

                        $datatime1 = new DateTime(''.substr($campo['dataHora_producao'], 0, 10).' '.substr($campo['dataHora_producao'], 11, 8).' America/Sao_Paulo');
                        $datatime2 = new DateTime(''.substr($campo['dataHora_fechado'], 0, 10).' '.substr($campo['dataHora_fechado'], 11, 8).' America/Sao_Paulo');

                        $data1  = $datatime1->format('Y-m-d H:i:s');
                        $data2  = $datatime2->format('Y-m-d H:i:s');

                        $diff = $datatime1->diff($datatime2);

                        $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Duração</label>
                                <div class="col-sm-8">
                                    <input value="'.$diff->format("%a dias e %H:%I:%S").' horas" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataFechado.' às '.$horaFechado.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

                    }

                    $table .=
                                        '   <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produto</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['produto'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';

                    if ($campo['statusPedido'] == 1 || $campo['statusPedido'] == 2){

                        $table .=
                            '<div class="form-group row">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção prevista</label>
                                <div class="col-sm-8">
                                    <input value='.$campo['producaoPrevista'].' id="idQtdPrev" name="nQtdPrev" type="number" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

                    }  else if ($campo['statusPedido'] == 3){

                        $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Prevista:</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['producaoPrevista'].'" id="idQtdPrev" name="nQtdPrev" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>

                            <div class="input-group mb-3">                                        
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Real:</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['producaoRealizada'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>

                            <div class="input-group mb-3">                                    
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Refugos:</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['refugo'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Total:</label>
                                <div class="col-sm-8">
                                    <input value="'.($campo['producaoRealizada'] - $campo['refugo']).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

                    }                                
                                            

                    $table .=
                                            '<div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Ferramental</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['ferramental'].'" id="idFerramental" name="nFerramental" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Ferramental</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoFerramental'].'" id="idTipoFerramental" name="nTipoFerramental" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div>
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Máquina</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['maquina'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                            </div>                            
                                        </div>

                                        <div syle="card-body">
                                            <h4>Matéria Prima Usada</h4>
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Matéria Prima</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['materiaPrima'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>                   
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                <div class="col-sm-8">
                                                        <input value="'.($campo['quantidadeMateria_prima'] * $campo['producaoPrevista']).'g" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>

                            
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de material</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoMateria_prima'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Classe do Material</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['classeMateria_prima'].'" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['fornecedorMateria_prima'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                            
                                        </div>

                                        <div>                            
                                            <h4>Pigmento Usado</h4>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Pigmento</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['pigmento'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoPigmento'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>                                                
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Código</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['codigo'].'" id="idCodCor" name="nCodCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>                                                
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Lote</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['lote'].'" id="idLoteCor" name="nLoteCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                      
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                <div class="col-sm-8">
                                                        <input value="'.($campo['quantidadePigmento'] * $campo['producaoPrevista']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['fornecedorPigmento'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                                                
                                        </div>

                                        <div>
                                            <form method="POST" action="php/savePedidos.php? validacao=U&id='.$campo['idPedido'].'">                     
                                                <h4> Observações </h4>       
                                                <textarea style="width:100%;" id="iObs" name="nObs">'.$campo['obsPedido'].'</textarea>
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

                    $n++;

                    $idAnterior = $idAtual;
                
                }
            }
        }        

        return $table;
    }

?>