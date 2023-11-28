<?php 
    function modalExcluiPedido($campo){
        $modal = '';
        
        $modal .= '<div class="modal fade" id="modalExclui'.$campo.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
            <div class="modal-dialog" role="document ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Desativar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">&times;</span>
                        </button>
                    </div>                       
                    <div class="modal-body">
                        <form method="POST" action="php/savePedidos.php? validacao=D&id='.$campo.'">
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

    
    function modalRestauraPedido($campo){        

        $modal .= 
            '<div class="modal fade" id="modalRestaura'.$campo.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Restaurar Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">&times;</span>
                            </button>
                        </div>                       
                        <div class="modal-body">
                            <form method="POST" action="php/savePedidos.php? validacao=R&id='.$campo.'">
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
    }
?>

                                
                                
                               <!-- 

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

                                     -->