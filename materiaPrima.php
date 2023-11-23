<?php
    include('php/function.php');
    include('links/loginSession.php');

    if (isset($_SESSION['user']) == 0){

        alert(1,'Acesso negado!','Tentativa de acesso ilegal!');
        
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

            <?php include('links/preloader.php');?> 

            <?php  include('links/menu.php');?>     

            <div class="page-wrapper">      
                
                <?php include('links/side_bar_direita.php');?>

                <div class="container-fluid">    

                    <!-- Start Page Content -->                    
                    <div class="card" style="padding: 10px;">  

                        <h4 class="card-title">Estoque de Matérias Primas</h4>
                                    
                        <div>
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddMaterial">
                                Nova Materia Prima
                            </button>         
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddTipo">
                                Novo Tipo de Material
                            </button>         
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#modalAddClasse">
                                Nova Classe de Material
                            </button>                                           
                        </div> 

                        <!-- MODAL NOVA CLASSE DE MATÈRIA PRIMA -->
                        <div class="modal fade" id="modalAddClasse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de uma classe de material</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                        
                                        <div class="card">

                                            <!-- Cria um formulário -->
                                            <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=iCM">
                                                <div class="card-body">

                                                    <!-- Titulo da div -->
                                                    <h4 class="card-title">Adicionar Classe de material</h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <input style="width:100%;" id="iClasse" name="nClasse" type="text" class="form-control" placeholder="Ex: Engenharia" style="width: 20%; height:36px;" required>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="border-top">
                                                    <div class="card-body">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>        
                                        </div> 

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL NOVO TIPO DE MATÈRIA PRIMA -->
                        <div class="modal fade" id="modalAddTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de um tipo de material</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card">

                                            <!-- Cria um formulário -->
                                            <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=ITM">
                                                <div class="card-body">

                                                    <!-- Titulo da div -->
                                                    <h4 class="card-title">Adicionar tipo de matéria prima</h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <input style="width:100%;" id="iTipoMateria" name="nTipoMateria" type="text" class="form-control" placeholder="Ex: Reciclado" style="width: 20%; height:36px;" required>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="border-top">
                                                    <div class="card-body">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>       

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- NOVA MATÈRIA PRIMA -->
                        <div class="modal fade" id="modalAddMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">                                        
                                                                                
                                        <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IMP">
                                            <div class="card-body">
                                                
                                                <!-- Titulo da div -->
                                                <h4 class="card-title">Matéria Prima</h4>
                                                <div class="form-group row">
                                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do material</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="iDescricao" name= "nDescricao" placeholder="Nome do material" required>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label class="col-md-3 m-t-15" style="text-align: right;">Classe do material</label>
                                                    <div class="col-md-9">
                                                        <select id="iClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                            <?php echo optionClaseMaterial();?>                                         
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 m-t-15" style="text-align: right;">Tipo de matéria prima</label>
                                                    <div class="col-md-9">
                                                        <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                            <?php echo optionTipoMaterial();?>
                                                        </select>
                                                    </div>                                    
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email1" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                    <div style="display:inline;" class="col-sm-9">
                                                        <select id="iFornecedor" name="nFornecedor" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>                                           
                                                            <?php echo optionFornecedor();?>                                                                                 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade</label>
                                                    <div class="col-sm-9">
                                                        <input style="width:auto" id="iQuandtidade" name="nQuandtidade" type="text" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade em gramas" style="width: 10%;" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Pigmentos Compatíveis</label>
                                                <div class="col-md-9">
                                                    <select id="iPigmento" name="nPigmento[]" class="select2 form-control m-t-15" multiple="multiple" style="width: 100%; height:36px;" required>
                                                        <?php echo optionPigmento(); ?>
                                                    </select>
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
                            </div>
                        </div>

                        <div class="card" style="padding: 10px;"> 

                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Matéria Prima</th>
                                            <th>Fornecedor</th>
                                            <th>Tipo</th>
                                            <th>Classe</th>
                                            <th>Quantidade</th>
                                            <th>Observações</th>
                                            <th>Alterar/Desativar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo dataTableMateria(); ?>
                                    </tbody>
                                </table>
                            </div>                         
                        </div>  
                    </div>
                </div>
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?> 

        <script>
            /****************************************
            *       Basic Table                   *
            ****************************************/
            $('#zero_config').DataTable();
        </script> 

        <script>
            
            //***********************************//
            // For select 2
            //***********************************//
            $(".select2").select2();

            /*colorpicker*/
            $('.demo').each(function() {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    position: $(this).attr('data-position') || 'bottom left',

                    change: function(value, opacity) {
                        if (!value) return;
                        if (opacity) value += ', ' + opacity;
                        if (typeof console === 'object') {
                            console.log(value);
                        }
                    },
                    theme: 'bootstrap'
                });

            });
            /*datwpicker*/
            jQuery('.mydatepicker').datepicker();
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

        </script>
    </body>
</html>