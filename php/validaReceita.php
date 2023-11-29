<?php 
    include('function.php');
    include('connection.php');
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $abreHTMLalert = '<div class="input-group mb-3">'
                    .'<div class="input-group-prepend" style="width: 100%; height:100%;">'
                    .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    //----
    //GET
    $produto = $_GET["idProduto"];
    $nProduto = $_GET['pr'];
    //----
    //POST
    $material = $_POST['nMaterial']; 
    $qMaterial = intval($_POST['nQuantMaterial']);
    $qReciclado = intval($_POST['nQuantReciclado']);
    $pigmento = $_POST['nPigmento'];
    $porcentPigmento = intval($_POST['nQuantPigmento']);
    $observacoes = $_POST['nObservacoes'];
    $pesoPigmento = $qMaterial*($porcentPigmento/100);
    //Verifica se n foi selecionado
    //Verifica se o peso da receita é igual ao peso do produto
    $sql='select peso from produtos where idProduto='.$produto;
    $result= mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        $array = array();
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }
        foreach($array as $campo){
            if($campo['peso']+($campo['peso']*0.05)<$qMaterial){
                $_SESSION['error'] = $abreHTMLalert.'Peso total ultrapassa do peso do produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
            }else if($campo['peso']-($campo['peso']*0.05)>$qMaterial){
                $_SESSION['error'] = $abreHTMLalert.'Peso total insuficiente para fabricar o produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
            }
        }
    }
    $_SESSION['error'] = $abreHTMLalert.'Cadastrado!!!'.$fechaHTMLalert;
    header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
?>
