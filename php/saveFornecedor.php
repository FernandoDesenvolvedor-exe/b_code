<?php
    
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php'); 

    $validacao = $_GET["validacao"];   

    if($validacao == 'I') { //insert fornecedor

        $descricao = stripslashes($_POST['nFornecedor']);
        //Script SQL que insere na tabela fornecedores os valores indicados, id é AUTO-INCREMENT
        $sql = 'INSERT INTO fornecedores(descricao, ativo)'
                .' VALUES("'.$descricao.'", 1);';

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

    } else if($validacao == 'U'){

        $sql = 'UPDATE fornecedores SET descricao = "'.$_POST['nDescricao'].'" WHERE idFornecedor = '.$_GET['id'].'';

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

    } else if($validacao == 'D'){

        $sql = 'UPDATE fornecedores SET ativo = 0 WHERE idFornecedor = '.$_GET['id'].'';

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);
    
    }

    header('location:../fornecedores.php');

?>