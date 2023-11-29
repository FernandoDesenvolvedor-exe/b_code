<?php
    session_start();

    while($row=sqlsrv_fetch_object($result)){
        $row_array['ID'] = $row->ID;
        $row_array['second'] = $row->second;
        $row_array['third'] = $row->third;
        $row_array['fourth'] = $row->fourth;
        $row_array['fifth'] = $row->fifth;
        $row_array['six'] = $row->six;
     
        array_push($data['data'],$row_array);
    }
     
    echo json_encode($data);

    
    $_SESSION['filtro'] = $_GET['filtro'];

    $_SESSION['filtroHistorico'] = 'WHERE 1 = 1 ';
    
    if(isset($_POST['readio-stacked']) == 1){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 1';

    } else if(isset($_POST['readio-stacked']) == 2){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 2';    

    } else if(isset($_POST['readio-stacked']) == 3){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 3';     

    } else if(isset($_POST['readio-stacked']) == 4){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 4';  
    }

    $_SESSION['filtroHistorico'] .= 'ORDER BY idPedido';
    
    header('lcoation:../relatorios');
?>