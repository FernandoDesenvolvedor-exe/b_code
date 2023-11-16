<?php 

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

    $sql = 'SELECT ped.idPedido as pedidoId,
                ped.idUsuario as userId, 
                ped.idReceita as receitaId,
                ped.idMaquina as maquinaId,
                ped.dataHora_aberto as abertoData_hora,
                ped.dataHora_producao as producaoData_hora,
                ped.dataHora_fechado as fechadoData_hora,     
                ped.status as stats,
                ped.observacoes as obs,
                ped.refugo as refugos,
                ped.quantidade as qtdeProduto,

                usu.idTurma as turmaId,    
                usu.nome as name,                        
                usu.sobrenome as sobName,    

                tur.nomeTurma as turma,  
                tur.turno as turno, 

                maq.descricao as maquina,

                rec.idProduto as produtoId,            
                rec.idPigmento as pigmentoId,
                rec.quantidadePigmento as qtdePigmento,

                rmp.idMateriaPrima as materiaId,
                rmp.quantidadeMaterial as qtdeMateria,

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

                RIGHT JOIN receita_materia_prima as rmp
                ON rmp.idReceita = rec.idReceita

                LEFT JOIN materia_prima as mat
                ON rmp.idMateriaPrima = mat.idMateriaPrima

                RIGHT JOIN materia_fornecedor as format
                ON mat.idMateriaPrima = format.idMateriaPrima

                RIGHT JOIN tipo_materia_prima as tmat
                ON mat.idTipoMateriaPrima = tmat.idTipoMateriaPrima

                RIGHT JOIN classe_material as cmat
                ON mat.idClasse = cmat.idClasse

                LEFT JOIN produtos as pro
                ON rec.idProduto = pro.idProduto

                RIGHT JOIN ferramental as fer
                ON pro.idProduto = fer.idProduto

                LEFT JOIN tipos_ferramental as tfer
                ON fer.idTiposFerramental = tfer.idTiposFerramental

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

                WHERE ped.ativo = 1
                ORDER BY ped.idPedido ASC;';
            

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
                                    <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
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
                                                    <h4>Status da ordem de produção</h4>';

                    if ($campo['stats'] == 1){

                        $table .=
                                    '<div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Aberto em:</label>
                                        <div class="col-sm-9">
                                            <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produção inicializada em:</label>
                                        <div class="col-sm-9">
                                            <input value="Produção não iniciada" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Concluido em:</label>
                                        <div class="col-sm-9">
                                            <input value="Produção não iniciada" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';

                    } else if ($campo['stats'] == 2){

                        $table .=
                                    '<div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Aberto em:</label>
                                        <div class="col-sm-9">
                                            <input value="'.$dataAberto.' às '.$horaAberto.'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produção inicializada em:</label>
                                        <div class="col-sm-9">
                                            <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Concluido em:</label>
                                        <div class="col-sm-9">
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
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Duração</label>
                                        <div class="col-sm-9">
                                            <input value="'.$diff->format("%a dias e %H:%I:%S").' horas" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>  
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Aberto em:</label>
                                        <div class="col-sm-9">
                                            <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produção inicializada em:</label>
                                        <div class="col-sm-9">
                                            <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Concluido em:</label>
                                        <div class="col-sm-9">
                                            <input value="'.$dataFechado.' às '.$horaFechado.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>';

                    }

                    $table .=
                                                '</div>
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
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantiade usada</label>
                                        <div class="col-lg-3">
                                            <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($arrayMat['materialQuantidade'][$cont] * $campo['qtdeProduto']).'g">
                                        </div> 
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-9">
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
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantiade usada</label>
                                        <div class="col-lg-3">
                                            <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($campo['qtdeMateria'] * $campo['qtdeProduto']).'g">
                                        </div> 
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-9">
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
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Quantiade usada</label>
                                        <div class="col-lg-3">
                                            <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($arrayMat['materialQuantidade'][$cont] * $campo['qtdeProduto']).'g">
                                        </div> 
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-9">
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
                                                    </div>';
                                                    
                    if ($campo['stats'] == 3) {
                        $table .=
                                                    '<div class="form-group row">
                                                        <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                        <div class="col-sm-9">
                                                            <input value="'.$campo['refugos'].'" id="idRefugo" name="nRefugo" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div>
                                                    </div>';
                    }
                    $table .=                    
                                                    
                                                '</div>

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
                            <td>'.$dataAberto.'</td>';
        
                if ($campo['stats'] == 1){
                    
                    $table .=
                            '<td>                                                                       
                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
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
                                            <h5 class="modal-title" id="exampleModalLabel">Ordem de produção</h5>
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
                                                <h4>Status da ordem de produção</h4>';

                if ($campo['stats'] == 1){

                    $table .=
                                '<div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Aberto em:</label>
                                    <div class="col-sm-9">
                                        <input value="'.$dataAberto.' às '.$horaAberto.'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produção inicializada em:</label>
                                    <div class="col-sm-9">
                                        <input value="Pedido não foi inicializado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Concluido em:</label>
                                    <div class="col-sm-9">
                                        <input value="Pedido não foi inicializado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>';

                } else if ($campo['stats'] == 2){

                    $table .=
                                '<div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Aberto em:</label>
                                    <div class="col-sm-9">
                                        <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produção inicializada em:</label>
                                    <div class="col-sm-9">
                                        <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Concluido em:</label>
                                    <div class="col-sm-9">
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
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Duração</label>
                                    <div class="col-sm-9">
                                        <input value="'.$diff->format("%a dias e %H:%I:%S").' horas" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Aberto em:</label>
                                    <div class="col-sm-9">
                                        <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Produção inicializada em:</label>
                                    <div class="col-sm-9">
                                        <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Concluido em:</label>
                                    <div class="col-sm-9">
                                        <input value="'.$dataFechado.' às '.$horaFechado.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>';

                }

                $table .=
                                            '</div>

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
                                                </div>';
                                                
                if ($campo['stats'] == 3) {
                    $table .=
                                                '<div class="form-group row">
                                                    <label for="nClasse" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                    <div class="col-sm-9">
                                                        <input value="'.$campo['refugos'].'" id="idRefugo" name="nRefugo" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>';
                }
                $table .=                    
                                                
                                            '</div>

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