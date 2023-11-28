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
                    
                    <h1 style="text-align:center;">Selecione um produto</h1>   
                        
                    <div style="display: inline !important;">

                        <?php echo cardProduto();?>

                    </div>              

                </div>
                <!--
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer> -->
            </div>
        </div>
        
        <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="assets/libs/magnific-popup/meg.init.js"></script>

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