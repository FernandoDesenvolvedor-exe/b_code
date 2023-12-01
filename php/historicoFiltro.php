<?php
    session_start();
    
    $radioChoice    = $_POST['radio'];
    $dataInicio     = $_POST['dataInicio'];
    $dataFim        = $_POST['dataFim'];

    if($_SESSION['filtro'] == 1){
            
        if(isset($radioChoice) == 1){
            $_SESSION['filtroHistorico'] .= ' AND statusPedido = 1';
    
        } else if(isset($radioChoice) == 2){
            $_SESSION['filtroHistorico'] .= ' AND statusPedido = 2';    
    
        } else if(isset($radioChoice) == 3){
            $_SESSION['filtroHistorico'] .= ' AND statusPedido = 3';     
    
        } else if(isset($radioChoice) == 0){
            $_SESSION['filtroHistorico'] .= ' AND statusPedido = 0';  
        } 
    
    }
    
    header('lcoation:../relatorios');
?>