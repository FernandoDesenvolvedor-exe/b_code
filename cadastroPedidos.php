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
                        <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IMP">
                            <div class="card-body">
                                
                                <!-- Titulo da div -->
                                <h4 class="card-title">Pedido</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do material</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iDescricao" name= "nDescricao" placeholder="Nome do material">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Classe do material</label>
                                    <div class="col-md-9">
                                        <select id="iClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <?php echo optionClaseMaterial();?>                                         
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Tipo de matéria prima</label>
                                    <div class="col-md-9">
                                        <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <?php echo optionTipoMaterial();?>
                                        </select>
                                    </div>                                    
                                </div>

                                <div style="align-itens= side;"  class="form-group row">
                                    <label for="email1" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                    <div style="display:inline;" class="col-sm-9">
                                        <select id="iFornecedor" name="nFornecedor" class="select2 form-control custom-select" style="width: 100%; height:36px;">                                           
                                            <?php echo fillSelectFornecedor();?>                                                                                 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade</label>
                                    <div class="col-sm-9">
                                        <input id="iQuandtidade" name="nQuandtidade" type="text" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade em gramas" style="width= 10%;">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea>
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