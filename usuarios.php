<?php
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
                <div class="container-fluid" >

                    <div class="card" style="padding:10px;">

                        <h4 class="card-title">Tabela de Usuários</h4>

                        <div style="float:right; width:30%">                        

                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddUser">
                                Novo usuário
                            </button>

                        </div>  
                    

                        <!-- MODAL NOVO PIGMENTO -->
                        <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Pigmento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"> 

                                        <div class="auth-wrapper d-flex no-block justify-content-center align-items-start bg-white">   
                                            <div>
                                                <div class="text-center p-t-20 p-b-20">
                                                    <p>
                                                        <span class="db"><img src="assets\images\logoSenai300x82.jpg" alt="logo" /></span>
                                                    </p>
                                                    
                                                </div>
                                                
                                                <!-- Form -->
                                                <form class="form-horizontal m-t-20" method="post" action="php/validaCadastroUsuario.php? validacao=I">
                                                    <div class="row p-b-30">
                                                        <div class="col-12">
                                                            <!-- User nome -->
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control form-control-lg" name="nNome" placeholder="Nome*" aria-label="Username" aria-describedby="basic-addon1" maxlength="80" required>
                                                                <input type="text" class="form-control form-control-lg" name="nSobrenome" placeholder="Sobrenome*" aria-label="Username" aria-describedby="basic-addon1" maxlength="80" required>
                                                            </div>
                                                            
                                                            <!-- email -->
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-email"></i></span>
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
                                                                    <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                                                </div>
                                                                
                                                                <!-- confirma senha -->
                                                                <input type="password" class="form-control form-control-lg" name="nConfirmSenha" placeholder="Confirmar senha*" aria-label="Password" aria-describedby="basic-addon1" minlength="4" maxlength="32" required>
                                                            
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3">Nível de acesso:</label>
                                                                <div class="col-md-9" display="inline">
                                                                    <div class="custom-control custom-radio">
                                                                        <input value=1 type="radio" class="custom-control-input" id="idAdm" name="radioTipo" required>
                                                                        <label class="custom-control-label" for="idAdm"> Administrador </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <input value=2 type="radio" class="custom-control-input" id="idComum" name="radioTipo" required>
                                                                        <label class="custom-control-label" for="idComum"> Comum </label>
                                                                    </div>
                                                                </div>
                                                            </div>                                                    
                                                            
                                                            <!-- turma -->
                                                            <div id="idDivTurma" class="input-group mb-3 esconder">
                                                                <div class="input-group-prepend" style='width: 100%; height:100%;'>
                                                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                                                    <select id="idTurma" name='nTurma' class='select2 form-control custom-select' style='width: 100%; height:100%;'>
                                                                        <?php 
                                                                            echo optionTurmas();
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row"> <!-- border-top border-secondary -->
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="p-t-20">
                                                                    <!--<button class="btn btn-block btn-lg btn-info" type="submit">Cadastrar</button>-->
                                                                    <button type="submit" class="btn btn-block btn-lg btn-info" data-toggle="modal" data-target="#Modal2">
                                                                        Cadastrar
                                                                    </button>
                                                                    <?php 
                                                                        //echo alert(2,'Confirmar cadastro','Deseja mesmo cadastrar este usuario?');
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php
                                                    if(isset($_SESSION['msgErro']) && $_SESSION['msgErro'] != ''){  
                                                        echo $_SESSION['msgErro'];
                                                        unset($_SESSION['msgErro']);
                                                        
                                                    }   
                                                    //parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)=='error=1' -> Pega a oq tiver depois do ? na URL
                                                ?>
                                            </div>                                    
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
                                            <th> Id de Usuário </th>
                                            <th> Login </th>
                                            <th> Nome e Sobrenome </th>
                                            <th> Turma </th>
                                            <th> Turno </th>
                                            <th> Nivel de acesso </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo dataTableUser(); ?>
                                    </tbody>
                                </table>
                            </div>                         
                        </div>  
                    </div>
                </div>
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by<a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div> 

        <script>               
            
            const element1 = document.getElementById('#idAdm');
            const element2 = document.getElementById('#idComum');

            console.log(element1);

            element1.addEventListener("click", hideDiv());
            element2.addEventListener("click", showDiv());

            function showDiv() {

                document.getElementById('#idDivTurma').style.display='none';

            }
                                                    
            function hideDiv() {

                document.getElementById('#idDivTurma').style.display='block';

            }

        </script>  
        <?php include('links/script.php'); ?>
    </body>
    
</html>