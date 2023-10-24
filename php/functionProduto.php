<?php 
    function optionMolde(){
        $select = "<option> Selecione uma opção </option>";

        $sql = "SELECT f.descricao, tipo.descricao"
                ." FROM ferramental as f"
                ." LEFT JOIN tipos_ferramental as tipo"
                ." ON f.idTipoFerramental = tipo.idTipoFerramental"
                ." WHERE f.ativo = 1";
    }
?>