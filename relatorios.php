<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    include('php/function.php');

    if (isset($_SESSION['user']) == 0){
        //alert(1,'Acesso negado!','Tentativa de acesso ilegal!');        
        header('location: php/logout.php');
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
                                            
                                        <div class="form-group row col-md-4">     
                                            <h4 class="card-title col-sm-12">Organizar ordens de produção por:</h4>
                                            <div class="col-sm-10">
                                                <select id="idSelecaoAvancado" name="nSelecao" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                    <option value="">Todos</option>
                                                    <option value="1">Em Aberto</option>
                                                    <option value="2">Em Andamento</option>
                                                    <option value="0">Cancelados</option>
                                                    <option value="3">Concluidos</option>
                                                </select>
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
                    </div-->
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
                                    <?php if($_SESSION['ativaMsgS'] == 1){?>                        
                                        <div class="alert alert-success" role="alert">      
                                            <?php 
                                                echo $_SESSION['msgSucesso'];
                                                $_SESSION['ativaMsgS'] = 0;    
                                            ?>                      
                                        </div>
                                    <?php } if ($_SESSION['ativaMsgA'] == 1){?>
                                        <div class="alert alert-warning" role="alert">  
                                            <?php 
                                                    echo $_SESSION['msgAviso'];
                                                    $_SESSION['ativaMsgA'] = 0;    
                                                ?>                      
                                            </div>
                                    <?php } if($_SESSION['ativaMsgD'] == 1){?>
                                        <div class="alert alert-danger" role="alert">   
                                            <?php 
                                                    echo $_SESSION['msgPerigo'];
                                                    $_SESSION['ativaMsgD'] = 0;    
                                                ?>                      
                                            </div>
                                    <?php }?>
                                </div>    
                            </div>    
                        </div>    
                    </div>    

                    
                            
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

                            <div class="form-group row col-md-6" id="iDivDatas">  
                                <div>                                    
                                    <h4 class="card-title">Periodo:</h4>
                                </div>                                   
                                <div class="input-group d-flex row">
                                    <label class="mt-2 col-md-1 text-right">De:</label>
                                    <div class="col-md-4">
                                        <input type="date" id="idDataInicio" name="nDataInicio" class="form-control" placeholder="dd/mm/yyyy">                                                                             
                                        <div class="input-group-append">
                                            <div>
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>                                           
                                        </div>
                                    </div>      
                                    <div class="mt-2 col-md-1">
                                        <a href='#' id='resetInicio' class="fas fa-undo text-success"></a>
                                    </div>  

                                    <label class="mt-2 col-md-1 text-right">Até: </label>                                    
                                    <div class="col-md-4">
                                        <input type="date" id="idDataFim" name="nDataFim" class="form-control" placeholder="dd/mm/yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>                                                                           
                                    <div class="mt-2 col-md-1">
                                        <a href='#' id='resetFim' class="fas fa-undo text-success"></a>
                                    </div> 

                                </div>                          
                            </div>

                            <div class="form-group flex-column col-md-2">
                                <!--div class="col-sm-12 m-3">                                    
                                    <button style="width: 150px; height:36px; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAvancado">
                                        Filtros avançados
                                    </button> 
                                </div-->

                                <div class="col-sm-12 m-3">
                                    <button id="iConsulta" type=submit class="btn btn-info mt-10" style="width: 150px; height:36px; border-radius: 5px;">
                                        Consulta
                                    </button> 
                                </div> 
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
                                        <th>Aberto em</th>
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
                        "loadingRecords": "Carregando...",
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

            function resetData(){
                if($('#idDataInicio').val() == ''){
                    $('#resetInicio').hide();
                }else{                                                
                    $('#resetInicio').show();
                }

                $('#idDataInicio').on('change', function(){    
                    if($('#idDataInicio').val() == ''){
                        $('#resetInicio').hide();
                    }else{                                                
                        $('#resetInicio').show();
                    }
                })

                $('#resetInicio').click(function(){
                    $('#idDataInicio').val('');
                    $('#resetInicio').hide();
                })

                if($('#idDataFim').val() == ''){
                    $('#resetFim').hide();
                }else{                                                
                    $('#resetFim').show();
                }

                $('#idDataFim').on('change', function(){    
                    if($('#idDataFim').val() == ''){
                        $('#resetFim').hide();
                    }else{                                                
                        $('#resetFim').show();
                    }
                })

                $('#resetFim').click(function(){
                    $('#idDataFim').val('');
                    $('#resetFim').hide();
                })
            }
                
            var filtro = <?php echo $_SESSION['filtro']; ?>
                  
            $('document').ready(function(){
                dataTableHistorico();
                resetData();

                if(filtro == 1){
                    $('#idDivlimpaConsulta').show();
                } else {
                    $('#idDivlimpaConsulta').hide();
                } 

                $('#idSelecao').on('change', function(){
                    if($('#idSelecao').val() == ''){
                        $('#iDivDatas').hide();
                    }else{
                        $('#iDivDatas').show();
                    }
                })

                $('#iConsulta').click(function(e){   
                    var select = $('#idSelecao').val();
                    var datas ="campo1="+select;

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

                    if(dataInicio != '' && dataFim != ''){
                        if(dataInicio > dataFim){
                            alert('Data de Inicio não pode ser maior que a final');
                        }else{
                            datas += '&campo2='+dataInicio+'&campo3='+dataFim;

                            e.preventDefault();

                            $.ajax({
                                url: "php/historicoFiltro.php",
                                type: "POST",
                                data: datas,
                                dataType: "html",
                                success: function(){        
                                    var table = $('#datatable').DataTable();
                                    table.destroy();
                                }
                            }).done(function() { 
                                dataTableHistorico();
                            }).fail(function() {
                                console.log("Request failed: ");

                            }).always(function() {
                                console.log("completou");
                            });
                        }
                    } else {
                        datas += '&campo2='+dataInicio+'&campo3='+dataFim;

                        e.preventDefault();

                        $.ajax({
                            url: "php/historicoFiltro.php",
                            type: "POST",
                            data: datas,
                            dataType: "html",
                            success: function(){  
                            }
                        }).done(function() { 
                                  
                            var table = $('#datatable').DataTable();
                                table.destroy();
                            dataTableHistorico();
                        }).fail(function() {
                            console.log("Request failed: ");

                        }).always(function() {
                            console.log("completou");
                        });
                    }                    
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