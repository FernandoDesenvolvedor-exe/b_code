<?php
    session_start();
    $array = $_POST;    

    $_SESSION['filtroHistorico']    = '1 = 1';

    $select                         = $array['campo1'];
    $dataInicio                     = $array['campo2'];
    $dataFim                        = $array['campo3'];
        
    if($select == '1'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 1';

    } else if($select == '2'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 2';    

    } else if($select == '3'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 3';     

    } else if($select == '0'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 0';  

    } 

    if($dataInicio !=  ''){
        $_SESSION['filtroHistorico'] .= ' AND DATE_FORMAT(dataHora_aberto, "%Y-%m-%d") >= '.$dataInicio.'';  
    }

    if($dataFim != ''){
        $_SESSION['filtroHistorico'] .= ' AND DATE_FORMAT(dataHora_aberto, "%Y-%m-%d") >= '.$dataFim.'';  
    }

?>