<?php
    include('php/function.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
    <head>
        <?php include('links/cabecalho.php');?>  
        
        <style>
            .modal .modal-dialog { width: 60%; } 
        </style>
    </head> 
    
    <body>

        <div id="main-wrapper">  

            <?php include('links/preloader.php');?> 

            <?php  include('links/menu.php');?>     

            <div class="page-wrapper">      
                
                <?php include('links/side_bar_direita.php');?>

                <div class="container-fluid">    
                    
                    <!-- Start Page Content -->                    
                    <div class="card" style="padding: 10px;">                             
                    
                        <div>
                            <div>                                
                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddProduto">
                                    Novo produto/molde
                                </button>

                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddMaquina">
                                    Nova máquina
                                </button>                                 
                            </div>                            
                        </div> 
                    
                    </div>

                    <!-- MODAL NOVO PRODUTO/MOLDE -->
                    <div class="modal fade" id="modalAddProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal fade" id="modalAddTipoFerramental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                        <div class="modal-dialog" role="document ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true ">&times;</span>
                                                    </button>
                                                </div>                                    
                                                <div class="modal-body">
                                                    <!-- Cria um formulário para registrar um ferramental -->
                                                    <div class="card" style="alignt-items: left; width: 800px !important;">  
                                                        <h4 class="card-title">Tipo de Ferramental</h4>                      
                                                    
                                                        <form method="POST" class="form-horizontal" action= "php/saveProdutos.php?validacao=ITF">        
                                                            
                                                            <div class="card-body">                                                                
                                                                <div class="form-group row">                                                                                                                                     
                                                                    <div class="col-sm-9">
                                                                        <label>Descrição do tipo de ferramental</label>  
                                                                        <br>
                                                                        <input type="text" class="form-control" id="iTipoMolde" name= "nTipoMolde">
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
                                            </div>
                                        </div>                                
                                    </div> 

                                    <form method="POST" class="form-horizontal"  enctype="multipart/form-data" action= "php/saveProdutos.php? validacao=IPF">
                                        <div class="card-body">
                                            
                                            <h4 class="card-title">Produto e molde</h4>

                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do produto</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="iProduto" name= "nProduto" placeholder="Nome do material">
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Imagem do produto</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="iImagem" name="nImagem" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Descrição do ferramental</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="iMolde" name= "nMolde" placeholder="Nome do material">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Peso</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="iQtd" name= "nQtd" placeholder="Peso do material em gramas + peso do canal">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Tipo de ferramental</label>
                                                <div class="col-md-9">
                                                    <select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <?php echo optionTipoFerramental();?>                                         
                                                    </select>
                                                </div>

                                                <button style="width: 150px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddTipoFerramental">
                                                    Adicionar tipo de ferramental
                                                </button>
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

                                        <div class="border-top">
                                            <div class="card-body">
                                                <button type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">Salvar</button>
                                            </div>                      
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                                
                    </div>  

                    <!-- MODAL ADD MAQUINA-->
                    <div class="modal fade" id="modalAddMaquina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>                                    
                                <div class="modal-body">

                                    <!-- Cria um formulário para registrar maquinas -->                            
                                    <form method="POST" class="form-horizontal" action= "php/saveProdutos.php? validacao=IM">
                                        <div class="card-body">                                
                                            <!-- Titulo da div -->
                                            <h4 class="card-title">Máquina</h4>
                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome da máquina</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="iMaquina" name= "nMaquina" placeholder="Ex: máquina">
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Observações</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id= "iMObservacoes" name="nMObservacoes" placeholder="Campo não obrigatório"></textarea>
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
                        </div>
                    </div>                     

                    <div class="card" style="padding: 10px;"> 

                        <h4 class="card-title">Tabela de produtos</h4>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Peso</th>
                                        <th>Molde</th>
                                        <th>Tipo de molde</th>
                                        <th>Alterar/Desativar cadastro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTableProduto(); ?>
                                </tbody>
                            </table>
                        </div>   
                    </div>     

                    <div class="card" style="padding: 10px;"> 

                        <h4 class="card-title">Tabela de máquinas</h4>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome da máquina</th>
                                        <th>Alterar/Desativar cadastro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTableMaquina(); ?>
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

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>