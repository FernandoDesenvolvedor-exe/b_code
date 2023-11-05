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

                    <div class="card">

                        <!-- Cria um formulário para adicionar um tipo de pigmento  -->
                        <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=ITP">
                            <div class="card-body">

                                <!-- Titulo da div -->
                                <h4 class="card-title">Adicionar tipo de pigmento</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">tipo de pigmento</label>
                                    <div class="col-sm-9">
                                        <input id="iTipoPigmento" name="nTipoPigmento" type="text" class="form-control" placeholder="Ex: MTB" style="width: 20%; height:36px;">
                                    </div>
                                </div>  
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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