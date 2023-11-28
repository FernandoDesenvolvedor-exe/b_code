<?php 
    function validarDado($tipo,$dado){

        $condicao = '';

        switch($tipo){
            case 1:
                //Nomes
                $condicao = '/^[A-Za-z\s]+$/'; //Apenas letras e espaço
            case 2:
                //Email
                $condicao = '/^[A-Za-z0-9.@]+$/';  //Apenas letras, numeros e ponto
            case 3:
                //Senha
                $condicao = '/^[A-Za-z0-9.!@#$%_-]+$/';  //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).
            default:
                //Geral
                $condição = '/^[A-Za-z0-9\s.!@#$%_-]+$/'; //Apenas letras, numeros, espaço e caracters especiais (.,!,@,#,$,%,_,-).
        }
        
        return preg_match($condicao,$dado);
    }
    // 1 - Apenas letras e espaço
    //2 - Apenas letras, numeros e ponto
    //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).
?>