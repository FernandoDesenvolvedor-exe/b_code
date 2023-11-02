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
                
                <?php //include('links/side_bar_direita.php');?>

                <div class="container-fluid">    
                    
                    <!-- Start Page Content -->                    
                    <div class="card" style='height:800px; width:800px; item-align: center; align-self: center !important;'>

                        <!-- Cria um formulário -->                            
                        <form method="POST" class="form-horizontal" action= "">

                            <h1 style="text-align: center;"> <?php echo $_GET['produto']; ?> </h1>

                            <div class="card-body" style="alignt-items:middle;">

                                <div  style="text-align: center;"> 

                                    <img style='max-heigth:300px; width:300px;' src="<?php echo $_GET['img']; ?>"> 

                                </div>   

                                <br>

                                <div class="form-group row" style="align-self: center;">        

                                    <div class="col-md-9">                              

                                        <input type="number" min="50">

                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>  
                </div>

                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>