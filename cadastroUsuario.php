<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    include('php/function.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  
    include('links/cabecalho.php');
    ?>
    <title>Cadastro Usuario</title>
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

                <!-- Cria um formulário -->                            
                
            <div class="auth-box bg-dark border-secondary" style="border-width: 4px 0px 4px 0px; border-style: solid;"> <!-- border-top -->
                
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <p>
                            <span class="db"><img src="dist\assets\images\logoSenai300x82.jpg" alt="logo" /></span>
                        </p>
                        
                    </div>
                    
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" method="post" action="php/validaCadastroUsuario.php">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <!-- User nome -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="nNome" placeholder="Nome*" aria-label="Username" aria-describedby="basic-addon1" maxlength="80" required>
                                    <input type="text" class="form-control form-control-lg" name="nSobrenome" placeholder="Sobrenome*" aria-label="Username" aria-describedby="basic-addon1" maxlength="80" required>
                                </div>
                                
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" name="nEmail" placeholder="Email*" aria-label="Username" aria-describedby="basic-addon1" maxlength="50" required>
                                </div>
                                <!-- senha -->
                                <div class="input-group mb-3">
                                    <!-- senha -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="nSenha" placeholder="Senha*" aria-label="Password" aria-describedby="basic-addon1" minlength="4" maxlength="32" required>
                                </div>
                                <!-- confirma senha -->
                                <div class="input-group mb-3">
                                    <!-- senha -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    
                                    <!-- confirma senha -->
                                    <input type="password" class="form-control form-control-lg" name="nConfirmSenha" placeholder="Confirmar senha*" aria-label="Password" aria-describedby="basic-addon1" minlength="4" maxlength="32" required>
                                
                                </div>
                                <!-- turma -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" style='width: 100%; height:100%;'>
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                        <select name='nTurma' class='select2 form-control custom-select' style='width: 100%; height:100%;'>
                                            <?php 
                                                echo selectTurmas();
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                                <!-- Tipo Usuario -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" style='width: 100%; height:100%;'>
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                            <select name="nTipoUsu" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option value="">Nivel de Acesso*</option>
                                                <optgroup label="Niveis">
                                                    <option value=1>Administrador</option>
                                                    <option value=2>Comum</option>
                                                </optgroup>
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"> <!-- border-top border-secondary -->
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                            <button class="btn btn-block btn-lg btn-info" type="submit">Cadastrar</button>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        
                        if(isset($_SESSION['msgErro'])){
                            echo $_SESSION['msgErro'];
                            unset($_SESSION['msgErro']);
                        
                        }
                        //parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)=='error=1' -> Pega a oq tiver depois do ? na URL
                            
                        
                    ?>
                </div>
            </div>
            
            </div>  
        </div>

        <footer class="footer text-center">
            All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
        </footer>
    </div>
</div>
<?php include('links/script.php'); ?>

    <!--<div class="main-wrapper" >
         !-- Preloader - style you can find in spinners.css
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div> --
        !-- Login box.scss -- 
        
        <?php  
            //include('links/preloader.php');
            //include('links/menu.php');

        ?>

        <div class="page-wrapper" >
            <?php //include('links/side_bar_direita.php'); ?>
    
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            
            <div class="auth-box bg-dark border-secondary" style="border-width: 4px 0px 4px 0px; border-style: solid;"> !-- border-top --
                
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <p>
                            <span class="db"><img src="dist\assets\images\logoSenai300x82.jpg" alt="logo" /></span>
                        </p>
                        
                    </div>
                    
                    !-- Form --
                    <form class="form-horizontal m-t-20" method="post" action="php/validaCadastroUsuario.php">
                        <div class="row p-b-30">
                            <div class="col-12">
                                !-- User nome --
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="nNome" placeholder="Nome*" aria-label="Username" aria-describedby="basic-addon1" required>
                                    <input type="text" class="form-control form-control-lg" name="nSobrenome" placeholder="Sobrenome*" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                
                                !-- email --
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" name="nEmail" placeholder="Email*" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                !-- senha --
                                <div class="input-group mb-3">
                                    !-- senha --
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="nSenha" placeholder="Senha*" aria-label="Password" aria-describedby="basic-addon1" required>
                                    
                                    !-- confirma senha --
                                    
                                </div>
                                <div class="input-group mb-3">
                                    !-- senha --
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    
                                    !-- confirma senha --
                                    <input type="password" class="form-control form-control-lg" name="nConfirmSenha" placeholder="Confirmar senha*" aria-label="Password" aria-describedby="basic-addon1" required>
                                
                                </div>
                                !-- turma --
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" style='width: 100%; height:100%;'>
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                        <select name='nTurma' class='select2 form-control custom-select' style='width: 100%; height:100%;'>
                                            <?php 
                                                //echo selectTurmas();
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                                !-- Tipo Usuario --
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" style='width: 100%; height:100%;'>
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                            <select name="nTipoUsu" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option value="">Nivel de Acesso*</option>
                                                <optgroup label="Niveis">
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Comum</option>
                                                </optgroup>
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"> !-- border-top border-secondary --
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                            <button class="btn btn-block btn-lg btn-info" type="submit">Cadastrar</button>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        /*
                        if(isset($_SESSION['msgErro'])){
                            echo $_SESSION['msgErro'];
                            unset($_SESSION['msgErro']);
                        
                        }
                        //parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)=='error=1' -> Pega a oq tiver depois do ? na URL
                            
                        */
                    ?>
                </div>
            </div>
            
            
        </div>
        
    </div>
    -->
</body>
    
</html>