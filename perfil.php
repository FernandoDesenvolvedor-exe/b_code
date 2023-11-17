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
                    
                    <div class="card">

                        <div class="card-body">                           
                            <div class="form-group row">                                
                                <label class="card-title" for="idNome">Nome e sobrenome:</label> 
                                <div class="col-sm-9">
                                    <input type="text" style="text-align:center;" value="<?php echo $_SESSION['nome'];?>" id="idNome" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">                     
                            <div class="form-group row">
                                <label class="card-title" for="idEmail">Usuário:</label>       
                                <div class="col-sm-9">
                                    <input type="text" style="text-align:center;" value="<?php echo $_SESSION['login'];?>" id="idEmail" disabled/>
                                </div>
                            </div>
                        </div>

                        <?php if($_SESSION['tipo'] == 1){?>
                            
                            <div class="card-body">                     
                                <div class="form-group row">
                                    <label class="card-title" for="idTurma">Nível de acesso:</label>       
                                    <div class="col-sm-9">
                                        <input type="text" style="text-align:center;" value="Administrador" id="idTurma" disabled/>
                                    </div>
                                </div>
                            </div>

                        <?php } else {?>

                            <div class="card-body">                     
                                <div class="form-group row">
                                    <label class="card-title" for="idTurma">Turma:</label>       
                                    <div class="col-sm-9">
                                        <input type="text" style="text-align:center;" value="<?php echo $_SESSION['turma'];?>" id="idTurma" disabled/>
                                    </div>
                                </div>
                            </div> 

                            <div class="card-body">                     
                                <div class="form-group row">
                                    <label class="card-title" for="idTurno">Turma:</label>       
                                    <div class="col-sm-9">
                                        <input type="text" style="text-align:center;" value="<?php echo $_SESSION['turno'];?>" id="idTurno" disabled/>
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="card-body">                     
                                <div class="form-group row">
                                    <label class="card-title" for="idTurma">Nível de acesso:</label>       
                                    <div class="col-sm-9">
                                        <input type="text" style="text-align:center;" value="Usuário comum" id="idTurma" disabled/>
                                    </div>
                                </div>
                            </div>
                        <?php }?>   

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