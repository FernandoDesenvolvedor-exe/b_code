<?php 
    include('function.php');  
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 
    $material=$_POST['tableMateriais'];
    $pigmento=$_POST['nPigmento'];
    $quant=[];
    //CRIA UM VETOR DE QUANTIDADE COM A MESMA POSIÇÃO QUE O VETOR MATERIAL
    for($i=0;$i<count($material);$i++){
        $quant[]=$_POST['nQuantidade'.$material[$i]];
    }
    //TESTE
    for($i=0;$i<count($material);$i++){
        echo $material[$i].' quant:'.$quant[$i].' |';
    }
    
    die();

?>
