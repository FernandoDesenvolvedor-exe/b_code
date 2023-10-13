<?php
    include('php/function.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="dist/assets/images/logoLabPlasticos16x16.png">
    <title>Cadastro - LabPlasticos</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
   
</head>

<body>
    
    <div class="main-wrapper" >
        
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-cyan">
            <div class="auth-box bg-white border-top border-secondary">
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <p>
                            <span class="db"><img src="dist\assets\images\logoSenai300x82.jpg" alt="logo" /></span>
                        </p>
                        
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" action="php/validaCadastro.php">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <!-- User nome -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1" required>
                                    <input type="text" class="form-control form-control-lg" placeholder="Sobrenome" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <!-- senha -->
                                <div class="input-group mb-3">
                                    <!-- senha -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Senha" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <!-- confirma senha -->
                                    <input type="text" class="form-control form-control-lg" placeholder="Confirmar senha" aria-label="Password" aria-describedby="basic-addon1" required>
                                
                                </div>
                                <!-- turma -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                    
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" style="width: fiauto ;">
                                            <?php 
                                                echo listaTurmas();
                                            ?>    
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                            <button class="btn btn-block btn-lg btn-info" type="submit">Cadastrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="dist/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="dist/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="dist/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>    
</body>
</html>