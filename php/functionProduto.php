<?php 
    function dataTableReceitas($idProduto){

        include('connection.php');

<<<<<<< Updated upstream
        $sql = 'SELECT r.idReceita as receitaId,
                    r.quantidadePigmento as qtdePigmento,
                    r.observacoes as receitaObs,
                                    
                    rmp.idMateriaPrima as materiaId,
                    rmp.quantidadeMaterial as qtdeMateria,

                    pr.descricao as produtoNome,
                    pr.imagem as produtoImg,    

                    f.idFerramental as moldeId,
                    f.descricao as moldeNome, 
                    tfer.descricao as tipoMolde_nome,

                    mat.descricao as materialNome,
                    tm.descricao as tipo_materiaNome, 
                    c.descricao as classeMaterial,

                    pg.descricao as pigmentoNome,  
                    tp.descricao as tipoPigmento
                    
                    FROM receita_materia_prima as rmp
                    
                    LEFT JOIN receitas as r 
                    ON rmp.idReceita = r.idReceita
                    
                    LEFT JOIN materia_prima as mat
                    ON rmp.idMateriaPrima = mat.idMateriaPrima

                    LEFT JOIN classe_material as c
                    ON c.idClasse = mat.idClasse

                    LEFT JOIN tipo_materia_prima as tm
                    ON tm.idTipoMateriaPrima = mat.idTipoMateriaPrima

                    LEFT JOIN produtos as pr
                    ON r.idProduto = pr.idProduto

                    RIGHT JOIN ferramental as f
                    ON f.idProduto = pr.idProduto

                    LEFT JOIN tipos_ferramental as tfer
                    ON f.idTiposFerramental = tfer.idTiposFerramental

                    LEFT JOIN pigmentos as pg
                    ON pg.idPigmento = r.idPigmento

                    LEFT JOIN tipo_pigmentos as tp
                    ON tp.idTipoPigmento = pg.idTipoPigmento

                    WHERE r.ativo = 1
                    AND r.idProduto =  '.$idProduto.';';
=======
        $sql = 'SELECT * FROM view_receitas
                    WHERE ativoReceita = 1
                    AND produtoId = '.$idProduto.';';
>>>>>>> Stashed changes

        $table = "";
        $receita = array();
        $idAnterior = '';
        $idProximo = '';

        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0){

            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }

            $n = 0;
            $arrayMat = array(
                            'nome' => array(),
                            'tipo' => array(),
                            'classe' => array(),
                            'quantidade' => array());

            foreach($array as $campo){   

                $arrayQtdMat = receitas($campo['receitaId']);   

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

                    if($n == count($arrayQtdMat)){

                        $table .=
                                '<tr align-items="center";>
                                    <td>'.$campo['receitaId'].'</td>
                                    <td>';

                        for ($cont = 0;$cont < count($arrayQtdMat);$cont++){
                            
                            if ($cont == 0){

                                $table .=''.$arrayMat['nome'][$cont].'('.$arrayMat['tipo'][$cont].')';

                            } else if ($cont == (count($arrayQtdMat) - 1)){

                                $table .=' - '.$campo['materialNome'].'('.$campo['tipo_materiaNome'].')';

                            } else {

                                $table .=' - '.$arrayMat['nome'][$cont].'('.$arrayMat['tipo'][$cont].')';
                            }
                        }

                        $table .=
                                '</td>
                                <td>'.$campo['pigmentoNome'].'</td>
                                <td>
                                    <div class="divButtons">
                                        <div class="div1">                                   
                                            <button type="button" style="width: auto; border-radius:5px" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$campo['receitaId'].'">
                                                Selecionar
                                            </button>
                                        </div>
                                        <div class="div2">
                                            <button type="button" style="width: auto; border-radius:5px" class="btn btn-danger margin-5" data-toggle="modal" data-target="#ExcluiModal'.$campo['receitaId'].'">
                                                Desativar
                                            </button>      
                                        </div>   
                                    </div>                      
                                </td>

                                <div class="modal fade" id="ExcluiModal'.$campo['receitaId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Desativar Receita</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>                            
                                            <div class="modal-body">
                                                <form method="POST" action="php/savePedidos.php? validacao=DR&id='.$campo["receitaId"].'&pr='.$campo['produtoNome'].'">
                                                    <label> Confirmar esta ação? </label>
                                                    <div align-items="right">
                                                        <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" id="modalPedido'.$campo["receitaId"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Criar pedido</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>  
                                            <div class="modal-body">
                                            
                                                <diiv class="card">
                                                    <form method="POST" action="php/savePedidos.php? validacao=I&id='.$campo['receitaId'].'&idMateria='.$campo['materiaId'].'">
            
                                                        <div class="card-body">
                                                            <div class="input-group mb-3">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Produto</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['produtoNome'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>               
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Ferramental</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['moldeNome'].'" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>'; 

                        for ($cont = 0;$cont < count($arrayQtdMat);$cont++){                            
                            if ($cont == 0){                                        
                                
                                $table .=
                                        '<div class="form-group row">
                                            <label>Matéria Prima '.($cont + 1).'</label>
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$arrayMat['nome'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$arrayMat['tipo'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$arrayMat['classe'][$cont].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="row mb-3">
                                                <label for="nClasse" class="col-sm-6 text-right control-label col-form-label">Quantiade usada por produto</label>
                                                <div class="col-sm-2">
                                                    <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.$arrayMat['quantidade'][$cont].'">
                                                </div> 
                                                <label text-align:left class="col-sm-4 text-right control-label col-form-label">gramas</label> 
                                            </div>
                                        </div>'; 

                            } else if ($cont == (count($arrayQtdMat) - 1)){              
                                $table .=
                                        '<div class="card-body">
                                            <label>Matéria Prima '.($cont + 1).'</label>
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$campo['materialNome'].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$campo['tipo_materiaNome'].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$campo['classeMaterial'].'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="row mb-3">
                                                <label for="nClasse" class="col-sm-6 text-right control-label col-form-label">Quantiade usada por produto</label>
                                                <div class="col-sm-2">
                                                    <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.$campo['qtdeMateria'].'">
                                                </div> 
                                                <label text-align:left class="col-sm-4 text-right control-label col-form-label">gramas</label> 
                                            </div>
                                        </div>';
                            } else {                                        
                                
                                $table .=
                                        '<div class="form-group row">
                                            <label>Matéria Prima '.($cont + 1).'</label>
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$arrayMat['nome'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$arrayMat['tipo'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$arrayMat['classe'][$cont].'">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <div class="row mb-3">
                                                <label for="nClasse" class="col-sm-6 text-right control-label col-form-label">Quantiade usada por produto</label>
                                                <div class="col-sm-2">
                                                    <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.$arrayMat['quantidade'][$cont].'">
                                                </div> 
                                                <label text-align:left class="col-sm-4 text-right control-label col-form-label">gramas</label> 
                                            </div>
                                        </div>';
                            }
                        }
                                        
                        $table .=                                    
                                                            '<div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Pigmento</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['pigmentoNome'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['tipoPigmento'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['qtdePigmento'].'" id="idQtdPigmento" name="nQtdPigmento" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Quantidade de produção</label>
                                                                <div class="col-sm-7">
                                                                    <input id="idQtdeProduto" name="nQtdeProduto" value="50" type="number" min="50" class="form-control" style="width: 100%; height:36px;">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Maquina</label>
                                                                <div class="col-sm-7">
                                                                    <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                        '.optionMaquina($campo['moldeId']).'
                                                                    </select>
                                                                </div>
                                                            </div>                                    
                                        
                                                            <div class="form-group row" style="align-content:justify">                            
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Status da ordem de produção</label>
                                                                <div class="col-sm-7">
                                                                    <select id="idStatus" name="nStatus" class="select2 form-control custom-select" style="width: 40%; height:36px;">
                                                                        <option value=1>aberto</option>
                                                                        <option value=2>Inicializado</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Observações</label>
                                                                <div class="col-sm-7">
                                                                    <textarea class="form-control" id="iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea> 
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="border-top">
                                                            <div class="card-body">
                                                                <button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">
                                                                    Realizar Pedido
                                                                </button>
                                                            </div>
                                                        </div>                                                
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
                                <td>'.$campo['receitaId'].'</td>
                                <td>'.$campo['materialNome'].'('.$campo['tipo_materiaNome'].')</td>
                                <td>'.$campo['pigmentoNome'].'</td>
                                <td>                                
                                    <div class="divButtons">
                                        <div class="div1">                                   
                                            <button type="button" style="width: auto; border-radius:5px" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$campo['receitaId'].'">
                                                Selecionar
                                            </button>
                                        </div>
                                        <div class="div2">
                                            <button type="button" style="width: auto; border-radius:5px" class="btn btn-danger margin-5" data-toggle="modal" data-target="#ExcluiModal'.$campo['receitaId'].'">
                                                Desativar
                                            </button>      
                                        </div>   
                                    </div>                                
                                </td>

                                <div class="modal fade" id="ExcluiModal'.$campo['receitaId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>                            
                                            <div class="modal-body">
                                                <form method="POST" action="php/savePedidos.php? validacao=DR&id='.$campo["receitaId"].'&pr='.$campo['produtoNome'].'">
                                                    <label> Confirmar esta ação? </label>
                                                    <div align-items="right">
                                                        <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" id="modalPedido'.$campo["receitaId"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>  
                                            <div class="modal-body">
                                            
                                                <diiv class="card">
                                                    <form method="POST" action="php/savePedidos.php? validacao=I&id='.$campo['receitaId'].'">
            
                                                        <div class="card-body">
                                                            <div class="input-group mb-3">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Produto</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['produtoNome'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>               
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Ferramental</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['moldeNome'].'" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>  

                                                            <div class="form-group row">
                                                                <label>Matéria Prima</label>
                                                                <div class="row mb-3">
                                                                    <div class="col-lg-6">
                                                                        <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$campo['materialNome'].'" >
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$campo['tipo_materiaNome'].'" >
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$campo['classeMaterial'].'" >
                                                                    </div>
                                                                </div>
                                                            </div>   

                                                            
                                                            <div class="form-group row">
                                                                <div class="row mb-3">
                                                                    <label for="nClasse" class="col-sm-6 text-right control-label col-form-label">Quantiade usada por produto</label>
                                                                    <div class="col-sm-2">
                                                                        <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.$campo['qtdeMateria'].'">
                                                                    </div> 
                                                                    <label text-align:left class="col-sm-4 text-right control-label col-form-label">gramas</label> 
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Pigmento</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['pigmentoNome'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['tipoPigmento'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                                <div class="col-sm-7">
                                                                    <input value="'.$campo['qtdePigmento'].'" id="idQtdPigmento" name="nQtdPigmento" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Quantidade de produção</label>
                                                                <div class="col-sm-7">
                                                                    <input id="idQtdeProduto" name="nQtdeProduto" value="50" type="number" min="50" class="form-control" style="width: 100%; height:36px;">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Maquina</label>
                                                                <div class="col-sm-7">
                                                                    <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                        '.optionMaquina($campo['moldeId']).'
                                                                    </select>
                                                                </div>
                                                            </div>                                    
                                        
                                                            <div class="form-group row" style="align-content:justify">                            
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Status da ordem de produção</label>
                                                                <div class="col-sm-7">
                                                                    <select id="idStatus" name="nStatus" class="select2 form-control custom-select" style="width: 40%; height:36px;">
                                                                        <option value=1>aberto</option>
                                                                        <option value=2>Inicializado</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Observações</label>
                                                                <div class="col-sm-7">
                                                                    <textarea class="form-control" id="iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea> 
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                        <div class="border-top">
                                                            <div class="card-body">
                                                                <button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">
                                                                    Realizar Pedido
                                                                </button>
                                                            </div>
                                                        </div>                                                
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
            mysqli_close($conn);
        }  
        return $table;
    }
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
                                                        .'<label for="fname" class="col-sm-5 text-right control-label col-form-label">Nome do produto</label>'
                                                        .'<div class="col-sm-7">'
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
                                                        .'<div class="col-sm-7">'
                                                            .'<input type="text" class="form-control" id="iMolde" name= "nMolde" placeholder="Nome do material">'
                                                        .'</div>'
                                                    .'</div>'

                                                    .'<div class="form-group row">'
                                                        .'<label class="col-md-3 m-t-15" style="text-align: right;">Peso</label>'
                                                        .'<div class="col-sm-7">'
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
                //col-lg-3 col-md-6el-card-avatar el-overlay-1
                            
                $card .="<div class='row divBoxProduto'>
                            <div class='row el-element-overlay'> "
                                ."<div class='divBoxCard'>"
                                    ."<div class='card'>"
                                        ."<div class='el-card-item'>"
                                            ."<div>"                                            
                                                ."<img class='divBoxImg' name='nImg' id='idImg' src='".$campo['imagem']."' alt='user'/>"
                                            ."</div>"
                                            ."<div class='el-card-content'>"
                                            ."  <form method='POST' action='receitas.php? idProduto=".$campo['idProduto']."&pr=".$campo['descricao']."'>"
                                                    ."<h4 id='idProduto' name='nProduto' class='m-b-0'>".$campo['descricao']."</h4> <span class='text-muted'></span>" 
                                                    .'<button style="width: auto; border-radius: 5px;" type="submit" class="btn btn-info margin-5">'
                                                        .'Selecionar'
                                                    .'</button>'
                                            .'  </form>'
                                            ."</div>" 
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