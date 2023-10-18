<?php
    include('php/function.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">

    <?php include('pages/cabecalho.php');?>

    <body>

        <div id="main-wrapper">  

            <?php include('pages/menu.php');?>     

            <div class="page-wrapper">      
                
                <?php include('pages/side_bar_direita.php');?>

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Basic Datatable</h5>
                                    <div class="table-responsive">                                        
                                        <?php echo createTable();?>                                           
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        
        <?php include('pages/jQuery.php');?>
        
        <!-- this page js -->
        <script src="dist/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
        <script src="dist/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
        <script src="dist/assets/extra-libs/DataTables/datatables.min.js"></script>
        <script>
            /****************************************
                *       Basic Table                   *
                ****************************************/
            $('#zero_config').DataTable();
        </script>                   
    </body>

</html>