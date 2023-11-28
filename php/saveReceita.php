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
    //Verifica se foi selecionado material
    if(!isset($_POST['tableMateriais'])){
        $_SESSION['error'] = $abreHTMLalert.'Escolha um material!'.$fechaHTMLalert;
        header('location: ../cadastroReceitas.php?idProduto='.$_GET["idProduto"].'&pr='.$_GET['pr']);
    }
    $produto = $_GET["idProduto"];
    $nProduto = $_GET['pr'];
    //id de cada material
    $material = $_POST['tableMateriais']; //<<-- VETOR
    $pigmento = $_POST['nPigmento'];
    $porcentPigmento = intval($_POST['nQuantPigmento']);
    $quant = [];
    $observacoes = $_POST['nObservacoes'];
    $pesoMaterial = 0;//inicializa var
    for($i=0;$i<count($material);$i++){
        //CRIA UM VETOR DE QUANTIDADE COM A MESMA POSIÇÃO QUE O VETOR MATERIAL
        $quant[]=intval($_POST['nQuantidade'.$material[$i]]);
        $pesoTotal+=intval($_POST['nQuantidade'.$material[$i]]);
    }
    $pesoPigmento = $pesoTotal*($porcentPigmento/100);
    //Verifica se o peso da receita é igual ao peso do produto
    $sql='select peso from produtos where idProduto='.$produto;
    $result= mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        $array = array();
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }
        foreach($array as $campo){
            if($campo['peso']+($campo['peso']*0.05)<$pesoTotal){
                $_SESSION['error'] = $abreHTMLalert.'Peso total ultrapassa do peso do produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
            }else if($campo['peso']-($campo['peso']*0.05)>$pesoTotal){
                $_SESSION['error'] = $abreHTMLalert.'Peso total insuficiente para fabricar o produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
            }
        }
    }
    //INSERT na tabela receita
    $sqlInsert = "Insert into receitas (idProduto,IdPigmento,quantidadePigmento,observacoes,ativo) values (".$produto.",".$pigmento.",".$pesoPigmento.",'".$observacoes."',1);";
    mysqli_query($conn,$sqlInsert);
    //Pega ID da receita criada
    $sql='SELECT MAX(idReceita) as idReceita from receitas;';
    $result= mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        $array = array();
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }
        foreach($array as $campo){
            $idReceita=$campo['idReceita'];
        }
    }
    //INSERT idReceita, materia_prima[] e a quantidade_de_materia[]
    $sqlInsert = "Insert into receita_materia_prima (idReceita,idMateriaPrima,quantidadeMaterial) values ";
    for($i=0;$i<count($material);$i++){
        //$quant[]=$_POST['nQuantidade'.$material[$i]];
        $sqlInsert= $sqlInsert."(".$idReceita.",".$material[$i].",".($quant[$i]-($quant[$i]*($porcentPigmento/100)))." )";
        if($i<count($material)-1){
            $sqlInsert=$sqlInsert.",";
        }
    }
    $sqlInsert=$sqlInsert.';';
    //INSERT NA TABELA           
    mysqli_query($conn, $sqlInsert);
    mysqli_close($conn);
    $_SESSION['cadastrar']=true;
    $_
    //$_SESSION['error'] = $abreHTMLalert.'Receita cadastrada com sucesso ✔👍'.$fechaHTMLalert;
    header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
    die();
    //unico material virgem 
    //material virgem n mistura
    //peso receita varia 5%
    //maximo de 6% de pigmento
    
    //salva tbm na receita
    //salva reciclado no mesmo pedido e borra
    //Estimativa de tempo da produção de um pedido
?>
