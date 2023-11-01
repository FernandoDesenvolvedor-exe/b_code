<?php
    include('php/function.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  
    include('links/cabecalho.php');
    ?>
    <title>Cadastro Usuario</title>
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
                <form method="POST" class="form-horizontal" action= "php/saveReceita.php">
                    <div class="card-body">
                        <!-- Titulo da div -->
                        <h4 class="card-title">Receita</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Produto</label>
                            <div class="col-sm-9">
                                <select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <?php echo optionProdutos();?>                                        
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-md-3 m-t-15" style="text-align: right;">Materias Primas</label>
                            <div class="col-md-9">
                                <select id="iMateriaPrima" name="nMateriaPrima[]" class="select2 form-control m-t-15" multiple="multiple" style="width: 100%; height:36px;">
                                    <?php echo optionMaterial(1);?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 m-t-15" style="text-align: right;">Pigmento</label>
                            <div class="col-md-9">
                                <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <?php echo optionPigmento(); ?>
                                </select>
                            </div>                                    
                        </div>

                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade</label>
                            <div class="col-sm-9">
                                
                                <input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:10%;" min="0">
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

    <?php include('links/script.php'); ?>
</body>
    
</html>