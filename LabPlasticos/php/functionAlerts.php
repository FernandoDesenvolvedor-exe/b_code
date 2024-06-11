<?php 
    function alert($tipo, $titulo, $mensagem){
        
        switch($tipo){
            case 1:
                $alert='<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                            .'<div class="modal-dialog" role="document ">'
                                .'<div class="modal-content">'
                                    .'<div class="modal-header">'
                                        .'<h5 class="modal-title" id="exampleModalLabel">'.$titulo.'</h5>'
                                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                            .'<span aria-hidden="true ">&times;</span>'
                                        .'</button>'
                                    .'</div>'
                                    .'<div class="modal-body">'
                                        .$mensagem
                                    .'</div>'
                                .'</div>'
                            .'</div>'
                        .'</div>';
            case 2:
                $alert='<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
                            .'<div class="modal-dialog" role="document">'
                                .'<div class="modal-content">'
                                    .'<div class="modal-header">'
                                        .'<h5 class="modal-title" id="exampleModalLabel">'.$titulo.'</h5>'
                                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                            .'<span aria-hidden="true">&times;</span>'
                                        .'</button>'
                                    .'</div>'
                                    .'<div class="modal-body">'
                                        .$mensagem
                                    .'</div>'
                                    .'<div class="modal-footer">'
                                        .'<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>'
                                        .'<button type="submit" class="btn btn-primary">Confirmar</button>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'
                        .'</div>';
        }
        return $alert;
    }
?>