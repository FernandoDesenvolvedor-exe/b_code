<?php 
    function alert($tipo, $titulo, $mensagem){
        switch($tipo){
            case 1:
                $alert="toastr.success('".$mensagem."', '".$titulo."');";
            case 2:
                $alert="toastr.info('".$mensagem."', '".$titulo."');";
            case 3:
                $alert="toastr.warning('".$mensagem."', '".$titulo."');";
            case 4:
                $alert="toastr.error('".$mensagem."', '".$titulo."');";
        }
        return $alert;
    }

/*
________No arquivo html (tela do cadastro) colocar no final depois do include do script
<script>
    <?php 
        if(isset($_SESSION['msgAlert'])){
            echo $_SESSION['msgAlert'];
            unset($_SESSION['msgAlert']);
        
        }
    ?>
</script>

________No arquivo de validação
[...]
if(validacao){
    //executar codigos...
}else{
    //alerta
    $_SESSION['msgAlert'] = alert(tipo, "titulo aqui", "mensagem aqui");
}
*/
?>