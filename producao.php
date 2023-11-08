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
                                    
                        <div>
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddMaterial">
                                Nova Materia Prima
                            </button>         
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddTipo">
                                Novo Tipo de Material
                            </button>         
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddClasse">
                                Nova Classe de Material
                            </button>                                           
                        </div> 
                    </div>

                    <!-- MODAL NOVA CLASSE DE MATÈRIA PRIMA -->
                    <div class="modal fade" id="modalAddClasse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de uma classe de material</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL NOVO TIPO DE MATÈRIA PRIMA -->
                    <div class="modal fade" id="modalAddTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de um tipo de material</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- NOVA MATÈRIA PRIMA -->
                    <div class="modal fade" id="modalAddMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">       

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="padding: 10px;"> 

                        <h4 class="card-title">Tabela de máquinas</h4>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id da ordem de produção</th>
                                        <th>Produto</th>
                                        <th>Aberto em</th>
                                        <th>Horas</th>
                                        <th>Fechado em:</th>
                                        <th>Horas</th>
                                        <th>Status</th>
                                        <th>Alterar/Desativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTablePedido(); ?>
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