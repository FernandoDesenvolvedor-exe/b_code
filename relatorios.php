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

                    <div class="modal fade" id="modalAvancado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog modal-xl" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filtros avançados</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pre-scrollable">
                    
                                    <div class="card">
                                        
                                        <div class="card-body text-right">
                                            <div class="form-group row">
                                                <label class="m-t-10">Usuário:</label>
                                                <div class="col-md-2">
                                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <label class="m-t-10">Máquina:</label>
                                                <div class="col-md-2">
                                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <label class="m-t-10">Material:</label>
                                                <div class="col-md-2">
                                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <label class="m-t-10">Produto:</label>
                                                <div class="col-md-2">
                                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="card-body d-flex flex-row align-items-left">
                                            
                                            <div class="card-body">
                                                <div>                                    
                                                    <h4 class="card-title">Organizar ordens de produção por:</h4>
                                                </div>
                                                <div class="d-flex flex-row align-items-left m-3">
                                                    <div class="m-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-2" id="customControlValidation1" name="radio-stacked" required>
                                                            <label class="custom-control-label" for="customControlValidation1">Em aberto</label>
                                                        </div>
                                                            <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-4" id="customControlValidation2" name="radio-stacked" required>
                                                            <label class="custom-control-label" for="customControlValidation2">Em andamento</label>
                                                        </div>
                                                    </div>
                                                    <div class="m-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-3" id="customControlValidation3" name="radio-stacked" required>
                                                            <label class="custom-control-label" for="customControlValidation3">Concluidos</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-3" id="customControlValidation4" name="radio-stacked" required>
                                                            <label class="custom-control-label" for="customControlValidation4">Desativados</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body">

                                                <div>                                    
                                                    <h4 class="card-title">Periodo:</h4>
                                                </div>                                   
                                                <div class="input-group">
                                                    <label>De:</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <label>Até: </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>                                                                     
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">   

                        <div class="p-3">
                            <h3 class="card-title">Menu de Relatórios</h3>
                        </div>    

                        <div class="d-flex flex-row">

                        </div>
                        <div class="card-body">
                            <div>                                    
                                <h4 class="card-title">Organizar ordens de produção por:</h4>
                            </div>
                            <div class="d-flex flex-row align-items-left m-3">
                                <div class="m-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input col-md-2" id="customControlValidation1" name="radio-stacked" required>
                                        <label class="custom-control-label" for="customControlValidation1">Em aberto</label>
                                    </div>
                                        <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input col-md-4" id="customControlValidation2" name="radio-stacked" required>
                                        <label class="custom-control-label" for="customControlValidation2">Em andamento</label>
                                    </div>
                                </div>
                                <div class="m-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input col-md-3" id="customControlValidation3" name="radio-stacked" required>
                                        <label class="custom-control-label" for="customControlValidation3">Concluidos</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input col-md-3" id="customControlValidation4" name="radio-stacked" required>
                                        <label class="custom-control-label" for="customControlValidation4">Desativados</label>
                                    </div>
                                </div>
                            </div>
                        </div>    

                        <div class="card-body">  
                            <div>                                    
                                <h4 class="card-title">Periodo:</h4>
                            </div>                                   
                            <div class="input-group">
                                <label>De:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <label>Até: </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>                          
                        </div> 
                        
                        <div class="card-body">
                            <div class="form-group row m-3">                                    
                                <button style="width: 150px; height:36px; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAvancado">
                                    Avançado
                                </button> 
                            </div>

                            <div class="form-group row m-3">
                                <button id="iConsulta" type=button class="btn btn-info margin-5" style="width: 150px; height:36px; border-radius: 5px;">
                                    Consulta
                                </button> 
                            </div> 
                        </div>

                    </div> 

                    <div class="card p-3">        
                        <div class="table-responsive">
                            <table id="iDataTableAberto" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID do Pedido</th>
                                        <th>Produção prevista</th>
                                        <th>Matéria(s) Prima(s)</th>
                                        <th>Data criado</th>
                                        <th>Quantidade</th>
                                        <th>Observações</th>
                                        <th>Alterar/Desativar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //echo dataTableHistorico(); ?>
                                </tbody>
                            </table>
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

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> 

        <script>
            $('#iDataTableAberto').DataTable();
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

        <script>
            $( document ).ready(function() {

                const checkData = document.getElementById('#idCheckData');

                checkData.addEventListener('click', showDiv());

                function showDiv(){
                    if(document.getElementById('#idCheckData').checked){
                        
                        $ ('#idDivData').show();

                    } else {

                        $ ('#idDivData').hide();

                    }
                }               

            });
        </script>

        <script>               
             /*       
            // Create a break line element
            var br = document.createElement("br"); 

            function GFG_Fun() {             

                // Create a form synamically
                var form = document.createElement("form");                
                form.setAttribute("method", "post");
                form.setAttribute("action", "listaHistoricoAberto.php");

                var dataInicio = document.getElementById('');
            
                // Create an input element for Full Name
                var FN = document.createElement("input");
                FN.setAttribute("type", "text");
                FN.setAttribute("name", "FullName");
                FN.setAttribute("placeholder", "Full Name");
            
                // Create an input element for date of birth
                var DOB = document.createElement("input");
                DOB.setAttribute("type", "text");
                DOB.setAttribute("name", "dob");
                DOB.setAttribute("placeholder", "DOB");
            
                // Create an input element for emailID
                var EID = document.createElement("input");
                EID.setAttribute("type", "text");
                EID.setAttribute("name", "emailID");
                EID.setAttribute("placeholder", "E-Mail ID");
            
                // Create an input element for password
                var PWD = document.createElement("input");
                PWD.setAttribute("type", "password");
                PWD.setAttribute("name", "password");
                PWD.setAttribute("placeholder", "Password");
            
                // Create an input element for retype-password
                var RPWD = document.createElement("input");
                RPWD.setAttribute("type", "password");
                RPWD.setAttribute("name", "reTypePassword");
                RPWD.setAttribute("placeholder", "ReEnter Password");
    
                // create a submit button
                var s = document.createElement("input");
                s.setAttribute("type", "submit");
                s.setAttribute("value", "Submit");
                
                // Append the full name input to the form
                form.appendChild(FN); 
                
                // Inserting a line break
                form.appendChild(br.cloneNode()); 
                
                // Append the DOB to the form
                form.appendChild(DOB); 
                form.appendChild(br.cloneNode()); 
                
                // Append the emailID to the form
                form.appendChild(EID); 
                form.appendChild(br.cloneNode()); 
                
                // Append the Password to the form
                form.appendChild(PWD); 
                form.appendChild(br.cloneNode()); 
                
                // Append the ReEnterPassword to the form
                form.appendChild(RPWD); 
                form.appendChild(br.cloneNode()); 
                
                // Append the submit button to the form
                form.appendChild(s); 

                document.getElementsByTagName("body")[0]
                .appendChild(form);
            }*/
        </script>
    </body>
</html>