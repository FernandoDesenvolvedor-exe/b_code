<?php
    include('php/function.php');
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
                        
                    <div class="card" style="padding: 10px;"> 
                        <h4 class="card-title">Tabela de máquinas</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Matéria Prima</th>
                                        <th>Pigmento</th>
                                        <th>Selecionar</th>
                                        <th>Alterar</th>
                                        <th>Desativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTableReceitas($_GET['idProduto']); ?>
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
        
        <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="assets/libs/magnific-popup/meg.init.js"></script>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>