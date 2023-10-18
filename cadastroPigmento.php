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
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?tipo=IM">
                            <div class="card-body">
                                <!-- ============================================================== -->
                                <!-- Titulo da div -->
                                <!-- ============================================================== -->
                                <h4 class="card-title">Matéria Prima</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do material</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="idMAterial" name= "nMaterial "placeholder="Nome do material">
                                    </div>
                                </div>                                                              

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Relação de materiais</label>
                                    <div class="col-md-9">     
                                        <select class='select2 form-control m-t-15' multiple='multiple' style='height: 36px;width: 100%;'>                                   
                                            <?php echo fillSelectMateriaPrima();?>      
                                        </select>                                                         
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Relação de Pigmntos</label>
                                    <div class="col-md-9">
                                        <select class='select2 form-control m-t-15' multiple='multiple' style='height: 36px;width: 100%;'>
                                            <?php echo fillSelectPigmento();?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Classe do material</label>
                                    <div class="col-md-9">
                                        <select id="iClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <option value="1">Comodities</option>
                                            <option value= "2">Engenharia</option>                                           
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Tipo de matéria prima</label>
                                    <div class="col-md-9">
                                        <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <option value="1">Virgem</option>
                                            <option value= "2">Reciclado</option>  
                                            <option value="3">Remoido</option>
                                            <option value= "4">Scrap</option>                                                                                   
                                        </select>
                                    </div>                                    
                                </div>

                                <div style="align-itens= side;" class="form-group row">
                                    <label for="email1" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                    <div style="display:inline;" class="col-sm-9">
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;">                                           
                                            <?php echo fillSelectFornecedor()?>                                                                                 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade</label>
                                    <div class="col-sm-9">
                                        <input id="iQuandtidade" name="nQuandtidade" type="text" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade em gramas" style="width= 10%;">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id= "iObservacoes" name="nObservacoes"></textarea>
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