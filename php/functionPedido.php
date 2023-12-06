<?php 
function selectHistoricoPedidos($id){
    $sql = 'SELECT * FROM historico_pedidos WHERE idPedido = '.$id.' GROUP BY idPedido;';

    include('connection.php');

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    $array = array();

    if(mysqli_num_rows($result) > 0){
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);
        }
    } else {

        $array = 0;
    }
    
    return $array;
}

function nomeStatus($stats){
    $status = '';
    
    if($stats = 0){
        $status = 'Em Aberto';        
    } else if($stats = 1){
        $status = 'Em Aberto';        
    } else if($stats = 2){
        $status = 'Em Andamento';        
    } else if($stats = 3){
        $status = 'Concluido';        
    }

    return $status;
}

function receitas($id){

    include('connection.php');

    $receita='';

    $sql='SELECT * FROM receita_materia_prima WHERE idReceita='.$id.';';

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

    $sql = 'SELECT * FROM historico_pedidos
                WHERE statusPedido <> 0
                GROUP BY idPedido
                ORDER BY idPedido ASC;';
            

    $table = "";

    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        foreach($array as $campo){

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
                        <td>'.$campo['produto'].'</td> 
                        <td>'.materiaisPedido($campo['idPedido'],2).'</td>         
                        <td>'.$campo['pigmento'].'</td>
                        <td>'.$dataAberto.' às '.$horaAberto.'</td>';
    
            if ($campo['statusPedido'] == 1){
                
                $table .=
                        '<td>                            
                        <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalInicio'.$campo['idPedido'].'">
                                Em aberto
                            </button>                                
                        </td>'; 

            } else if ($campo['statusPedido'] == 2) {

                $table .=
                        '<td>                                                                       
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['idPedido'].'">
                                Em Produção
                            </button>
                        </td>';

            } else if ($campo['statusPedido'] == 3) {

                $table .=
                        '<td>Concluido</td>';

            } else if ($campo['statusPedido'] == 0) {

                $table .=
                        '<td>Cancelado</td>';

            }            
                                

            $table .=
                        '<td>
                            <div class="d-flex row-flex">
                                <div class="col-sm-4">
                                    <a href="#" class="fas fa-eye text-info" align="center" data-toggle="modal" data-target="#modalPedido'.$campo['idPedido'].'" title="Visualizar Pedido"></a>
                                </div>';

            if($campo['statusPedido'] == 2){

            $table .=           '<div class="col-sm-4">
                                    <a href="#" class="fas fa-plus-circle text-success" align="center" data-toggle="modal" data-target="#modalReciclagem'.$campo['idPedido'].'" title="Adicionar Material Reciclado"></a>
                                </div>';
            }

                $table .= 
                                '<div class="col-sm-4">
                                    <a href="#" class="fas fa-times-circle text-danger" align="center" data-toggle="modal" data-target="#modalExclui'.$campo['idPedido'].'" title="Excluir Pedido"></a>
                                </div>
                            <div>
                        </td>



                        <div class="modal fade" id="modalReciclagem'.$campo['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Materiais Reciclados</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>                       
                                    <div class="modal-body">

                                        <form method="POST" action="php/savePedidos.php?validacao=UR&idPedido='.$campo['idPedido'].'">                                              
                                            <div> 
                                                <h6>Adicionar Material reciclado deste pedido</h6>                                 
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input id="iqtdReciclado" name="nqtdReciclado" type="number" min="0" class="form-control" style="width: 100%; height:36px;">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-6 text-right control-label col-form-label">Material reciclado adicionado:</label>
                                                    <div class="col-sm-6">
                                                        <input value="'.$campo['quantidadeReciclado'].'" id="iquantidadeR" name="nquantidadeR" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>      

                                                <div align="right">
                                                    <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                                </div>                                             
                                            </div>                                            
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalExclui'.$campo['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>                       
                                    <div class="modal-body">
                                        <form method="POST" action="php/savePedidos.php? validacao=D&id='.$campo["idPedido"].'">
                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalInicio'.$campo['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Iniciar produção?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="php/savePedidos? validacao=A&id='.$campo["idPedido"].'&stats='.$campo['statusPedido'].'">
                                            <div>                                     
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Máquina as ser produzida:</label>
                                                    <div class="col-sm-7">                                                            
                                                        <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                            '.optionMaquina($campo['idFerramental']).'
                                                        </select>
                                                    </div>
                                                </div>                                                    
                                            </div>

                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalAltera'.$campo['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Encerrar produção</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="php/savePedidos.php? validacao=A&id='.$campo["idPedido"].'&stats='.$campo['statusPedido'].'">
                                            <div>                                
                                                <h4>Finalizando produção</h4>
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Quantidade de refugos</label>
                                                    <div class="col-sm-4">
                                                        <input id="idRefugo" name="nRefugo" type="number" class="form-control" style="width: 100%; height:36px;">
                                                    </div>
                                                </div>
                                
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Produção real</label>
                                                    <div class="col-sm-4">
                                                        <input id="idReal" name="nReal" type="text" class="form-control" style="width: 100%; height:36px;">
                                                    </div>
                                                </div>                                                    
                                            </div>

                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        <div>
                                            <h4>Autor da ordem de produção</h4>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Autor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['nomeUsuario'].'" id="idNomeUsuario" name="nNomeUsuario" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';
                                    
            if($campo['tipoUsuario'] == 1){
                
                $table .=
                                            '<div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                                <div class="col-sm-8">
                                                    <input value="Administrador" id="idTurma" name="nTurma" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';

            } else { 
                $table .=
                                            '<div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['turma'].' '.$campo['turno'].'" id="idTurma" name="nTurma" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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
                                                    <input value="'.$dataAberto.' às '.$horaAberto.'" id="idhoraAberto" name="nhoraAberto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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

                $datatime1 = new DateTime(''.substr($campo['producaoData_hora'], 0, 10).' '.substr($campo['abertoData_hora'], 11, 8).' America/Sao_Paulo');
                $datatime2 = new DateTime(''.substr($campo['fechadoData_hora'], 0, 10).' '.substr($campo['fechadoData_hora'], 11, 8).' America/Sao_Paulo');

                $data1  = $datatime1->format('Y-m-d H:i:s');
                $data2  = $datatime2->format('Y-m-d H:i:s');

                $diff = $datatime1->diff($datatime2);

                $table .=
                                            '<div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Duração</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$diff->format("%a dias e %H:%I:%S").' horas" id="iddiff" name="ndiff" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$dataAberto.' às '.$horaAberto.'" id="idhoraAberto" name="nhoraAberto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$dataProducao.' às '.$horaProducao.'" id="idhoraProducao" name="nhoraProducao" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$dataFechado.' às '.$horaFechado.'" id="idhoraFechado" name="nhoraFechado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';

            }

            $table .=
                                            '<div class="input-group mb-3">
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

            } else if ($campo['statusPedido'] == 3){

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
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Material reciclado:</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['quantidadeReciclado'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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
                                                    <input value="'.$campo['ferramental'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Ferramental</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoFerramental'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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
                                        <div>
                                            '.materiaisPedido($campo['idPedido'],1).'
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
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Código</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['codigo'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Lote</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['lote'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                      
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                <div class="col-sm-8">
                                                        <input value="'.$campo['quantidadePigmento'].'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoPigmento'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['fornecedorPigmento'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                            <div>   
                                                <form method="POST" action="php/savePedidos.php?validacao=U&id='.$campo['idPedido'].'">              
                                                    <h4> Observações </h4>
                                                    <div class="form-group row">
                                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="iObs" name="nObs" placeholder="Campo não obrigatório">'.$campo['obsPedido'].'</textarea>
                                                        </div>
                                                    </div>  

                                                    <button type="submit" class="btn btn-primary">
                                                        Alterar observação
                                                    </button>
                                                </form>
                                            </div>                                                
                                        </div>
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