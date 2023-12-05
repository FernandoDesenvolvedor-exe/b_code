<?php 
    include('function.php');
    include('connection.php');
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $abreHTMLalert = '<div class="input-group mb-3">'
                    .'<div class="input-group-prepend" style="width: 100%; height:100%;">'
                    .'<div class="alert alert-success" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    
    //Pegar dados validados por GET

    $produto        = $_GET['idProduto'];
    $nProduto       = $_GET['pr'];
    $material       = $_GET['mat'];
    $pesoMaterial   = $_GET['qMat'];
    $reciclado      = $_GET['rec'];
    $pesoReciclado  = $_GET['qRec'];
    $pigmento       = $_GET['pig'];
    $pesoPigmento   = $_GET['qPig'];
    $observacoes    = $_GET['obs'];

    //INSERT na tabela receita
    $sqlInsert = "Insert into receitas (idProduto,IdPigmento,quantidadePigmento,observacoes,ativo) values 
    (".$produto.",".$pigmento.",".$pesoPigmento.",'".$observacoes."',1);";
    mysqli_query($conn,$sqlInsert);

    //Pega ID da receita criada
    $idReceita=buscaId('receitas','idReceita');

    //INSERT idReceita, materia_prima e a quantidade_de_materia
    $sqlInsert = "Insert into receita_materia_prima (idReceita,idMateriaPrima,quantidadeMaterial) values
    (".$idReceita.",".$material.",".$pesoMaterial.")";
    
    if($reciclado != 0){
        $sqlInsert .=", (".$idReceita.",".$reciclado.",".$pesoReciclado.");";
    }
    
    //var_dump($sqlInsert);
    //die();
    mysqli_query($conn, $sqlInsert);
    mysqli_close($conn);
    
    $_SESSION['msgErro'] = $abreHTMLalert.'Receita cadastrada com sucesso ✔'.$fechaHTMLalert;
    header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
    die();
?>
