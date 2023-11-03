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

                        <div>

                        </div>

                            <div style="float:right; width:30%">

                                <button style="width: 150px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddMaquina">
                                    Nova máquina
                                </button>

                                <button style="width: 150px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#relacaoMoldeMaquina">
                                    Nova relação entre máquina e molde
                                </button>

                            </div>                   

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
                                            <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IRMF">
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
                                    </div>
                                </div>
                            </div>

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
                                            <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IM">
                                                <div class="card-body">                                
                                                    <!-- Titulo da div -->
                                                    <h4 class="card-title">Máquina</h4>
                                                    <div class="form-group row">
                                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome da máquina</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="iMaquina" name= "nMaquina" placeholder="Nome do material">
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