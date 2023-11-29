<?php
    session_start();

    if($_SESSION['filtro'] == 0){
        $_SESSION['filtroHistorico'] = '1 = 1';
    } else {
    
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
    }
    
    header('lcoation:../relatorios');
?>