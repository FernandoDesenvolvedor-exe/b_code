<?php
    function sqlSelect($filtrar){
        
        if($filtrar == 0){
            $sql = 'SELECT * FROM historico_pedidos ORDER BY idPedido DESC;';
        } else {
            
        }
        return $sql;
    }    
?>