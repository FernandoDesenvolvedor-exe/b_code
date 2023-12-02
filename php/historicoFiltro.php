<?php
    session_start();
    $array = $_POST;    

    $_SESSION['filtroHistorico']    = '1 = 1';

    $select                         = $array['campo1'];
    $dataInicio                     = $array['campo2'];
    $dataFim                        = $array['campo3'];
    $_SESSION['filtro']             = 1;
        
    if($select == '1'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 1';

    } else if($select == '2'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 2';    

    } else if($select == '3'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 3';     

    } else if($select == '0'){
        $_SESSION['filtroHistorico'] .= ' AND statusPedido = 0';  

    } 
    
    $_SESSION['filtroHistorico'] .= ' GROUP BY idPedido';

?>