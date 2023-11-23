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

                    <div class="card p-3 align-items-left">
                        <h4 class="card-title">Menu de Relatórios</h4>

                        <div class="form-group row">
                            <label class="col-md-3">Ordens de produção</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoAberto" name="radio-stacked" value=1 required="">
                                    <label class="custom-control-label" for="historicoAberto">Em aberto</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoAndamento" name="radio-stacked" value=2 required="">
                                    <label class="custom-control-label" for="historicoAndamento">Em andamento</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoConcluido" name="radio-stacked" value=3 required="">
                                    <label class="custom-control-label" for="historicoConcluido">Concluidos</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="historicoDesativado" name="radio-stacked" value=4 required="">
                                    <label class="custom-control-label" for="historicoDesativado">Deletados</label>
                                </div>
                            </div>
                        </div>                        

                        <div class="card-body">
                            <button onclick="showDiv(this);" id="btnData" type="button" class="btn btn-info margin-5">
                                Filtrar com Datas
                            </button>
                        </div>

                        <div id="idDivData" class="card-body" hidden>
                            <div class="input-group mb-3">
                                <label>Concluidos em:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <label>Até: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>                      

                        <button id="iConsulta" type=button class="btn btn-info margin-5" style="width: 150px;">
                            Consulta
                        </button>                        
                    </div>   
                        
                    <div class="card-body" hidden>
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
                                    <?php echo dataTableHistorico(); ?>
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
            /****************************************
            *       Basic Table                   *
            ****************************************/
            $('#zero_config').DataTable();
        </script> 

        <script>
            $( document ).ready(function() {
                alert( "document loaded" );
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