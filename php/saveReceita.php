<?php 
    include('function.php');  
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
        header('location: ../cadastroReceitas.php');
    }
    //id de cada material
    $material=$_POST['tableMateriais'];
    $pigmento=$_POST['nPigmento'];
    $pesoPigmento = $_POST['nQuantPigmento'];
    $quant=[];
    $pesoMaterial=0;
    
    //CRIA UM VETOR DE QUANTIDADE COM A MESMA POSIÇÃO QUE O VETOR MATERIAL
    for($i=0;$i<count($material);$i++){
        //Verifica se um material n tem quantidade
        if(intval($_POST['nQuantidade'.$material[$i]])==0){
            $_SESSION['error'] = $abreHTMLalert.'Escolha uma quantidade para cada material selecionado!'.$fechaHTMLalert;
            header('location: ../cadastroReceitas.php');
        }
        $quant[]=$_POST['nQuantidade'.$material[$i]];
        $pesoMaterial+=intval($_POST['nQuantidade'.$material[$i]]);
    }

    $pesoTotal=$pesoMaterial+intval($pesoPigmento);
    
    //TESTE
    for($i=0;$i<count($material);$i++){
        echo $material[$i].' Tipo:'.' '.gettype($material[$i]).' quant:'.$quant[$i].' |';
    }
    echo $pigmento.' Quant:'.$pesoPigmento.'<br>';
    echo 'PesoTotal:'.$pesoTotal.'<br>';
    /*
    echo '<br>';
    $matriz=[];
    for($a= 0;$a<10;$a++){
        $matriz[$a]=[];
        echo '[';
        for($i= 0;$i<10;$i++){
            $matriz[$a][$i]=rand(0,9);
            echo $matriz[$a][$i];
            if($i<10){
                echo ',';
            }
        }
        echo ']<br>';
    }*/

    die();

?>
