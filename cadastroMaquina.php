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

                        <!-- Cria um formulário para registrar maquinas -->                            
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=IM">
                            <div class="card-body">                                
                                <!-- Titulo da div -->
                                <h4 class="card-title">Máquina</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome da máquina</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iMaquina" name= "nMaquina" placeholder="Nome do material">
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

                    <!-- Cria um formulário para registrar Moldes -->
                    <div class="card">                        
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=IF">                            
                            
                            <div class="card-body">

                                <h4 class="card-title">Molde</h4>
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

                            </div>                             
                            
                            <div class="border-top">

                                <div class="card-body">
                                    <button type="button" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>
                                </div>     

                            </div>
                        </form>
                    </div>

                     <!-- Cria um formulário para registrar Moldes -->
                     <div class="card">                        
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=ITF">                            
                            
                            <div class="card-body">
                                
                                <h4 class="card-title">Tipo de molde</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Descrição do ferramental</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iTipoMolde" name= "nTipoMolde" placeholder="Nome do material">
                                    </div>
                                </div> 

                            </div>                             
                            
                            <div class="border-top">

                                <div class="card-body">
                                    <button type="button" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>
                                </div>     

                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=IRMF">
                            <div class="card-body">
                                <h4 class="card-title">Compatibilidade maquina/molde</h4>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Máquina</label>
                                    <div class="col-md-9">
                                        <select id="iRMaquina" name="nRMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <?php echo optionMaquina();?>                                         
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Ferramental</label>
                                    <div class="col-md-9">
                                        <select id="iRFerramental" name="nRFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <?php echo optionFerramental();?>                                         
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

                    <div class="card">

                        <!-- Cria um formulário para registrar maquinas -->                            
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=ITF">
                            
                            <div class="card-body">                                
                                <!-- Titulo da div -->
                                <h4 class="card-title">tipos de Ferramental</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Descrição do tipo de ferramental</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iTipo" name= "nTipo" placeholder="Nome do material">
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