<?php 
    function alert($tipo, $titulo, $mensagem){
        switch($tipo){
            case 1:
                $alert="<script>toastr.success('".$mensagem."', '".$titulo."');</script>";
            case 2:
                $alert="<script>toastr.info('".$mensagem."', '".$titulo."');</script>";
            case 3:
                $alert="<script>toastr.warning('".$mensagem."', '".$titulo."');</script>";
            case 4:
                $alert="<script>toastr.error('".$mensagem."', '".$titulo."');</script>";
        }
        return $alert;
    }

/*
________No arquivo html (tela do cadastro) colocar no final depois do include do script

<?php 
    if(isset($_SESSION['msgAlert'])){
        echo $_SESSION['msgAlert'];
        unset($_SESSION['msgAlert']);
    
    }
?>

________No arquivo de validação
[...]
if(validacao){
    //executar codigos...
}else{
    //alerta
    $_SESSION['msgAlert'] = alert(tipo, "titulo aqui", "mensagem aqui");
}


                            Encontrei no page-elements.html

                                <h5 class="card-title">Different Models</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#Modal1">
                                    View Popup
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning margin-5 text-white" data-toggle="modal" data-target="#Modal2">
                                    Alert
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#Modal3">
                                    Image Popup
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                    <div class="modal-dialog" role="document ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Popup Header</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true ">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Here is the text coming you can put also image if you want…
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Alert Model</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Lorem ipsum dolor sit amet...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Image Header</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="assets/images/background/img5.jpg" width="100% ">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>*/
?>