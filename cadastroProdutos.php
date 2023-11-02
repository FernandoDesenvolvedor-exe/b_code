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
                        <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IPR">
                            <div class="card-body">
                                
                                <!-- Titulo da div -->
                                <h4 class="card-title">Produto</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do produto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iProduto" name= "nProduto" placeholder="Nome do material">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Imagem do produto</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" id="iImagem" name= "nImagem">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Descrição do ferramental</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iMolde" name= "nMolde" placeholder="Nome do material">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Tipo de ferramental</label>
                                    <div class="col-md-9">
                                        <select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <?php echo optionTipoFerramental();?>                                         
                                        </select>
                                    </div>
                                </div> 
                                
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15"  style="text-align: right;">Maquinas Compatíveis</label>
                                    <div class="col-md-9">
                                        <select id="iMaquina[]" name="nMaquina[]" multiple = 'multiple' class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <?php echo optionMaquina();?>                                         
                                        </select>
                                    </div>
                                </div>
                            </div>   
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
                            <div onClick="quantidadeMaterial();" class="col-md-9" id='qntMaterial' >
                                <select onClick="quantidadeMaterial();" id="iMateriaPrima" name="nMateriaPrima[]" class="select2 form-control m-t-15" multiple="multiple" style="width: 100%; height:36px;">
                                    <?php echo optionMaterial(1);?>
                                </select>
                            </div>
                        </div>
                        <?php 
                        
                        ?>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade Material</label>
                            <div class="col-sm-9" >
                                <input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:10%;" min="0">
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
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade Pigmento</label>
                            <div class="col-sm-9" id='qntM'>
                                
                                <!-- <input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:10%;" min="0"> -->
                                
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
                                    <button type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">Salvar</button>
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
        <script>
            function quantidadeMaterial(){
                var qntM = document.getElementById('qntM');
                var Materiais = document.getElementById('iMateriaPrima')
                cosole.log(materiais.lenght)
                //for(i=0;i<materiais.lenght)    
            }
            
        </script>
    </body>
</html>