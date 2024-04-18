<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include('php/function.php');

    if (isset($_SESSION['user']) == 0){

        //alert(1,'Acesso negado!','Tentativa de acesso ilegal!');
        
        header('location: login');

    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
    <head>
        <?php include('links/cabecalho.php');?>   
    </head> 
    
    <body>

        <div id="main-wrapper">  

            <?php //include('links/preloader.php');?> 

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
                            <a href="cadastroReceitas.php?idProduto=<?php echo $_GET['idProduto']?>&pr=<?php echo $_GET['pr']?> ">
                                <button style="width: auto; border-radius: 5px;" class="btn btn-info margin-5" type="button">
                                        Adicionar Receita
                                </button>
                            </a>
                            <?php
                                if(isset($_SESSION['msgErro'])){
                                    echo $_SESSION['msgErro'];
                                    unset($_SESSION['msgErro']);
                                }
                            ?>

                        </div>
                    </div>
                    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
                    <div class="card" style="padding: 10px;"> 
                        <h4 class="card-title">Receitas de <?php echo $_GET['pr']?></h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Matéria Prima</th>
                                        <th>Pigmento</th>
                                        <th>Selecionar/Desativar/Ativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo dataTableReceitas($_GET['idProduto'],$_GET['pr']); ?>
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

        

        <script>
            /*
            var select = document.getElementById('#idStatus');

            //document.getElementById('#idStatus').addEventListener("click", function(){         });

            if(select.value == 1){

                var div = document.getElementById('#divMaquina');

                div.style.display = none;

            } else {

                var div = document.getElementById('#divMaquina');

                div.style.display = block;

            }*/
            $('document').ready(function(){
                
            })

        </script>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>