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
                    <div>
                        <button type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido">
                            Selecionar
                        </button>
                    </div>
                    
                    <button type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#ExcluiModal">
                        Desativar
                    </button>                             

                    <div class="modal fade" id="ExcluiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>                            
                                <div class="modal-body">
                                    <form method="POST" action="php/savePedidos.php?>
                                        <label> Confirmar esta ação? </label>
                                        <div align-items="right">
                                            <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>

                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div>

        <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="assets/libs/magnific-popup/meg.init.js"></script>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>