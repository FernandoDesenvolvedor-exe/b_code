<?php 

    function modalExcluiPedido(){
        
        $modal = '  <div class="modal fade" id="modalExclui'.$_SESSION['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Excluir Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>                       
                                <div class="modal-body">
                                    <form method="POST" action="php/saveHistorico.php?validacao=D&id='.$_SESSION['idPedido'].'">
                                        <h6> Confirmar esta ação?</h6>
                                        <div align-items="right">   
                                            <label>Uma vez deletado desta tabela, não haverá como recuperar o regsitro!</label>                             
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

    
    function modalRestauraPedido(){        

        $modal = 
            '<div class="modal fade" id="modalRestaura'.$_SESSION['idPedido'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Restaurar Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true ">&times;</span>
                            </button>
                        </div>                       
                        <div class="modal-body">
                            <form method="POST" action="php/savePedidos.php? validacao=R&id='.$_SESSION['idPedido'].'">
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