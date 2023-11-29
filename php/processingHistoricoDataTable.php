<?php

    $filtros = $_SESSION['filtroHistorico'];

    $tabelaBD = 'historico_pedidos';
    $primaryKey = 'idHistorico';
    $columns = array(
                array( 'db' => 'idPedido',      'dt' => 'idPedido' ),
                array( 'db' => 'nomeUsuario',   'dt' => 'nomeUsuario' ),
                array( 'db' => 'produto',       'dt' => 'produto' ),
                array( 'db' => 'maquina',       'dt' => 'maquina' ),
                array( 'db' => 'statusPedido',  'dt' => 'statusPedido' ),
                array( 'db' => 'materiaPrima',  'dt' => 'materiaPrima' ),
                array( 'db' => 'pigmento',      'dt' => 'pigmento'));
    

    $sql_details = array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'db'   => 'lab_plasticos'
    );

    include('ssp.class.php');
    echo json_encode(
        SSP::simple( $_POST, $sql_details, $tabelaBD, $primaryKey, $columns )
    );

