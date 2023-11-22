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

                    <div class="card p-3">
                        <h4 class="card-title">Menu de Relatórios</h4>

                        <div class="card-body">
                            <label>Histórico de produção</label>
                            <div class="input-group mb-3">                                
                                <label>De: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <label>Até: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="card-body">
                            
                        </div>                       

                        <button id="iTableMauquinas" type=button class="btn btn-info margin-5" style="width: 150px;">
                            Consulta
                        </button>                        
                    </div>
                    <!-- Start Page Content -->                    
                    <div class="card" style="padding: 10px;">  

                        <div id="iDataTableMaquina" class="card" style="padding: 10px;" aria-hidden=""> 
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead> <!--PRODUÇÃO POR HR - UTILIZADO EM QUAIS PEDIDOS - QUANDO - POR QUEM -->
                                        <tr>
                                            <th>Máquinas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo dataTablePedido(); ?>
                                    </tbody>
                                </table>
                            </div>                         
                        </div>

                        <div class="card" style="padding: 10px;" aria-hidden=""> 
                            <div class="table-responsive">
                                <table id="iDataTableMaquina" class="table table-striped table-bordered">
                                    
                                </table>
                            </div>                         
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