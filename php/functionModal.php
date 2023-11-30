<?php 

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