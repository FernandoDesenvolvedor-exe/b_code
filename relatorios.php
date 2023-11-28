<?php
    session_start();
    include('php/function.php');

    if (isset($_SESSION['user']) == 0){

        //alert(1,'Acesso negado!','Tentativa de acesso ilegal!');
        
        header('location: login');

    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
    <head>
        <?php include('links/cabecalho.php');?>   
    </head> 
    
    <body>

        <div id="main-wrapper">

            <?php include('links/preloader.php');?>

            <?php  include('links/menu.php');?>

            <div class="page-wrapper">
                
                <?php include('links/side_bar_direita.php');?>

                <div class="container-fluid">

                    <div class="modal fade" id="modalAvancado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog modal-lg" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filtros avançados</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pre-scrollable">
                    
                                    <div class="card">
                                        
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-5 text-align-left">
                                                    <label class="m-t-10">Usuário</label>
                                                    <select id="idUsuario" name="nUsuario" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <div class="col-md-3 text-align-left">
                                                    <label class="m-t-10">Máquina:</label>
                                                    <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>


                                                <div class="col-md-4">
                                                    <label class="m-t-10">Produto:</label>  
                                                    <select id="idProduto" name="nProduto" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <br>
                                                
                                                <div class="col-md-4">
                                                    <label class="m-t-10">Material:</label>
                                                    <select id="idMaterial" name="nMaterial" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label class="m-t-10">Classe do material:</label>
                                                    <select id="idClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label class="m-t-10">Tipo de Material:</label>
                                                    <select id="idTipoMaterial" name="nTipoMaterial" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="card-body d-flex flex-row align-items-left">
                                            
                                            <div class="card-body col-sm-6">                       
                                                <h4 class="card-title">Organizar ordens de produção por:</h4>
                                                <div class="d-flex flex-row align-items-left m-3">
                                                    <div class="m-1 mr-4">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-2" id="idAberto" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idDataAberto">Em aberto</label>
                                                        </div>
                                                            <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-4" id="idAndamento" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idAndamento">Em andamento</label>
                                                        </div>
                                                    </div>
                                                    <div class="m-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-3" id="idConcluido" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idConcluido">Concluidos</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-3" id="idDesativado" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idDesativado">Desativados</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body col-sm-6">
                                                <div>                                    
                                                    <h4 class="card-title">Periodo:</h4>
                                                </div>                                   
                                                <div class="input-group">
                                                    <label class="col-sm-3">De:</label>
                                                    <div class="col-sm-9">
                                                        <input id="idDataInicio" name="nDataInicio" type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <label class="col-sm-3">Até:</label>
                                                    <div class="col-sm-9">
                                                        <input id="idDataFim" name="nDataFim" type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>                                                                     
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">   

                        <div class="p-3">
                            <h3 class="card-title">Menu de Relatórios</h3>
                        </div>    

                        <div class="d-flex flex-row align-items-center">
                            <div class="card-body">
                                <div>                                    
                                    <h4 class="card-title">Organizar ordens de produção por:</h4>
                                </div>
                                <div class="d-flex flex-row align-items-left m-3">
                                    <div class="m-1 mr-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-2" id="idAberto" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idAberto">Em aberto</label>
                                        </div>
                                            <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-4" id="idAndamento" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idAndamento">Em andamento</label>
                                        </div>
                                    </div>
                                    <div class="m-1 ml-4">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-3" id="idConcluidos" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idConcluidos">Concluidos</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-3" id="idDesativados" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idDesativados">Desativados</label>
                                        </div>
                                    </div>
                                </div>
                            </div>    

                            <div class="card-body">  
                                <div>                                    
                                    <h4 class="card-title">Periodo:</h4>
                                </div>                                   
                                <div class="input-group">
                                    <label>De:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <label>Até: </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>                          
                            </div> 
                            
                            <div class="card-body">
                                <div class="form-group row m-3">                                    
                                    <button style="width: 150px; height:36px; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAvancado">
                                        Avançado
                                    </button> 
                                </div>

                                <div class="form-group row m-3">
                                    <button id="iConsulta" type=button class="btn btn-info margin-5" style="width: 150px; height:36px; border-radius: 5px;">
                                        Consulta
                                    </button> 
                                </div> 
                            </div>
                        </div>
                        
                    </div> 

                    <div class="card p-3">        
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID do Pedido</th>
                                        <th>Autor</th>
                                        <th>Produto</th>
                                        <th>Máquina</th>
                                        <th>Status do pedido</th>
                                        <th>Matéria(s) Prima(s)</th>
                                        <th>Alterar/Restaurar/Desativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTableHistorico(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                </div>
                
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> 

        <script>
            $('#zero_config').DataTable();
        </script> 

        <script>
            
            //***********************************//
            // For select 2
            //***********************************//
            $(".select2").select2();

            /*colorpicker*/
            $('.demo').each(function() {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    position: $(this).attr('data-position') || 'bottom left',

                    change: function(value, opacity) {
                        if (!value) return;
                        if (opacity) value += ', ' + opacity;
                        if (typeof console === 'object') {
                            console.log(value);
                        }
                    },
                    theme: 'bootstrap'
                });

            });
            /*datwpicker*/
            jQuery('.mydatepicker').datepicker();
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

        </script>

        <script>
            $( document ).ready(function() {

                const checkData = document.getElementById('#idCheckData');

                checkData.addEventListener('click', showDiv());

                function showDiv(){
                    if(document.getElementById('#idCheckData').checked){
                        
                        $ ('#idDivData').show();

                    } else {

                        $ ('#idDivData').hide();

                    }
                }              

            });
        </script>
    </body>
</html>