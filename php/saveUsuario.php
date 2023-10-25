<?php
    function saveUsuario($email, $senha, $nome, $sobrenome, $turma, $tipoUsu){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        include("connection.php");
        //____________________________________________Inserir dados no Banco___________________________________________________________________-
        $sqlInsert = "Insert into usuarios (login, senha, nome , sobrenome, idTurma, tipo , ativo) values"
                    ."('".$email."', md5('".$senha."'), '".$nome."' , '".$sobrenome."', ".intval($turma).", ".intval($tipoUsu)." , 1);";
        mysqli_query($conn, $sqlInsert);
        mysqli_close($conn);
        
    }
?>