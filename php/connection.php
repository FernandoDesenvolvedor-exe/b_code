<?php
        //Conexao com BD no servidor
        //$conn = mysqli_connect("minha-sa.com.br:3306","u638013300_labplasticos","Labplasticos@2023","u638013300_labplasticos") or die("Error: ".mysqli_connect_error());   

        // CONEXÃO BD PHPMyAdmin
        // localhost - loginhost - senhahost - nome do banco de dados 
        $conn = mysqli_connect("localhost","root","","lab_plasticos") or die("Error: ".mysqli_connect_error());
?>