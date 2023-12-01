<?php
    //inclui o arquivo function.php ao login, assim usando as demais funções presentes nelas
    include("php/function.php");

    session_start();   
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('links/cabecalho.php');?>   
    </head>
    
    <body>
        <div class="main-wrapper">
            
            <?php include('links/preloader.php');?> 
            
            <!-- Login box.scss -->            
            <div class="auth-wrapper d-flex no-block justify-content-center bg-cyan align-items-center">
                <div class="auth-box bg-blue border-top border-secondary">
                    <div id="loginform">
                        <div class="text-center p-t-20 p-b-20">
                            <img src="assets/images/logoSenai300x82.jpg" alt="logo"/>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <!-- Form -->
                        <form class="form-horizontal m-t-20" id="loginform" method="POST" action="php/validaLogin.php">
                            <div class="row p-b-30">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="idLogin" name="nLogin" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" id="idSenha" name="nSenha" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-12">
                                    <div class="form-group">
                                            <div class="p-t-20">                                        
                                                <button class="btn btn-info float-right" type="submit">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <p>
                                    <?PHP 
                                    if(isset($_SESSION['msgLogin']) && $_SESSION['msgLogin'] != ''){  
                                        echo $_SESSION['msgLogin'];
                                        unset($_SESSION['msgLogin']);
                                        
                                    }
                                    ?> 
                                </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>

        <script>

            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
            // ============================================================== 
            // Login and Recover Password 
            // ============================================================== 
            $('#to-recover').on("click", function() {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });
            $('#to-login').click(function(){
                
                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        </script>
    </body>
</html>