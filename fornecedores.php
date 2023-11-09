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
                    <div class="card" style="padding: 10px;"> 

                        <h4 class="card-title">Fornecedores Registrados</h4>

                        <div>
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddFornecedor">
                                Novo Fornecedor
                            </button>

                        </div>

                        <!-- MODAL NOVO FORNECEDOR -->
                        <div class="modal fade" id="modalAddFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de uma classe de material</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">                   

                                        <div class="card">
                                            <!-- Cria um formulário -->
                                            <form method="POST" class="form-horizontal" action= "php/saveFornecedor.php? validacao=I&pg=M">
                                                <div class="card-body">

                                                    <!-- Titulo da div -->
                                                    <h4 class="card-title">Adicionar Fornecedor</h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <input style="width:100%;" id="iFornecedor" name="nFornecedor" type="text" class="form-control" placeholder="Nome do fornecedor aqui" style="width: 20%; height:36px;" required>
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
                                </div>
                            </div>
                        </div>

                        <div class="card" style="padding: 10px;"> 

                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome do Fornecedor</th>  
                                            <th>Alterar/Desativar</th>                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo dataTableFornecedor(); ?>
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