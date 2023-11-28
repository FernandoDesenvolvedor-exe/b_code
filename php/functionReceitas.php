<?php
//LUIS FEZ VIEWS, ATUALIZAR ESSA FUNÇÃO
    function dataTableReceitas($idProduto){

        include('connection.php');
        
        $sql = 'SELECT * FROM view_receitas
                    WHERE ativoReceita = 1
                    AND produtoId = '.$idProduto.';';


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
                        $arrayMat['id'] = array($campo['materiaId']);
                        $arrayMat['nome'] = array($campo['materialNome']);
                        $arrayMat['tipo'] = array($campo['tipo_materiaNome']);  
                        $arrayMat['classe'] = array($campo['classeMaterial']);
                        $arrayMat['quantidade'] = array($campo['qtdeMateria']); 
                    } else {  
                        array_push($arrayMat['id'], $campo['materiaId']);
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
                                                <div class="col-sm-6">
                                                    <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$arrayMat['nome'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$arrayMat['tipo'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$arrayMat['classe'][$cont].'">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" id="idMateriaFornecedor" name="nMateriaFornecedor[]" class="form-control" value="'.materiaFornecedor($arrayMat['id'][$cont]).'">
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
                                                <div class="col-lg-3">
                                                    <input type="text" id="idMateriaFornecedor" name="nMateriaFornecedor[]" class="form-control" value="'.materiaFornecedor($campo['materiaId']).'">
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
                                                <div class="col-lg-3">
                                                    <input type="text" id="idMateriaFornecedor" name="nMateriaFornecedor[]" class="form-control" value="'.materiaFornecedor($arrayMat['id'][$cont]).'">
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
                                                            
                                                            
                                                            
                                                            <label style="text-align=center;" class="col-md-8">Status da ordem de produção</label>
                                                            <div class="form-group row">
                                                                <div class="col-md-9">
                                                                    <fieldset>
                                                                        <div class="custom-control custom-radio">
                                                                            <input value=1 type="radio" class="custom-control-input" id="idAberto" name="nMaquina" >
                                                                            <label class="custom-control-label" for="idAdm"> Administrador </label>
                                                                        </div>
                                                                        <div class="custom-control custom-radio">
                                                                            <input value=2 type="radio" class="custom-control-input" id="idInicializado" name="nMaquina" >
                                                                            <label class="custom-control-label" for="idComum"> Comum </label>
                                                                        </div>
                                                                    </fieldset>
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
                                                                    <div class="col-lg-3">
                                                                        <input type="text" id="idMateriaFornecedor" name="nMateriaFornecedor[]" class="form-control" value="'.materiaFornecedor($campo['materiaId']).'">
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
                                        
                                                            <div class="form-group row" style="align-content:justify">                            
                                                                <label for="nClasse" class="col-sm-6 text-right control-label col-form-label">Status da ordem de produção</label>
                                                                <div class="col-sm-6">
                                                                    <select id="idStatus" name="nStatus" class="select2 form-control custom-select" style="width: 40%; height:36px;">
                                                                        <option value=1>aberto</option>
                                                                        <option value=2>Inicializado</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                        
                                                            <div id="divMaquina" class="form-group row">
                                                                <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Maquina</label>
                                                                <div class="col-sm-7">
                                                                    <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                        '.optionMaquina($campo['moldeId']).'
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

?>