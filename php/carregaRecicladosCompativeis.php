<?php     
    $array = $_POST;
    $option = '';
    
    if($array['campo1'] == 0){

    } else {
        include('connection.php');
        $sql = 'SELECT idClasse FROM materia_prima WHERE idMateriaPrima='.$array['campo1'].';';
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                $classe=$campo['idClasse'];
            }

        } 

        $sql='SELECT mat.idMateriaPrima as id,
                mat.descricao as nome,
                tipo.descricao as tipos,
                class.descricao as classe,
                f.descricao as fornecedor
                FROM materia_prima as mat
                LEFT JOIN tipo_materia_prima as tipo
                ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima
                LEFT JOIN classe_material as class
                ON mat.idClasse = class.idClasse
                RIGHT JOIN materia_fornecedor mf
                ON mat.idMateriaPrima = mf.idMateriaPrima
                RIGHT JOIN fornecedores f
                ON mf.idFornecedor = f.idFornecedor
                WHERE mat.ativo = 1
                AND mat.idTipoMateriaPrima = 2 
                AND mat.idClasse='.$classe.';';
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $option .='<option value="">Selecione uma opção</option>';

        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                $option .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']." - ".$campo['classe']." - ".$campo['fornecedor']."</option>";
            }

        } else {
            $option = '<option value="">Não há pigmentos compatíveis com este material</option>';
        }
    }
    

    echo $option;
?>