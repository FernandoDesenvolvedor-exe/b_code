<?php 
    function validarDado($tipo,$dado){

        $condicao = '';
        $UTF8 = 'àèìòùÀÈÌÒÙáéíóúÁÉÍÓÚâêîôûÂÊÎÔÛãõÃÕçÇ';
        switch($tipo){
            case 1:
                //Nomes
                $condicao = '/^[A-Za-z'.$UTF8.'\s]+$/'; //Apenas letras e espaço
            case 2:
                //Email
                $condicao = '/^[A-Za-z0-9'.$UTF8.'.@]+$/';  //Apenas letras, numeros, ponto e @
            case 3:
                //Senha
                $condicao = '/^[A-Za-z0-9'.$UTF8.'.!@#$%_-]+$/';  //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).
            case 4:
                //Geral
                $condicao = '/^[A-Za-z0-9'.$UTF8.'\s.!@#$%_-]+$/'; //Apenas letras, numeros, espaço e caracters especiais (.,!,@,#,$,%,_,-).                
        }
        
        return preg_match($condicao,$dado);
    }
    // 1 - Apenas letras e espaço
    //2 - Apenas letras, numeros e ponto
    //Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).

    //àèìòùÀÈÌÒÙáéíóúÁÉÍÓÚâêîôûÂÊÎÔÛãõÃÕçÇ
?>