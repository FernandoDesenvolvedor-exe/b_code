<?php 
    
    if($_GET['validacao'] == 'D'){

        include('connection.php');
        $sql='DELETE FROM historico_pedidos WHERE idPedido='.$_GET['id'].';';

        $result=mysqli_query($conn,$sql);
        mysqli_close($conn);        

        include('connection.php');        
        $sql='DELETE FROM pedidos WHERE idPedido='.$_GET['id'].';';
        $result=mysqli_query($conn,$sql);
        mysqli_close($conn);

        header('location:../relatorios');
    }

?>