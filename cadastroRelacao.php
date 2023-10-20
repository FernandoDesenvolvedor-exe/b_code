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
                    
                    <!-- Start Page Content -->                    
                    <div class="card">
                        <!-- Cria um formulário -->                            
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=IR">
                            <div class="card-body">
                                
                                <!-- Titulo da div -->
                                <h4 class="card-title">Selecionar compatibilidade entre pigmentos e materiais</h4>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Pigmento</label>
                                    <div class="col-md-9">
                                        <select id="iPigmento" name="nPigmento" class="select2 form-control m-t-15" style="width: 100%; height:36px;">
                                            <?php echo fillSelectPigmento(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Matéria(s) prima(s) não compatível(eis)</label>
                                    <div class="col-md-9">
                                        <select id="iMateriaPrima" name="nMateriaPrima[]" class="select2 form-control m-t-15" multiple="multiple" style="width: 100%; height:36px;">
                                            <?php echo fillSelectMateriaPrima();?>
                                        </select>
                                    </div>
                                </div>

                            </div>                            
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>
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