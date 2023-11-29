<?php 

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

    $sql = 'SELECT * FROM view_pedidos
                WHERE ativoPedido = 1
                ORDER BY pedidoId ASC;';
            

    $table = "";

    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        $n = 0;

        foreach($array as $campo){

            $dataAberto =''.substr($campo['abertoData_hora'], 8, 2).'/';
            $dataAberto .=''.substr($campo['abertoData_hora'], 5, 2).'/';
            $dataAberto .=''.substr($campo['abertoData_hora'], 0, 4).'';
            $horaAberto = substr($campo['abertoData_hora'], 11, 8);

            $dataProducao =''.substr($campo['producaoData_hora'], 8, 2).'/';
            $dataProducao .=''.substr($campo['producaoData_hora'], 5, 2).'/';
            $dataProducao .=''.substr($campo['producaoData_hora'], 0, 4).'';
            $horaProducao = substr($campo['producaoData_hora'], 11, 8);
            
            $dataFechado =''.substr($campo['fechadoData_hora'], 8, 2).'/';
            $dataFechado .=''.substr($campo['fechadoData_hora'], 5, 2).'/';
            $dataFechado .=''.substr($campo['fechadoData_hora'], 0, 4).'';
            $horaFechado = substr($campo['fechadoData_hora'], 11, 8);

            

            $materia = receitas($campo['receitaId']);

            if(count($materia) > 1){       

                $n++;

                if ($n == 1){
                    $arrayMat['materialNome'] = array($campo['material']);
                    $arrayMat['materialTipo'] = array($campo['tipoMat']);  
                    $arrayMat['materialClasse'] = array($campo['classeMat']);
                    $arrayMat['materialQuantidade'] = array($campo['qtdeMateria']); 
                    $arrayMat['fornecedorM'] = array($campo['fornecedorM']);
                } else {  
                    array_push($arrayMat['materialNome'], $campo['material']);
                    array_push($arrayMat['materialTipo'], $campo['tipoMat']);  
                    array_push($arrayMat['materialClasse'], $campo['classeMat']);
                    array_push($arrayMat['materialQuantidade'], $campo['qtdeMateria']);
                    array_push($arrayMat['fornecedorM'], $campo['fornecedorM']);
                }

                if($n == count($materia)){

                    $table .=   
                            '<tr align-items="center";>
                                <td>'.$campo['pedidoId'].'</td>
                                <td>'.$campo['produto'].'</td>';
                    for ($cont = 0;$cont < count($materia);$cont++){                            
                        if ($cont == 0){ 
                            $table .='<td>'.$arrayMat['materialNome'][$cont].''; 

                        } else if ($cont == (count($materia) - 1)){              
                            $table .=' - '.$campo['material'].'</td>';

                        } else { 
                            $table .=' - '.$arrayMat['materialNome'][$cont].'';
                                    
                        }
                    }
                    $table .=     
                               '<td>'.$campo['cor'].'</td>
                                <td>'.$dataAberto.' às '.$horaAberto.'</td>';
            
                    if ($campo['stats'] == 1){
                        
                        $table .=
                                '<td>                            
                                    <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalInicio'.$campo['pedidoId'].'">
                                        Em aberto
                                    </button>                                
                                </td>'; 

                    } else if ($campo['stats'] == 2) {

                        $table .=
                                '<td>                                                                       
                                    <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                        Em Produção
                                    </button>
                                </td>';

                    } else if ($campo['stats'] == 3) {

                        $table .=
                                '<td>Concluido</td>';

                    } else if ($campo['stats'] == 0) {

                        $table .=
                                '<td>Cancelado</td>';

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

                                <div class="modal fade" id="modalInicio'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Iniciar produção?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
    
                                                <form method="POST" action="php/savePedidos? validacao=A&id='.$campo["pedidoId"].'&stats='.$campo['stats'].'">
                                                    <div>                                     
                                                        <div class="input-group mb-3">
                                                            <label for="nClasse" class="col-sm-8 text-right control-label col-form-label">Máquina as ser produzida:</label>
                                                            <div class="col-sm-4">                                                            
                                                                <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                    '.optionMaquina($campo['moldeId']).'
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

                                <div class="modal fade" id="modalAltera'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Encerrar produção</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">                                                

                                                <form method="POST" action="php/savePedidos.php? validacao=A&id='.$campo["pedidoId"].'&idMateria='.$campo['materiaId'].'&stats='.$campo['stats'].'">
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

                                <div class="modal fade" id="modalPedido'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">                                
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
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
                                                            <input value="'.$campo['name'].' '.$campo['sobName'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>';
                                        
                    if($campo['nivel'] == 1){
                        
                        $table .=
                                    '<div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                        <div class="col-sm-8">
                                            <input value="Administrador" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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

                    if ($campo['stats'] == 1){

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
                                            <input value="Produção não iniciada" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                        <div class="col-sm-8">
                                            <input value="Produção não iniciada" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';

                    } else if ($campo['stats'] == 2){

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
                                            <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                        <div class="col-sm-8">
                                            <input value="Produção não concluida" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';

                    } else if ($campo['stats'] == 3){

                        $datatime1 = new DateTime(''.substr($campo['producaoData_hora'], 0, 10).' '.substr($campo['abertoData_hora'], 11, 8).' America/Sao_Paulo');
                        $datatime2 = new DateTime(''.substr($campo['fechadoData_hora'], 0, 10).' '.substr($campo['fechadoData_hora'], 11, 8).' America/Sao_Paulo');

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
                                                    </div>
                                    
                                                    <div class="input-group mb-3">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Peso do Produto</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['pesoPro'].'g" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>';

                    if ($campo['stats'] == 1 || $campo['stats'] == 2){
    
                        $table .=
                                    '<div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção prevista</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['qtdPrevista'].' '.$campo['produto'].'s" id="idTipoCor" name="nTipoCor" type="number" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';
    
                    }  else if ($campo['stats'] == 3){
    
                        $table .=
                                    '<div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Prevista:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['qtdPrevista'].'" id="idQtdPrev" name="nQtdPrev" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
    
                                    <div class="input-group mb-3">                                        
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Real:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['qtdRealizada'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">                                    
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Refugos:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['qtdRefugo'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Total:</label>
                                        <div class="col-sm-8">
                                            <input value="'.($campo['qtdRealizada'] - $campo['qtdRefugo']).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';
    
                    }                                
                                                    
                    
                    $table .=
                                                    '<div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Ferramental</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['molde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Ferramental</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['tipoMolde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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
                                                    <h4>Matéria Prima usada</h4>';
                                                
                    for ($cont = 0;$cont < count($materia);$cont++){                            
                        if ($cont == 0){                                        
                            
                            $table .=
                                    '<div class="card-body">
                                        <label>Matéria Prima '.($cont + 1).'</label>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$arrayMat['materialNome'][$cont].'">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$arrayMat['materialTipo'][$cont].'">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$arrayMat['materialClasse'][$cont].'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantiade usada</label>
                                        <div class="col-lg-3">
                                            <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($arrayMat['materialQuantidade'][$cont] * $campo['qtdPrevista']).'g">
                                        </div> 
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-8">
                                            <input value="'.$arrayMat['fornecedorM'][$cont].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>'; 

                        } else if ($cont == (count($materia) - 1)){              
                            $table .=
                                    '<div class="card-body">
                                        <label>Matéria Prima '.($cont + 1).'</label>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$campo['material'].'">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$campo['tipoMat'].'">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$campo['classeMat'].'">
                                            </div>
                                        </div>
                                    </div>                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantiade usada</label>
                                        <div class="col-lg-3">
                                            <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($campo['qtdeMateria'] * $campo['qtdPrevista']).'g">
                                        </div> 
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['fornecedorM'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';
                        } else {                                        
                            
                            $table .=
                                    '<div class="card-body">
                                        <label>Matéria Prima '.($cont + 1).'</label>
                                        <div class="row mb-3">
                                            <div class="col-lg-4">
                                                <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$arrayMat['materialNome'][$cont].'">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$arrayMat['materialTipo'][$cont].'">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$arrayMat['materialClasse'][$cont].'g">
                                            </div>
                                        </div>
                                    </div>                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantiade usada</label>
                                        <div class="col-lg-3">
                                            <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($arrayMat['materialQuantidade'][$cont] * $campo['qtdeProduto']).'g">
                                        </div> 
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-8">
                                            <input value="'.$arrayMat['fornecedorM'][$cont].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';
                        }
                    }
                    $table .=

                                               '</div>

                                                <div>                            
                                                    <h4>Pigmento Usado</h4>
                                        
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Pigmento</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['cor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Código</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['codCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Lote</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['loteCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>                      
                                        
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                        <div class="col-sm-8">
                                                                <input value="'.($campo['qtdePigmento'] * $campo['qtdPrevista']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['tipoCor'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="form-group row">
                                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                        <div class="col-sm-8">
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

                    $n = 0;

                } 
            } else {

                $table .=   
                        '<tr align-items="center";>
                            <td>'.$campo['pedidoId'].'</td>
                            <td>'.$campo['produto'].'</td> 
                            <td>'.$campo['material'].'</td>         
                            <td>'.$campo['cor'].'</td>
                            <td>'.$dataAberto.' às '.$horaAberto.'</td>';
        
                if ($campo['stats'] == 1){
                    
                    $table .=
                            '<td>                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalInicio'.$campo['pedidoId'].'">
                                    Em aberto
                                </button>                                
                            </td>'; 

                } else if ($campo['stats'] == 2) {

                    $table .=
                            '<td>                                                                       
                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                    Em Produção
                                </button>
                            </td>';

                } else if ($campo['stats'] == 3) {

                    $table .=
                            '<td>Concluido</td>';

                } else if ($campo['stats'] == 0) {

                    $table .=
                            '<td>Cancelado</td>';

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

                            <div class="modal fade" id="modalInicio'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Iniciar produção?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="POST" action="php/savePedidos? validacao=A&id='.$campo["pedidoId"].'&stats='.$campo['stats'].'">
                                                <div>                                     
                                                    <div class="input-group mb-3">
                                                        <label for="nClasse" class="col-sm-8 text-right control-label col-form-label">Máquina as ser produzida:</label>
                                                        <div class="col-sm-4">                                                            
                                                            <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                '.optionMaquina($campo['moldeId']).'
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

                            <div class="modal fade" id="modalAltera'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Encerrar produção</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="POST" action="php/savePedidos.php? validacao=A&id='.$campo["pedidoId"].'&stats='.$campo['stats'].'">
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

                            <div class="modal fade" id="modalPedido'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">                                
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
                                                        <input value="'.$campo['name'].' '.$campo['sobName'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>';
                                        
                if($campo['nivel'] == 1){
                    
                    $table .=
                                '<div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                    <div class="col-sm-8">
                                        <input value="Administrador" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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

                if ($campo['stats'] == 1){

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

                } else if ($campo['stats'] == 2){

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

                } else if ($campo['stats'] == 3){

                    $datatime1 = new DateTime(''.substr($campo['producaoData_hora'], 0, 10).' '.substr($campo['abertoData_hora'], 11, 8).' America/Sao_Paulo');
                    $datatime2 = new DateTime(''.substr($campo['fechadoData_hora'], 0, 10).' '.substr($campo['fechadoData_hora'], 11, 8).' America/Sao_Paulo');

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
                                                </div>
                                
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Peso do Produto</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['pesoPro'].'g" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>';

                if ($campo['stats'] == 1 || $campo['stats'] == 2){

                    $table .=
                                '<div class="form-group row">
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção prevista</label>
                                    <div class="col-sm-8">
                                        <input value='.$campo['qtdPrevista'].' id="idQtdPrev" name="nQtdPrev" type="number" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>';

                }  else if ($campo['stats'] == 3){
    
                    $table .=
                                '<div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Prevista:</label>
                                    <div class="col-sm-8">
                                        <input value="'.$campo['qtdPrevista'].'" id="idQtdPrev" name="nQtdPrev" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>

                                <div class="input-group mb-3">                                        
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Real:</label>
                                    <div class="col-sm-8">
                                        <input value="'.$campo['qtdRealizada'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>

                                <div class="input-group mb-3">                                    
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Refugos:</label>
                                    <div class="col-sm-8">
                                        <input value="'.$campo['qtdRefugo'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Total:</label>
                                    <div class="col-sm-8">
                                        <input value="'.($campo['qtdRealizada'] - $campo['qtdRefugo']).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>';

                }                                
                                                
                
                $table .=
                                                '<div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Ferramental</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['molde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Ferramental</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['tipoMolde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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

                                            <div syle="display:grid;">
                                                <h4>Matéria Prima Usada</h4>
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Matéria Prima</label>
                                                    <div class="col-sm-8">
                                                            <input value="'.$campo['material'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>                   
                                                    </div>
                                                </div>      
                        
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                    <div class="col-sm-8">
                                                            <input value="'.($campo['qtdeMateria'] * $campo['qtdPrevista']).'g" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>

                                
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de material</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['tipoMat'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Classe do Material</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['classeMat'].'" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['fornecedorM'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>                            
                                            </div>

                                            <div>                            
                                                <h4>Pigmento Usado</h4>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Pigmento</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['cor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Código</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['codCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Lote</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['loteCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>                      
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                    <div class="col-sm-8">
                                                            <input value="'.($campo['qtdePigmento'] * $campo['qtdPrevista']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['tipoCor'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                    <div class="col-sm-8">
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

                $n = 0;

            }            
        }
    }        

    return $table;
}

?>