<?php
    function dataTableReceitas($idProduto){
        
        include('connection.php');
        
        $sql = 'SELECT * FROM view_receitas
                    WHERE ativoReceita = 1
                    AND produtoId = '.$idProduto.'
                    GROUP BY receitaId;';


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
                        '<tr align-items="center";>
                            <td>'.$campo['receitaId'].'</td>
                            <td>'.materiaisReceita($campo['receitaId'],2).'</td>
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
                        
                            <div style="max-height: 700px" class="modal fade" id="modalPedido'.$campo["receitaId"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog modal-lg" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Criar pedido</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>  
                                        <div class="modal-body pre-scrollable">
                                        
                                            <diiv class="card">
                                                <form method="POST" action="php/savePedidos.php?validacao=I&id='.$campo['receitaId'].'&idProduto='.$campo['produtoId'].'">
        
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
                                                            <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Tipo de Ferramental</label>                                                            
                                                            <div class="col-sm-7">
                                                                <input value="'.$campo['tipoMolde_nome'].'" id="idTipoMolde" name="nTipoMolde" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                            </div>
                                                        </div>
                                                        '.materiaisReceita($campo['receitaId'],1).'
                                                        <div class="form-group row">
                                                            <input value="'.$campo['pigmentoId'].'" id="idPigmento" name="nPigmento" type="text" class="form-control" style="width: 100%; height:36px;" hidden>
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
                                                            <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Fornecedor</label>
                                                            <div class="col-sm-7">
                                                                <input value="'.nomeFornecedorPigmento($campo['pigmentoId']).'" id="idCorFornecedor" name="nCorFornecedor" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Quantidade de pigmento</label>
                                                            <div class="col-sm-2">
                                                                <input value="'.$campo['qtdePigmento'].'" id="idQtdPigmento" name="nQtdPigmento" type="text" class="form-control" style="width: 100%; height:36px;" >
                                                            </div>
                                                            <label for="nClasse" class="col-sm-5 text-left control-label col-form-label">g</label>
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Produção prevista</label>
                                                            <div class="col-sm-7">
                                                                <input id="idQtdeProduto" name="nQtdeProduto" value="50" type="number" min="50" class="form-control" style="width: 100%; height:36px;">
                                                            </div>
                                                        </div>                                                        
                                                        
                                                        <div class="form-group row">
                                                            <label class="col-sm-5 text-right mt-2">Status:</label>
                                                            <div class="col-sm-7">
                                                                <select id="idStatus'.$campo['receitaId'].'" name="nStatus'.$campo['receitaId'].'" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                                    <option value="1">Em Aberto</option>
                                                                    <option value="2">Em Andamento</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row" id="iDivMaquina'.$campo['receitaId'].'">
                                                            <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Maquina</label>
                                                            <div class="col-sm-7">
                                                                <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                    '.optionMaquina($campo['moldeId']).'
                                                                </select>
                                                            </div>
                                                        </div>      
                                                       
                                                        <script>                                                            
                                                            $("document").ready(function(){
                                                                $("#iDivMaquina'.$campo['receitaId'].'").hide();
                                                                $("#idStatus'.$campo['receitaId'].'").on("change", function(){
                                                                    if($("#idStatus'.$campo['receitaId'].'").val() == 2){                    
                                                                        $("#iDivMaquina'.$campo['receitaId'].'").show();
                                                                    }else{
                                                                        $("#iDivMaquina'.$campo['receitaId'].'").hide();
                                                                    }
                                                                })
                                                            });
                                                        </script>

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

                             
            }  
            
        }  
        return $table;
    }

?>