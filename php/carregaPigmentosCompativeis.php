<?php     
    $array = $_POST;
    $option = '';
    
    if($array['campo1'] == 0){

    } else {
        $sql='  SELECT p.idPigmento AS idPigmento, 
                    p.descricao AS pigmento, 
                    tp.descricao as tipo, 
                    f.descricao as fornecedor
                FROM materia_pigmento mp 
                LEFT JOIN pigmentos p 
                ON mp.idPigmento = p.idPigmento
                LEFT JOIN pigmento_fornecedor pf
                ON p.idPigmento = pf.idPigmento
                LEFT JOIN fornecedores f 
                ON pf.idFornecedor = f.idFornecedor
                LEFT JOIN tipo_pigmentos tp
                ON p.idTipoPigmento = tp.idTipoPigmento
                WHERE mp.idMateriaPrima = '.$array['campo1'].'
                AND p.ativo = 1;';

        include('connection.php');
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $option .='<option value="0">Transparente</option>';

        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                $option .='<option value="'.$campo['idPigmento'].'">'.$campo['pigmento'].' - '.$campo['tipo'].' - '.$campo['fornecedor'];
            }

        } else {
            $option = '<option value="">Não há pigmentos compatíveis com este material</option>';
        }
    }
    

    echo $option;
?>