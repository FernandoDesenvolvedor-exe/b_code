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

                    <div>                        

                        <button for="idVoltarBtn" id="idVoltarBtn" class='btn btn-primary'>
                            <a style="color: white;" href="pedidos.php">
                                Voltar
                            </a>
                        </button>
                        
                    </div>
                        
                    <br>

                    <div class="card" style="padding: 10px;">
                        <div>
                            <?php 
                                $_SESSION['idProduto'] = $_GET['idProduto'];
                                $_SESSION['nomeProduto'] = $_GET['pr'];
                                //idProduto=<?php echo $_GET['idProduto']?&pr=?php echo $_GET['pr']?
                            ?>
                            <a href="cadastroReceitas.php? ">
                                <button style="width: auto; border-radius: 5px;" class="btn btn-info margin-5" type="button">
                                        Adicionar Receita
                                </button>
                            </a>

                        </div>
                    </div>

                    <div class="card" style="padding: 10px;"> 
                        <h4 class="card-title">Receitas de <?php echo $_SESSION["nomeProduto"]?></h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Matéria Prima</th>
                                        <th>Pigmento</th>
                                        <th>Selecionar/Desativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTableReceitas($_SESSION['idProduto']); ?>
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
        
        <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="assets/libs/magnific-popup/meg.init.js"></script>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>