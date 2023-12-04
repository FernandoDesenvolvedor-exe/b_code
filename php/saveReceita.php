<?php 
    function(){
        header('location: ../saveReceita.php?idProduto='.$produto.'&pr='.$nProduto.'&mat='.$material.'&qMat='.$pesoMaterial.'&qRec='.$qReciclado.'&pig='.$pigmento.'&qPig='.$pesoPigmento.'&obs='.$observacoes);
        $produto=$_GET['idProduto'];
        $nProduto=$_GET['pr'];
        $material=$_GET['mat'];
        $pesoMaterial=$_GET['qMat'];
        $qReciclado=$_GET['qRec'];
        $pigmento=$_GET['pig'];
        $pesoPigmento=$_GET['qPig'];
        $observacoes=$_GET['obs'];
        //INSERT na tabela receita

        include('connection.php');
        $sqlInsert = "Insert into receitas (idProduto,IdPigmento,quantidadePigmento,observacoes,ativo) values (".$produto.",".$pigmento.",".$pesoPigmento.",'".$observacoes."',1);";
        mysqli_query($conn,$sqlInsert);
        mysqli_close();

        //Pega ID da receita criada
        $id = buscaId('receitas','idReceita');
        //INSERT idReceita, materia_prima e a quantidade_de_materia
        $sqlInsert = "Insert into receita_materia_prima (idReceita,idMateriaPrima,quantidadeMaterial) values
        (".$idReceita.",".$material.",".$pesoMaterial.");";            
        
        //INSERT NA TABELA          
        include('connection.php');        
        mysqli_query($conn, $sqlInsert);
        mysqli_close($conn);
        //$_SESSION['error'] = $abreHTMLalert.'Receita cadastrada com sucesso ✔👍'.$fechaHTMLalert;
        header('location: ../cadastroReceitas.php?idProduto='.$produto.'&pr='.$nProduto);
        die();
    }
    
    //unico material virgem 
    //material virgem n mistura
    //peso receita varia 5%
    //maximo de 6% de pigmento
    
    //salva tbm na receita
    //salva reciclado no mesmo pedido e borra
    //Estimativa de tempo da produção de um pedido
?>
