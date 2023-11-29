<?php

    $filtros = '1 = 1'; //$_SESSION['filtroHistorico'];

    $tabelaBD = 'historico_pedidos';
    $primaryKey = 'idHistorico';
    $idPedido = 1;
    $_SESSION['idPedido'] = '';

    $columns = array(
                array( 'db' => 'idPedido',      'dt' => 0,'formatter' => function($d, $row){
                    $_SESSION['idPedido'] = $d;
                    return $_SESSION['idPedido'];
                }),
                array( 'db' => 'nomeUsuario',   'dt' => 1,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'produto',       'dt' => 2,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'maquina',       'dt' => 3,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'statusPedido',  'dt' => 4,'formatter' => function($d, $row){
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
                array( 'db' => 'materiaPrima',  'dt' => 5,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'statusPedido',  'dt' => 6, 'formatter' => function($d, $row){
                    if($d != 0){
                        return
                        '<div class="div1">   
                            <a href="" class=""></a>                                                                      
                            <button style="width: auto; border-radius: 5px;" type="button;" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$_SESSION['idPedido'].'">
                                Visualizar
                            </button>
                        </div>
                        <div class="div2">
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$_SESSION['idPedido'].'">
                                Desativar
                            </button>
                        </div>';
            
                    } else {
            
                        return
                        '<div class="div2">
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalRestaura'.$_SESSION['idPedido'].'">
                                Desativar
                            </button>
                        </div>
                        <div class="div2">
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$_SESSION['idPedido'].'">
                                Desativar
                            </button>
                        </div>';
                    }
                }));
    

    include('ajaxConnection.php');
    include('ssp.class.php');
    echo json_encode(
        SSP::complex( $_POST, $sql_details, $tabelaBD, $primaryKey, $columns, null, $filtros)
    );


/*
    ,'formatter' => function($d, $row){
        if($d != 0){
            
            '<div class="div1">                                                                         
                <button style="width: auto; border-radius: 5px;" type="button;" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$campo['pedidoId'].'">
                    Visualizar
                </button>
            </div>
            return
            '<div class="div2">
                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$idPedido.'">
                    Desativar
                </button>
            </div>'.modalExcluiPedido($idPedido);

        } else {

            return
            '<div class="div2">
                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalRestaura'.$idPedido.'">
                    Desativar
                </button>
            </div>
            <div class="div2">
                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$idPedido.'">
                    Desativar
                </button>
            </div>'.modalRestauraPedido($idPedido).'
            '.modalExcluiPedido($idPedido).'';
        }

    }
    */