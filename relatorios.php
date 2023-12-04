<?php
    session_start();
    include('php/function.php');

    if (isset($_SESSION['user']) == 0){
        //alert(1,'Acesso negado!','Tentativa de acesso ilegal!');        
        header('location: login');
    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
    <head>
        <?php include('links/cabecalho.php');?>   
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    </head> 
    
    <body>

        <div id="main-wrapper">

            <?php include('links/preloader.php');?>

            <?php  include('links/menu.php');?>

            <div class="page-wrapper">
                
                <?php include('links/side_bar_direita.php');?>

                <div class="container-fluid">

                    <!--div class="modal fade" id="modalAvancado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
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
                                                        <input id="idDataInicioAvancado" name="nDataInicioAvancado" type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <label class="col-sm-3">Até:</label>
                                                    <div class="col-sm-9">
                                                        <input id="idDataFimAvancado" name="nDataFimAvancado" type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
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
                    </div -->
                            
                    <h3 class="card-title">Menu de Relatórios</h3>

                    <div class="card">
                        <div class="d-flex justify-content-center flex-row m-4">
                            
                            <div class="form-group row col-md-4">     
                                <h4 class="card-title col-sm-12">Organizar ordens de produção por:</h4>
                                <div class="col-sm-10">
                                    <select id="idSelecao" name="nSelecao" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Todos</option>
                                        <option value="1">Em Aberto</option>
                                        <option value="2">Em Andamento</option>
                                        <option value="0">Cancelados</option>
                                        <option value="3">Concluidos</option>
                                    </select>
                                </div>
                            </div>   

                            <div class="form-group row col-md-6">  
                                <div>                                    
                                    <h4 class="card-title">Periodo:</h4>
                                </div>                                   
                                <div class="input-group d-flex row">
                                    <label>De:</label>
                                    <div class="col-sm-5">
                                        <input type="date" id="idDataInicio" name="nDataInicio" class="form-control" onchange="formataData()" placeholder="dd/mm/yyyy">                                        
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <label>Até: </label>
                                    <div class="col-sm-5">
                                        <input type="date" id="idDataFim" min="2" name="nDataFim" class="form-control" placeholder="dd/mm/yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>                          
                            </div>     

                            <div class="form-group col-md-2">
                                <!--div class="col-sm-12 m-3">                                    
                                    <button style="width: 150px; height:36px; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAvancado">
                                        Filtros avançados
                                    </button> 
                                </div -->

                                <button id="iConsulta" align=center type=submit class="btn btn-info margin-5" style="width: 150px; height:36px; border-radius: 5px; text-align: center;">
                                    Consulta
                                </button> 
                            </div> 

                        </div>                          
                    </div> 

                    <div id="divDataTable" class="card p-3">        
                        <div class="table-responsive">
                            <table id="datatable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID do Pedido</th>
                                        <th>Autor</th>
                                        <th>Produto</th>
                                        <th>Máquina</th>
                                        <th>Status do pedido</th>
                                        <th>Data de abertura</th>
                                        <th>Alterar/Restaurar/Desativar</th>
                                    </tr>
                                </thead>
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
    
        <script>
            
            function dataTableHistorico(){
                new DataTable('#datatable', {
                    language: {
                        "decimal":        ",",
                        "emptyTable":     "Não há registros disponíveis na tabela",
                        "info":           "Mostrando _START_ até _END_ de _TOTAL_ registros",
                        "infoEmpty":      "Mostrando 0 até 0 de 0 entradas",
                        "infoFiltered":   "(Filtrado para _MAX_ registros totais)",
                        "infoPostFix":    "",
                        "thousands":      ".",
                        "lengthMenu":     "Mostrar  _MENU_  registros",
                        "loadingRecords": "Loading...",
                        "processing":     "",
                        "search":         "Pesquisar:",
                        "zeroRecords":    "Nenhum valor semelhante encontrado",
                        "paginate": {
                            "first":      "Primeiro",
                            "last":       "Último",
                            "next":       "Próximo",
                            "previous":   "Aterior"
                        },
                        "aria": {
                            "sortAscending":  ": Ative para organizar a coluna de forma ascendente",
                            "sortDescending": ": Ative para organizar a coluna de forma descendente"
                        }
                    },
                    ajax: {
                        url: 'php/processingHistoricoDataTable.php',
                        type: 'POST'
                    },
                    columns: [
                        { data: 0 },
                        { data: 1 },
                        { data: 2 },
                        { data: 3 },
                        { data: 4 },
                        { data: 5 },
                        { data: 6 }
                    ],
                    processing: true,
                    serverSide: true
                });                 
            }

            $('document').ready(dataTableHistorico());       
        </script>

        <script>            
            $('document').ready(function(){
                $('#idDataInicio').on('change', function(){
                    $('#idDataFim').attr({"min" : ''+$('#idDataInicio').val()+''});
                });

                $('#idDataFim').on('blur', function(){
                    if($('#idDataInicio').val() > $('#idDataFim').val()){
                        alert('Data inicial maior que data final!');
                    }
                });

                $('#iConsulta').on('click', function(e){   
                    var select = $('#idSelecao').val();

                    if($('#idDataInicio').val() != ''){
                        var dataInicio = $('#idDataInicio').val();   
                    } else {
                        var dataInicio = '';                        
                    }
                    if($('#idDataFim').val() != ''){
                        var dataFim = $('#idDataFim').val();   
                    } else {
                        var dataFim = '';
                    }     
                    
                    let datas ='campo1='+select+'&campo2='+dataInicio+'&campo3='+dataFim; 
                    e.preventDefault();

                    $.ajax({
                        url: 'php/historicoFiltro.php',
                        method: 'POST',
                        dataType: 'html',
                        data:datas,
                        success: function() {
                            var table = $('#datatable').DataTable();
                            table.destroy();
                        }
                    }).done(function(){
                        //$("#limpaConsulta").show();
                        dataTableHistorico();
                    });
                });
            });
            
        </script>

        <script>
            $(".select2").select2();

            $('.demo').each(function() {
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