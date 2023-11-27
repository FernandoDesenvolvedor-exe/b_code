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
                        <div class="modal-dialog modal-lg" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filtros avançados</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pre-scrollable">
                    
                                    <div class="card">
                                        
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-5 text-align-left">
                                                    <label class="m-t-10">Usuário</label>
                                                    <select id="idUsuario" name="nUsuario" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <div class="col-md-3 text-align-left">
                                                    <label class="m-t-10">Máquina:</label>
                                                    <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>


                                                <div class="col-md-4">
                                                    <label class="m-t-10">Produto:</label>  
                                                    <select id="idProduto" name="nProduto" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>

                                                <br>
                                                
                                                <div class="col-md-4">
                                                    <label class="m-t-10">Material:</label>
                                                    <select id="idMaterial" name="nMaterial" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label class="m-t-10">Classe do material:</label>
                                                    <select id="idClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label class="m-t-10">Tipo de Material:</label>
                                                    <select id="idTipoMaterial" name="nTipoMaterial" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <option>Select</option>                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="card-body d-flex flex-row align-items-left">
                                            
                                            <div class="card-body col-sm-6">                       
                                                <h4 class="card-title">Organizar ordens de produção por:</h4>
                                                <div class="d-flex flex-row align-items-left m-3">
                                                    <div class="m-1 mr-4">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-2" id="idAberto" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idDataAberto">Em aberto</label>
                                                        </div>
                                                            <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-4" id="idAndamento" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idAndamento">Em andamento</label>
                                                        </div>
                                                    </div>
                                                    <div class="m-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-3" id="idConcluido" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idConcluido">Concluidos</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input col-md-3" id="idDesativado" name="radio-modal" required>
                                                            <label class="custom-control-label" for="idDesativado">Desativados</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body col-sm-6">
                                                <div>                                    
                                                    <h4 class="card-title">Periodo:</h4>
                                                </div>                                   
                                                <div class="input-group">
                                                    <label class="col-sm-3">De:</label>
                                                    <div class="col-sm-9">
                                                        <input id="idDataInicio" name="nDataInicio" type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <label class="col-sm-3">Até:</label>
                                                    <div class="col-sm-9">
                                                        <input id="idDataFim" name="nDataFim" type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
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

                        <div class="d-flex flex-row align-items-center">
                            <div class="card-body">
                                <div>                                    
                                    <h4 class="card-title">Organizar ordens de produção por:</h4>
                                </div>
                                <div class="d-flex flex-row align-items-left m-3">
                                    <div class="m-1">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-2" id="idAberto" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idAberto">Em aberto</label>
                                        </div>
                                            <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-4" id="idAndamento" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idAndamento">Em andamento</label>
                                        </div>
                                    </div>
                                    <div class="m-1">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-3" id="idConcluidos" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idConcluidos">Concluidos</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input col-md-3" id="idDesativados" name="radio-stacked" required>
                                            <label class="custom-control-label" for="idDesativados">Desativados</label>
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
            $(document).ready(function() {
                //
                $('#datatable').DataTable({
                    language: {
                        "sEmptyTable":   "Nenhum registro encontrado",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing":   "Processando...",
                        "sLengthMenu":   "Mostrar _MENU_  linhas por página",
                        "sZeroRecords":  "Não foram encontrados resultados",
                        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                        "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                        "sInfoPostFix":  "",
                        "sSearch":       "Procurar:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "Primeiro",
                            "sPrevious": "Anterior",
                            "sNext":     "Seguinte",
                            "sLast":     "Último"
                        },
                        "oAria": {
                            "sSortAscending":  ": Ordenar colunas de forma crescente",
                            "sSortDescending": ": Ordenar colunas de forma decrescente"
                        }
                    },
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                        "columnDefs": [
                            { "responsivePriority": 1, "targets": -1 }
                        ],
                    "ajax": 'Controller/processingListaMeusMotoristas.php'
                });

                //
                $('#divEmpTerceira').hide();
                $('#iEmpTerceira').removeAttr('required');

                $('#iTipoMotorista').change(function(){

                    if($('#iTipoMotorista').val() == "T"){
                        $('#divEmpTerceira').show();
                        $('#iEmpTerceira').attr("required", "req");
                    }else{
                        $('#divEmpTerceira').hide();
                        $('#iEmpTerceira').removeAttr('required');
                    }

                });

                //Bloco da Empresa Terceira na solicitação
                document.getElementById("msgExistente").style.cssText = 
                "background-color: #FFE4B5; position: fixed; top: 320px; margin-left: 5px; padding: 4px;";
                $('#EmpTerceiraSolicitacao').hide();
                $('#iEmpTerceiraSolicitacao').removeAttr('required');

                $('#iTipoSolicitacao').change(function(){

                    if($('#iTipoSolicitacao').val() == "T"){
                        document.getElementById("msgExistente").style.cssText = 
                        "background-color: #FFE4B5; position: fixed; top: 400px; margin-left: 5px; padding: 4px;";
                        $('#EmpTerceiraSolicitacao').show();
                        $('#iEmpTerceiraSolicitacao').attr("required", "req");
                    }else{
                        
                        document.getElementById("msgExistente").style.cssText = 
                        "background-color: #FFE4B5; position: fixed; top: 320px; margin-left: 5px; padding: 4px;";
                        $('#EmpTerceiraSolicitacao').hide();
                        $('#iEmpTerceiraSolicitacao').removeAttr('required');
                    }

                });

                //
                $('#iTipoMotoristaAlter').change(function(){

                    alert($('#iTipoMotoristaAlter').val());

                    if($('#iTipoMotoristaAlter').val() == "T"){
                        $('#divEmpTerceiraAlter').show();
                        $('#iEmpTerceiraAlter').attr("required", "req");
                    }else{
                        $('#divEmpTerceiraAlter').hide();
                        $('#iEmpTerceiraAlter').removeAttr('required');
                    }

                });
                

                //
                $('#iTabela').hide();
                $('.campos').hide();
                $('#caixa').hide();
                $('#msgExistente').hide();
                $('#msgPossuiLink').hide();
                $('#msgCPF').hide();
                $('#TipoSolicitacao').hide();
                $('#iEmpTerceiraSolicitacao').hide();
                $('#footer').hide();
                $('#footerLink').hide();
                $('#iPesquisaCPF').on('click',function(){

                    var cpf = $('#CPFConsulta').val();
                    
                    if(cpf != ""){

                        $.getJSON('Controller/carregaCPFMotorista.php?cpf='+cpf,
                        function (dados){

                            $.each(dados, function(i, obj){                        
                                    
                                //alert(obj.QtdCad);
                                                    
                                if(parseInt(obj.QtdCad) > 0){

                                    //Valida links
                                    //Se o motorista já possui link
                                    if(parseInt(obj.QtdLink) > 0){
                                        $('#iTabela').hide();
                                        $('.campos').hide();
                                        $('#caixa').hide();
                                        $('#msgExistente').hide();
                                        $('#msgPossuiLink').show();
                                        $('#msgCPF').hide();
                                        $('#TipoSolicitacao').hide();
                                        $('#cargoSolicitacao').attr('hidden');
                                        $('#iEmpTerceiraSolicitacao').hide();
                                        $('#footerLink').hide();
                                        $('#footer').hide();
                                    //Se o motorista já existe
                                    }else{
                                        $('#iTabela').hide();
                                        $('.campos').hide();
                                        $('#caixa').show();
                                        $('#msgExistente').show();
                                        $('#msgPossuiLink').hide();
                                        $('#msgCPF').hide();
                                        $('#TipoSolicitacao').show();
                                        $('#cargoSolicitacao').removeAttr('hidden');
                                        $('#iEmpTerceiraSolicitacao').show();
                                        $('#footerLink').show();
                                        $('#footer').hide();
                                    }
                                    
                                }else{
                                    if (!calculoCPF(cpf)) {
                                        $('#iTabela').hide();
                                        $('.campos').hide();
                                        $('#caixa').hide();
                                        $('#msgExistente').hide();
                                        $('#msgPossuiLink').hide();
                                        $('#TipoSolicitacao').hide();
                                        $('#cargoSolicitacao').attr('hidden');
                                        $('#msgCPF').show();
                                        $('#iEmpTerceiraSolicitacao').hide();
                                        $('#footerLink').hide();
                                        $('#footer').hide();
                                    }else{
                                        $('#iTabela').show();
                                        $('.campos').show();
                                        $('#caixa').show();
                                        $('#msgExistente').hide();
                                        $('#msgPossuiLink').hide();
                                        $('#TipoSolicitacao').hide();
                                        $('#cargoSolicitacao').attr('hidden');
                                        $('#msgCPF').hide();
                                        $('#iEmpTerceiraSolicitacao').hide();
                                        $('#footerLink').hide();
                                        $('#footer').show();
                                    }
                                }
                                
                            })        

                        })
                    }

                });

                var uf = $('#iUF').val();
                if(uf){
                    $.ajax({
                        type:'POST',
                        url:"Controller/carregaCidadeUF.php",
                        data:'uf='+uf,
                        success: function(html) {
                            $('#iCidade').html(html);
                        }
                    });
                }

                $('#iUF').on('change', function(){
                    var uf = $(this).val();
                    if(uf){
                        $.ajax({
                            type:'POST',
                            url:"Controller/carregaCidadeUF.php",
                            data:'uf='+uf,
                            success: function(html) {
                                $('#iCidade').html(html);
                            }
                        });
                    }
                });

            });

            function enviaLink(){
                var cpf = $('#CPFConsulta').val();
                $('#formLink').attr('action','Controller/salvaSolicitacaoLink.php?cpf='+cpf);
                $('#formLink').submit();
                document.getElementById('TipoSolicitacao').submit();
                document.getElementById('iCargo').submit();
                document.getElementById('iEmpTerceiraSolicitacao').submit();
            }

            //Limpa o valor no campo quando clica no botão porque pode vir input gravado do navegador
            function limpaCamposEmail(){
                $('#iEmailVal').val('');
            }

            function calculoCPF(){
                let cpf = document.getElementById("CPFConsulta").value;
                var soma;
                var resto;
                soma = 0;

                cpf = cpf.replace("-", "");

                cpf = cpf.replace(/\./g, "");

                if (cpf == "00000000000") return false;

                if (cpf.length !== 11 || !Array.from(cpf).filter(e => e !== cpf[0]).length) {
                return false;
                }

                for (i=1; i<=9; i++) soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
                resto = (soma * 10) % 11;

                    if ((resto == 10) || (resto == 11))  resto = 0;
                    if (resto != parseInt(cpf.substring(9, 10)) ) return false;

                soma = 0;
                    for (i = 1; i <= 10; i++) soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
                    resto = (soma * 10) % 11;

                    if ((resto == 10) || (resto == 11))  resto = 0;
                    if (resto != parseInt(cpf.substring(10, 11) ) ) return false;
                    return true;
            }

            function limpaCampos(id){
                $('.' + id).val(0);
            }

            function mudaAction(pagina){
                document.forms[0].target='';
                document.forms[0].action=pagina;
                document.forms[0].submit();
            }

            function insereAction(pagina){
                document.forms[0].target='_blank';
                document.forms[0].action=pagina;
                document.forms[0].submit();
            }

            function limpaCamposConsulta(){
                $('#Nome').val('');
                $('#CPF').val('');
                $('#iTipoSituacao').val('');
                $('#iTipoLink').val('');
                $('#iUF').val('');
                $('#iCidade').val('');
                $('#iVencimentoCNH').val('');
                $('#iVencimentoTox').val('');
                $('#iDisponibilidade').val('');
                $('#iTransportadora').val('');
            }

            function validaEmailMotoristas(email){
                if(email != ""){
                    $.getJSON('Controller/validaEmailExistente.php?email='+email,
                    function (dados){
                        $.each(dados, function(i, obj){           
                            if(parseInt(obj.Qtd) > 0){
                                $('#msgPossuiEmail').removeAttr('hidden');
                                $('.campos').hide();
                                $('#footer').hide();
                            }else{
                                $('#msgPossuiEmail').attr('hidden', true);
                                $('.campos').show();
                                $('#footer').show();
                            }
                        })        
                    })
                }
            }

            function abreModal(idMotorista){
                $.getJSON('Controller/consultaCaixa.php?idMotorista='+idMotorista,
                function (dados){
                    $.each(dados, function(i, obj){           
                        if(parseInt(obj.Qtd) > 0){
                            $('#msgCaixa').removeAttr('hidden');
                            $('#modalFooter' + idMotorista).attr('hidden', true);
                        }else{
                            $('#msgCaixa').attr('hidden', true);
                            $('#modalFooter' + idMotorista).removeAttr('hidden');
                        }
                    })        
                })
            }

            /*$("#CPFConsulta").blur(function(){
                cpf = $('#CPFConsulta').val();

                if(cpf != ""){
                    $.getJSON('Controller/validaCPFExistente.php?cpf='+cpf,
                    function (dados){
                        $.each(dados, function(i, obj){           
                            if(parseInt(obj.Qtd) > 0){
                                //alert('CPF existente');
                                $('#iTabela').hide();
                                $('.campos').hide();
                                $('#caixa').hide();
                                $('#msgExistente').hide();
                                $('#msgPossuiLink').show();
                                $('#msgCPF').hide();
                                $('#TipoSolicitacao').hide();
                                $('#iEmpTerceiraSolicitacao').hide();
                                $('#footerLink').hide();
                                $('#footer').hide();
                            }
                        })        
                    })
                }
            });*/
        </script>
    </body>
</html>