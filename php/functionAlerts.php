<?php 
    function alert($tipo, $titulo, $mensagem1,){
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
                                        .$mensagem1
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
                                        Lorem ipsum dolor sit amet...
                                    .'</div>'
                                    .'<div class="modal-footer">'
                                        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
                                        '<button type="button" class="btn btn-primary">Save changes</button>'
                                    .'</div>'
                                .'</div>'
                            .'</div>'
                        .'</div>';
            case 3:
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
        }
        return $alert;
    }

/*<!-- Button trigger modal -->
1
<button type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#Modal1">
    View Popup
</button>

2
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning margin-5 text-white" data-toggle="modal" data-target="#Modal2">
    Alert
</button>

3
<!-- Button trigger modal -->
<button type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#Modal3">
    Image Popup
</button>
*/

/*
1
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

2
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

3
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
</div>
*/
?>