<?php
    function validaFuncao($funcao){

        include('function.php');
        
        if($funcao == 1){
            echo createSelectMateriaPrima();
        }else if($funcao == 2){
            echo createSelectPigmento();
        }
        }
?>
