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
        $sql = "INSERT INTO fornecedores(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        if ($_GET['pg'] == 'P'){

            header('location:../pigmentos.php');
            die();

        } else if ($_GET['pg'] == 'M'){

            header('location:../materiaPrima.php');
            die();
        }

    } else if($validacao == 'U'){

        if ($_GET['pg'] == 'P'){

            header('location:../pigmentos.php');
            die();

        } else if ($_GET['pg'] == 'M'){

            header('location:../materiaPrima.php');
            die();
        }

    } else if($validacao == 'D'){

        if ($_GET['pg'] == 'P'){

            header('location:../pigmentos.php');
            die();

        } else if ($_GET['pg'] == 'M'){

            header('location:../materiaPrima.php');
            die();
        }
    }

?>