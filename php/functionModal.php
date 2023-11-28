<?php 
    function modalExcluiPedido($campo){
        
        $modal = '<div class="modal fade" id="modalExclui'.$campo.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
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

        $modal = 
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
?>