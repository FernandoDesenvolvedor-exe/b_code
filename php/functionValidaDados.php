<?php 
    function validarDado($tipo,$dado){
        switch($tipo){
            case 1:
                $condicao = '/^[A-Za-z\s]+$/'; //Apenas letras e espaço
            case 2:
                $condicao = '/^[A-Za-Z0-9.@]+$/';  //Apenas letras, numeros e ponto
            case 3:
                $condicao = '/^[A-Za-Z0-9.!@#$%_-]+$/';  //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).
        }
        return preg_match($condicao,$dado);
    }
?>