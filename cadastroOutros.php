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
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=IF">
                            <div class="card-body">

                                <!-- Titulo da div -->
                                <h4 class="card-title">Adicionar Fornecedor</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Nome do Fornecedor</label>
                                    <div class="col-sm-9">
                                        <input id="iFornecedor" name="nFornecedor" type="text" class="form-control" placeholder="Nome do fornecedor aqui" style="width: 20%; height:36px;">
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
                    <div class="card">

                        <!-- Cria um formulário -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=iCM">
                            <div class="card-body">

                                <!-- Titulo da div -->
                                <h4 class="card-title">Adicionar Classe de material</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Nome da classe</label>
                                    <div class="col-sm-9">
                                        <input id="iClasse" name="nClasse" type="text" class="form-control" placeholder="Ex: Engenharia" style="width: 20%; height:36px;">
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

                    <div class="card">

                        <!-- Cria um formulário -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=ITM">
                            <div class="card-body">

                                <!-- Titulo da div -->
                                <h4 class="card-title">Adicionar tipo de matéria prima</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">tipo de matéria prima</label>
                                    <div class="col-sm-9">
                                        <input id="iTipoMateria" name="nTipoMateria" type="text" class="form-control" placeholder="Ex: Reciclado" style="width: 20%; height:36px;">
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

                    <div class="card">

                        <!-- Cria um formulário para adicionar um tipo de pigmento  -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=ITP">
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