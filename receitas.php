<?php
    include('php/function.php');
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
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
                <form method="POST" class="form-horizontal" action= "" ><!-- "php/saveReceita.php" -->
                    <div class="card-body">
                        <!-- Titulo da div -->
                        <h4 class="card-title">Receita</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Produto</label>
                            <div class="col-sm-9">
                                <select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <?php echo optionProdutos();?>
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
                                            include('php/connection.php');
                                            $sql = "SELECT mat.idMateriaPrima as id, mat.descricao as nome,"
                                                ." tipo.descricao as tipos," 
                                                ." class.descricao as classe"
                                                ." FROM materia_prima as mat"
                                                ." LEFT JOIN tipo_materia_prima as tipo"
                                                ." ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima"
                                                ." LEFT JOIN classe_material as class"
                                                ." ON mat.idClasse = class.idClasse"
                                                ." WHERE mat.ativo = 1;";
                                            $result = mysqli_query($conn,$sql);
                                            mysqli_close($conn);
                                            //if(isset($_SESSION['opMateriais']) && $_SESSION['opMateriais'] == ''){  
                                                //echo $_SESSION['opMateriais'];
                                               // unset($_SESSION['opMateriais']);
                                                
                                            //}
                                            if(mysqli_num_rows($result) > 0){
                                                //Cria e inicializa uma array 
                                                $array = array();
                                    
                                                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                    array_push($array, $linha);
                                                }
                                                $vet = [];
                                                foreach($array as $campo){   
                                                    echo    '<tr>
                                                                <th>
                                                                    <label class="customcheckbox">
                                                                        <input value='.$campo['id'].' name="tableMateriais[]" type="checkbox" class="listCheckbox" />
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </th>
                                                                <td>'.$campo['nome'].'</td>
                                                                <td>'.$campo['tipos'].'</td>
                                                                <td>'.$campo['classe'].'</td>
                                                                <td>1200'
                                                                //<input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:50%;" min="0">
                                                                .'</td>
                                                            </tr>'; 
                                                            $vet.append($campo['id']);                
                                                }
                                                
                                                    //$vet = [];
                                                    //$vet = $_SESSION['materiais'];
                                                    //$vet = $vet.append($campo['id']);
                                                    $_SESSION = $vet;
                                                    echo $_SESSION['materiais'];
                                                
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="card-body">
                                        <!-- Botão Adicionar -->
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal_Adcionar">
                                            Adcionar
                                        </button>
                                        <!-- Botão Alterar -->
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modal_Alterar">
                                            Alterar
                                        </button>
                                        <!-- Botão Excluir -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal2">
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        <!-- -----------Modal_Adicionar-------------------------------------------------------------------------------------------------------------- -->
                        <div class="modal fade" id="Modal_Adcionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Material</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 m-t-15" style="text-align: right;">Materias Primas</label>
                                            <div class="col-sm-9">
                                                <select id="iTipoFerramental" name="nTipoFerramental" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                <?php echo optionMaterial(1);?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade Material</label>
                                            <div class="col-sm-9">
                                                <input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:50%;" min="0">
                                            </div>
                                        </div>
                                        <label> 
                                            <?php 
                                                echo $_GET['tableMateriais[]'];
                                                //if(isset($_SESSION['opMateriais']) && $_SESSION['opMateriais'] == ''){  
                                                    //echo $_SESSION['opMateriais'];
                                                   // unset($_SESSION['opMateriais']);
                                                    
                                                //}
                                            
                                            ?>
                                        </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -----------Modal_Alterar------------------------------------------------------------------------------------------------------ -->
                        <h4 class="card-title">Alterar</h4>
                        <div class="modal fade" id="Modal_Alterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar Material</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label"></label>
                                        <h4 class="card-title">Materia Prima - <?php  ?> </h4>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade Material</label>
                                        <div class="col-sm-9">
                                            <input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:50%;" min="0">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -----------Modal-Excluir------------------------------------------------------------------------------------------------------ -->
                        <?php
                        
                        ?>
                        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
                        <div class="form-group row">
                            <label class="col-md-3 m-t-15" style="text-align: right;">Pigmento</label>
                            <div class="col-md-9">
                                <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <?php echo optionPigmento(); ?>
                                </select>
                            </div>                                    
                        </div>

                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade Pigmento</label>
                            <div class="col-sm-9" id='qntM'>
                                
                                <!-- <input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:10%;" min="0"> -->
                                
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
                            <button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>
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
    <script>
        function GetCheckbox(){
            const boxes = document.querySelectorAll('input[type="checkbox"]')
            console.log(boxes.lenght)
            for(i=0;i<boxes.length; i++){
                boxes[i].addEventListener("click", function() {
                    if (boxes[i].checked) {
                        <?php //$_SESSION['opMateriais'] =?>
                        boxes[i].val()
                        console.log(boxes[i].val());
                    }
                });
            }
        }
    </script>
</body>
    
</html>