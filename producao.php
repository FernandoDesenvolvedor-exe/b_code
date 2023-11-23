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

                    <!-- Start Page Content -->                    
                    <div class="card" style="padding: 10px;">  

                        <h4 class="card-title">Monitoramento de Pedidos</h4>
                                    
                        <div>   
                            <a href="pedidos.php">
                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5">
                                    Novo Pedido
                                </button>         
                            </a>                                          
                        </div> 

                        <div class="card" style="padding: 10px;"> 

                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produto</th>
                                            <th>Matéria Prima</th>
                                            <th>Pigmento</th>
                                            <th>Aberto em</th>
                                            <th>Status de produção</th>
                                            <th>Alterar/Desativar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo dataTablePedido(); ?>
                                    </tbody>
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
            /****************************************
            *       Basic Table                   *
            ****************************************/
            $('#zero_config').DataTable();
        </script> 
    </body>
</html>