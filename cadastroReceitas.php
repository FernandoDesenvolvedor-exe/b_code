<?php
    include('php/function.php');  
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }  
    $_SESSION['tipo'] = 1;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  
    include('links/cabecalho.php');
    ?>
    <title>Cadastro Receita</title>
</head>

<body>

<div id="main-wrapper">  
    <?php include('links/preloader.php');?> 
    <?php  include('links/menu.php');?>    
    <div class="page-wrapper">      
        <?php include('links/side_bar_direita.php');?>
        <div class="container-fluid"> 
            <button for="idVoltarBtn" id="idVoltarBtn" class='btn btn-primary'>
                <a style="color: white;" href="receitas.php? idProduto=<?php echo $_GET['idProduto']?>&pr=<?php echo $_GET['pr']?>">
                    Voltar
                </a>
            </button>
            <br>
            
            <!-- AQUI ESTA A GET COM O ID DO PRODUTO $_GET['idProduto'] -->

            <!-- Start Page Content -->                    
            <div class="card">
                <!-- Cria um formulário -->                            
                <form method="POST" class="form-horizontal" action= "php/saveReceita.php " ><!-- idProduto=<?php //echo $_GET['idProduto']?> "php/saveReceita.php" -->
                    <div class="card-body">
                        <!-- Titulo da div -->
                        <h4 class="card-title">Receita</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Produto</label>
                            <div class="col-sm-9">
                                <select id="iProduto" name="nProduto" class="select2 form-control custom-select" style="width: 100%; height:36px;" disabled>
                                    <?php echo optionProdutos($_GET['idProduto']);?>
                                </select>
                            </div>
                        </div>
                        <!-- Table Materiais -->
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Materiais</label>
                            <div class="col-sm-9">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <!-- Main Table -->
                                            <tr>
                                                <th>
                                                    <label class="customcheckbox m-b-20">
                                                        <input type="checkbox" id="mainCheckbox" />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                <th scope="col">Material</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Classe</th>
                                                <th scope="col">Quantidade</th>
                                            </tr>
                                        </thead>
                                        <!-- Opções/Materiais -->
                                        <tbody class="customtable">
                                        <?php
                                            include('links/tabelaMateriais.php');
                                        ?> 
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                                
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 m-t-15" style="text-align: right;">Pigmento</label>
                            <div class="col-md-9">
                                <select id="iPigmento" name="nPigmento" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <?php echo optionPigmento(); ?>
                                </select>
                            </div>                                    
                        </div>

                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade Pigmento</label>
                            <div class="col-sm-9" id='qntM'>
                                
                               <input step="5" id="iQuantPigmento" name="nQuantPigmento" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:25%;" min="0">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea>
                            </div>
                        </div>
                    </div> 
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">Salvar</button>
                        </div>                      
                    </div>
                </form>
            </div>  
        </div>

        <footer class="footer text-center">
            All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
        </footer>
    </div>
</div>

    <?php include('links/script.php'); ?>
    
</body>
    
</html>