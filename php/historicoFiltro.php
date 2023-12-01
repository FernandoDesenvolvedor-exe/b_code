<?php
    session_start();

    $_SESSION['filtroHistorico']    = '1 = 1';
    $select                         = $_GET['selecao'];
    $dataInicio                     = $_GET['dataInicio'];
    $dataFim                       = $_GET['dataFim'];
           
    if(isset($select) == 1){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 1';

    } else if(isset($select) == 2){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 2';    

    } else if(isset($select) == 3){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 3';     

    } else if(isset($select) == 0){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 0';  

    } 
?>