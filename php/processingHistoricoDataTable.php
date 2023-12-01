<?php
    session_start();
    include('function.php');

    $filtros = '';    
    $filtros = $_SESSION['filtroHistorico'];
    $tabelaBD = 'historico_pedidos';
    $primaryKey = 'idHistorico';



    $columns = array(
                array( 'db' => 'idPedido',          'dt' => 0,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'nomeUsuario',       'dt' => 1,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'produto',           'dt' => 2,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'maquina',           'dt' => 3,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'statusPedido',      'dt' => 4,'formatter' => function($d, $row){
                    if($d == 1){
                        return 'Em Aberto';
                    } else if($d == 2){
                        return 'Em Andamento';
                    } else if($d == 3){
                        return 'Concluido';
                    } else if($d == 0){
                        return 'Cancelado';
                    }
                    
                    return $d;
                }),
                array( 'db' => 'dataHora_aberto',   'dt' => 5,'formatter' => function($d, $row){                    
                    if($d != ''){
                        $dataAberto =''.substr($d, 8, 2).'/';
                        $dataAberto .=''.substr($d, 5, 2).'/';
                        $dataAberto .=''.substr($d, 0, 4).'';
                        //return date( 'jS M y', strtotime($d)); -- retorna em formato 1fst Jun 23;
                        return $dataAberto; 
                    } else {
                        return 'Data não definida';
                    }
                    
                }),
                array( 'db' => 'idPedido',          'dt' => 6, 'formatter' => function($d, $row){
                    $status = consultaStatusHistoricoPedido($d);

                    if($status == 1 || $status == 3){
                        return                        
                            '<div class="d-flex row-flex align-center">
                                <div class="col-sm-5">
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="fas fa-eye text-info" data-toggle="modal" data-target="#modalPedido'.$d.'">
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="fas fa-times-circle text-danger" data-toggle="modal" data-target="#modalExclui'.$d.'">
                                    </a>
                                </div>
                            </div>'.modalVisualizarHistorico($d).'
                                  '.modalExcluiPedido($d);
            
                    } else if ($status == 2){
                        return
                        '<div class="d-flex row-flex align-center">                        
                            <div class="col-md-5">
                            </div>

                            <div class="col-md-2">
                                <a href="#" class="fas fa-eye text-info  align-right" data-toggle="modal" data-target="#modalPedido'.$d.'">
                                </a>
                            </div>
                        </div>'.modalVisualizarHistorico($d);

                    } else if($status == 0){
                        return
                            '<div class="d-flex row-flex align-right">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="fas fa-eye text-info" data-toggle="modal" data-target="#modalPedido'.$d.'">
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="fas fa-undo text-success" data-toggle="modal" data-target="#modalRestaura'.$d.'">
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="#" class="fas fa-times-circle text-danger" data-toggle="modal" data-target="#modalExclui'.$d.'">
                                    </a>
                                </div>
                            </div>  '.modalVisualizarHistorico($d).'
                                    '.modalExcluiPedido($d).'
                                    '.modalRestauraPedido($d);                     
                    } else {

                        return
                            'vazio';
                    }
                }));
    

    include('ajaxConnection.php');
    include('../ssp/ssp.class.php');

    $filtros;

    echo json_encode(
        SSP::complex( $_POST, $sql_details, $tabelaBD, $primaryKey, $columns, $filtros, null)
    );