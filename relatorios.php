<?php
    include('php/function.php');
    include('links/loginSession.php');

    if (isset($_SESSION['user']) == 0){

        alert(1,'Acesso negado!','Tentativa de acesso ilegal!');
        
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

                    <div class="card p-3 align-items-left">
                        <h4 class="card-title">Menu de Relatórios</h4>

                        <div class="form-group row">
                            <label class="col-md-3">Radio Buttons</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoAberto" name="radio-stacked" value="1" required="">
                                    <label class="custom-control-label" for="customControlValidation1">Em aberto</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoAndamento" name="radio-stacked" value="2" required="">
                                    <label class="custom-control-label" for="customControlValidation2">Em andamento</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoConcluido" name="radio-stacked" value="3" required="">
                                    <label class="custom-control-label" for="customControlValidation3">Concluidos</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoDesativado" name="radio-stacked" value="4" required="">
                                    <label class="custom-control-label" for="customControlValidation3">Deletados</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" hidden>
                            <label>Histórico de produção</label>
                            <div class="input-group mb-3">                                
                                <label>Concluidos em:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <label>Até: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>                      

                        <button id="iTableMauquinas" type=button class="btn btn-info margin-5" style="width: 150px;">
                            Consulta
                        </button>                        
                    </div>   
                        
                    <div class="card-body d-none">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pigmento</th>
                                        <th>Fornecedor</th>
                                        <th>Codigo</th>
                                        <th>Lote</th>
                                        <th>Tipo</th>
                                        <th>Quantidade</th>
                                        <th>Observações</th>
                                        <th>Alterar/Desativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTablePigmento(); ?>
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

        <script>

            function createTable(num){

                if(num == 1){
                    
                    <?php include('php/listaMaquinas'); ?>

                } else if(num == 2){

                    <?php include('php/listaMaquinas'); ?>

                } else if(num == 3){
                    
                    <?php include('php/listaMaquinas'); ?>

                }
               
            }
        </script>
    </body>
</html>