<?php
    function dataTableReceitas($idProduto,$produto){
        
        include('connection.php');
        echo $idProduto;
        $sql = 'SELECT * FROM view_receitas
                    WHERE produtoId = '.$idProduto.'
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
                                <div class="d-flex justify-content-center">                                                
                                    <div class="col-sm-3">
                                        <a href="#" class="fas fa-eye text-info" data-toggle="modal" data-target="#modalPedido'.$campo['receitaId'].'"></a>
                                    </div>';
                if($_SESSION['tipo']==1){
                    if($campo['ativoReceita']==1){
                        //DESATIVAR
                        $table .=
                                    '<div class="col-sm-3">
                                    <a href="#" class="fas fa-unlink text-danger" align="center" data-toggle="modal" data-target="#desativaModal'.$campo['receitaId'].'" title="Desativar Receita"></a>
                                </div>
                            </td>';
                    }else{
                        //ATIVAR
                        $table .=   
                                    '<div class="col-sm-3">
                                        <a href="#" class="fas fa-undo text-success" align="center" data-toggle="modal" data-target="#ativaModal'.$campo['receitaId'].'" title="Ativar Receita"></a>
                                    </div>
                                </div>
                            </td>'; 
                    }
                }else{
                    //DESATIVAR
                    $table .=
                                    '<div class="col-sm-3">
                                    <a href="#" class="fas fa-unlink text-danger" align="center" data-toggle="modal" data-target="#desativaModal'.$campo['receitaId'].'" title="Desativar Receita"></a>
                                </div>
                            </td>';

                }
                $table .= 
                            '<div class="modal fade" id="desativaModal'.$campo['receitaId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Desativar Receita</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>                            
                                        <div class="modal-body">
                                            <form method="POST" action="php/savePedidos.php?op=0&validacao=DR&id='.$campo["receitaId"].'&idProduto='.$idProduto.'&pr='.$produto.'">
                                                <label> Confirmar esta ação? </label>
                                                <div align-items="right">
                                                    <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="modal fade" id="ativaModal'.$campo['receitaId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ativar Receita</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>                            
                                        <div class="modal-body">
                                            <form method="POST" action="php/savePedidos.php?op=1&validacao=DR&id='.$campo["receitaId"].'&idProduto='.$idProduto.'&pr='.$produto.'">
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
                                                <form method="POST" action="php/savePedidos.php?validacao=I&id='.$campo['receitaId'].'&idProduto='.$idProduto.'&pr='.$produto.'">
        
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
                                                                <input id="idQtdeProduto" name="nQtdeProduto" type="number" min="0" class="form-control" style="width: 100%; height:36px;">
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