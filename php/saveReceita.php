<?php 
    include('function.php');  
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    
    $material=$_POST['tableMateriais'];
    $pigmento=$_POST['nPigmento'];
    $pesoPigmento = $_POST['nQuantPigmento'];
    $quant=[];
    $pesoMaterial=0;
    //CRIA UM VETOR DE QUANTIDADE COM A MESMA POSIÇÃO QUE O VETOR MATERIAL
    for($i=0;$i<count($material);$i++){
        $quant[]=$_POST['nQuantidade'.$material[$i]];
        $pesoMaterial+=intval($_POST['nQuantidade'.$material[$i]]);
    }
    $pesoTotal=$pesoMaterial+intval($pesoPigmento);
    //TESTE
    for($i=0;$i<count($material);$i++){
        echo $material[$i].' quant:'.$quant[$i].' |';
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
