<?php 
    function modalVisualizarHistorico($id){

        $array = selectHistoricoPedidos($id);

        if ($array == 0){
            date_default_timezone_set('America/Sao_Paulo');

            $table ='   <div class="modal fade" id="modalPedido'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog modal-lg" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pre-scrollable">
                                    </div>
                                </div>
                            </div>
                        </div>';
        } else {

            foreach($array as $campo){

                $table =   
                        '<div class="modal fade" id="modalPedido'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog modal-lg" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pedido</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pre-scrollable align-items-left">
                                        <div class="row mb-3">                                            
                                            <h4 class="col-md-12">Autor da ordem de produção</h4>

                                            <div class="input-group col-md-8">
                                                <div class="col-sm-2 text-right">
                                                    <label for="nClasse" class="control-label col-form-label">Autor</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input value="'.$campo['nomeUsuario'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';
        
                if($campo['tipoUsuario'] == 1){
        
                    $table .=
                                            '<div class="input-group col-md-4 text-left ">
                                                <div>
                                                    <input value="Administrador" id="idTipoUser" name="nTipoUser" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';
        
                } else { 
                    $table .=
                                            '<div class="input-group col-md-4 text-left">
                                                <div class="col-sm-3 text-right">
                                                    <label for="nClasse" class="control-label text-right col-form-label">turma</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input value="'.$campo['turma'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';
        
        
                }  
                
                                          
                $table .=               '</div>
                                            <div class="row mb-3">
                                                <h4 class="col-lg-12">Ordem de produção</h4>';
                            if ($campo['statusPedido'] == 1){
        
                                $table .=
                                            '<div class="col-lg-12 mt-2">
                                                <h6 class="col-lg-12">Data de Abertura da OP</h6>
                                                <div class="row">
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Aberto</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('d/m/Y', strtotime($campo['dataHora_aberto'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">às</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('h:i:s', strtotime($campo['dataHora_aberto'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>';
        
                            } else if ($campo['statusPedido'] == 2){
        
                                $table .=
                                            '<div class="col-lg-12 mt-1 mb-2">
                                                <h6 class="col-lg-12">Máquinário</h6>
                                                <div class="row">
                                                    <div class="input-group">  
                                                        <div class="col-sm-4 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Máquina que atendeu a OP</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['maquina'].'" type="text" class="form-control sm-4" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mt-4 mb-2">
                                                <h6 class="col-lg-12">Data/Hora de Abertura/Produção da OP</h6>
                                                <div class="row">
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Aberto</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('d/m/Y', strtotime($campo['dataHora_aberto'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">às</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('h:i:s', strtotime($campo['dataHora_aberto'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Inicio</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('d/m/Y', strtotime($campo['dataHora_producao'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">às</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('h:i:s', strtotime($campo['dataHora_producao'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>';
        
                            } else if ($campo['statusPedido'] == 3){
        
                                $datatime1 = new DateTime(''.substr($campo['dataHora_producao'], 0, 10).' '.substr($campo['dataHora_producao'], 11, 8).' America/Sao_Paulo');
                                $datatime2 = new DateTime(''.substr($campo['dataHora_fechado'], 0, 10).' '.substr($campo['dataHora_fechado'], 11, 8).' America/Sao_Paulo');
        
                                $data1  = $datatime1->format('Y-m-d H:i:s');
                                $data2  = $datatime2->format('Y-m-d H:i:s');
        
                                $diff = $datatime1->diff($datatime2);
        
                                $table .=
                                            '<div class="col-lg-12 mt-1 mb-2">
                                                <h6 class="col-lg-12">Máquinário</h6>
                                                <div class="row">
                                                    <div class="input-group col-md-12">  
                                                        <div class="col-sm-4 text-left">
                                                            <label for="nClasse" class="control-label col-form-label">Máquina que atendeu a OP</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input value="'.$campo['maquina'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-4 mb-2">                                                
                                                <h6 class="col-lg-12">Data/Hora de Abertura/Produção/Finalização da OP</h6>
                                                <div class="row">
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Inicio</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('d/m/Y', strtotime($campo['dataHora_producao'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">às</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('h:i:s', strtotime($campo['dataHora_producao'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-2">
                                                <div class="row">
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Fim</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('d/m/Y', strtotime($campo['dataHora_fechado'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">às</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.date('h:i:s', strtotime($campo['dataHora_fechado'])).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="input-group col-md-6">
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">Duração</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.$diff->format("%a dias").'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                    <div class="input-group col-md-6">  
                                                        <div class="col-sm-2 text-right">
                                                            <label for="nClasse" class="control-label col-form-label">e</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input value="'.$diff->format("%H:%I:%S").'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>';        
                            }
        
                            $table .=
                                        '<div class="col-lg-12 mt-4 mb-2">
                                            <h6 class="col-lg-12">Informação do produto</h6>
                                            <div class="row">
                                                <div class="input-group col-md-6">  
                                                    <div class="col-sm-2 text-right">
                                                        <label for="nClasse" class="control-label col-form-label">Produto</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input value="'.$campo['produto'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div> 
                                                </div>
                                                <div class="input-group col-md-3">  
                                                    <div class="col-sm-4 text-right">
                                                        <label for="nClasse" class="control-label col-form-label">Molde</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['ferramental'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div> 
                                                </div>
                                                <div class="input-group col-md-3">  
                                                    <div class="col-sm-4 text-right">
                                                        <label for="nClasse" class="control-label col-form-label">Tipo</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['tipoFerramental'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        
                            if ($campo['statusPedido'] == 1 || $campo['statusPedido'] == 2){
            
                                $table .=
                                                            '<div class="form-group row">
                                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção prevista</label>
                                                                <div class="col-sm-8">
                                                                    <input value="'.$campo['producaoPrevista'].'" id="idTipoCor" name="nTipoCor" type="number" class="form-control" style="width: 100%; height:36px;" disabled>
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
                            //$table .=''.materiais($id,1).'';                          
                            
                            $table .=
                                                            '<div>
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
                                                    
                            
                            $table .=
        
                                                       '</div>
        
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
                                                                        <input value="'.($campo['quantidadePigmento'] * $campo['producaoPrevista']).'" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
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
                                                        </div>
        
                                                        <div>
                                                            <form method="POST" action="php/savePedidos.php? validacao=U&id='.$id.'">                     
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
                }

        }

        return $table;
    }
    function modalExcluiPedido($id){
        
        $modal = '  <div class="modal fade" id="modalExclui'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Excluir Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>                       
                                <div class="modal-body">
                                    <form method="POST" action="php/saveHistorico.php?validacao=D&id='.$id.'">
                                        <h6> Confirmar esta ação?</h6>
                                        <div class="align-items=left">      
                                            <div align="right">                        
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> 
                                                    Confirmar 
                                                </button>
                                            <div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $modal;
    }    
    function modalRestauraPedido($id){        

        $modal = 
            '<div class="modal fade" id="modalRestaura'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Restaurar Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">&times;</span>
                            </button>
                        </div>                       
                        <div class="modal-body">
                            <form method="POST" action="php/savePedidos.php? validacao=R&id='.$id.'">
                                <label> Confirmar esta ação? </label>
                                <div align-items="right">
                                    <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">
                                        Confirmar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';

        return $modal;
        
    }
?>