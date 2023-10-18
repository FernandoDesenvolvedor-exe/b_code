<?php
    include('php/function.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">

    <?php include('links/cabecalho.php');?>

    <body>

        <div id="main-wrapper">  

            <?php include('links/preloader.php');?> 

            <?php  include('links/menu.php');?>  

            <div class="page-wrapper">      
                
                <?php include('links/side_bar_direita.php');?>

                <div class="container-fluid">                   
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="card">
                        <!-- ============================================================== -->
                        <!-- Cria um formulário -->
                        <!-- ============================================================== -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?tipo=AF">
                            <div class="card-body">
                                <!-- ============================================================== -->
                                <!-- Titulo da div -->
                                <!-- ============================================================== -->
                                <h4 class="card-title">Adicionar Fornecedor</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Nome do Fornecedor</label>
                                    <div class="col-sm-9">
                                        <input id="iFornecedor" name="nFornecedor" type="text" class="form-control" id="iFornecedor" name="nFornecedor" placeholder="Nome do fornecedor aqui" style="width: 20%; height:36px;">
                                    </div>
                                </div>  
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>        
                    </div>
                    <div class="card">
                        <!-- ============================================================== -->
                        <!-- Cria um formulário -->
                        <!-- ============================================================== -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?tipo=AF">
                            <div class="card-body">
                                <!-- ============================================================== -->
                                <!-- Titulo da div -->
                                <!-- ============================================================== -->
                                <h4 class="card-title">Adicionar Classe de material</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Nome da classe</label>
                                    <div class="col-sm-9">
                                        <input id="iFornecedor" name="nFornecedor" type="text" class="form-control" id="iFornecedor" name="nFornecedor" placeholder="Ex: Engenharia" style="width: 20%; height:36px;">
                                    </div>
                                </div>  
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>        
                    </div>

                    <div class="card">
                        <!-- ============================================================== -->
                        <!-- Cria um formulário -->
                        <!-- ============================================================== -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?tipo=AF">
                            <div class="card-body">
                                <!-- ============================================================== -->
                                <!-- Titulo da div -->
                                <!-- ============================================================== -->
                                <h4 class="card-title">Adicionar tipo de matéria prima</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">tipo de matéria prima</label>
                                    <div class="col-sm-9">
                                        <input id="iFornecedor" name="nFornecedor" type="text" class="form-control" id="iFornecedor" name="nFornecedor" placeholder="Ex: Reciclado" style="width: 20%; height:36px;">
                                    </div>
                                </div>  
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>        
                    </div>

                    <div class="card">
                        <!-- ============================================================== -->
                        <!-- Cria um formulário -->
                        <!-- ============================================================== -->
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?tipo=AF">
                            <div class="card-body">
                                <!-- ============================================================== -->
                                <!-- Titulo da div -->
                                <!-- ============================================================== -->
                                <h4 class="card-title">Adicionar tipo de pigmento</h4>
                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">tipo de pigmento</label>
                                    <div class="col-sm-9">
                                        <input id="iFornecedor" name="nFornecedor" type="text" class="form-control" id="iFornecedor" name="nFornecedor" placeholder="Ex: MTB" style="width: 20%; height:36px;">
                                    </div>
                                </div>  
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>        
                    </div>
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->


                    <!-- ============================================================== -->
                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                    <!-- ============================================================== -->
                    <!-- End Right sidebar -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->            
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>

        <!-- This Page JS -->
        <script src="dist/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
        <script src="dist/js/pages/mask/mask.init.js"></script>
        <script src="dist/assets/libs/select2/dist/js/select2.full.min.js"></script>
        <script src="dist/assets/libs/select2/dist/js/select2.min.js"></script>
        <script src="dist/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
        <script src="dist/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
        <script src="dist/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
        <script src="dist/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
        <script src="dist/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="dist/assets/libs/quill/dist/quill.min.js"></script>
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