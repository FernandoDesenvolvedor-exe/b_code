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
    //GET
    $produto = $_GET["idProduto"];
    $nProduto = $_GET['pr'];
    //POST
    $material = $_POST['nMaterial']; 
    $qMaterial = intval($_POST['nQuantMaterial']);
    $qReciclado = intval($_POST['nQuantReciclado']);
    $pigmento = $_POST['nPigmento'];
    $porcentPigmento = intval($_POST['nQuantPigmento']);
    $observacoes = stripslashes($_POST['nObservacoes']);
    //--------VALIDA DADOS---------
    if(!validarDado(4,$observacoes) and $observacoes!=''){
        mysqli_close($conn);
        $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
        header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
        die(); 
    }
    //Verifica se o peso da receita esta dentro do limite de variação de 5% em relação ao peço do proutudo
    $sql='SELECT peso FROM produtos WHERE idProduto='.$produto;
    $result= mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        $array = array();
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }
        foreach($array as $campo){
            if($campo['peso']+($campo['peso']*0.05)<$qMaterial){
                mysqli_close($conn);
                $_SESSION['msgErro'] = $abreHTMLalert.'Peso total ultrapassa do peso do produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
                die();
            }else if($campo['peso']-($campo['peso']*0.05)>$qMaterial){
                mysqli_close($conn);
                $_SESSION['msgErro'] = $abreHTMLalert.'Peso total insuficiente para fabricar o produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
                die();
            }
        }
    }
    //VERIFICAR RELAÇÃO ENTRE MATERIAL E PIGMENTO
    $sql='SELECT * FROM materia_pigmento WHERE idMateriaPrima='.$material.' AND idPigmento='.$pigmento.';';
    $result= mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0 ){
        mysqli_close($conn);
        $_SESSION['msgErro'] = $abreHTMLalert.'<h4>Relação entre material e pigmento inexistente.</h4><br> Material não pode ser fabricado com este pigmento!'.$fechaHTMLalert;
        header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
        die();
    }

    //SEPARAÇÃO DO MATERIAL E PIGMENTO
    $pesoPigmento = $qMaterial*($porcentPigmento/100);
    $pesoMaterial = $qMaterial-$pesoPigmento;


    mysqli_close($conn);
    $_SESSION['msgErro'] = $abreHTMLalert.'Cadastrado!!!(FAKE) idMat:'.$material.' idPig:'.$pigmento.' Pig:'.$pesoPigmento.'g Mat:'.$pesoMaterial.'g'.mysqli_num_rows($result) .$fechaHTMLalert;
    header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
?>
