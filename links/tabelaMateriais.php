<?php
include('php/connection.php');
$sql = 'SELECT mat.idMateriaPrima as id,
        mat.descricao as nome,
        tipo.descricao as tipos,
        class.descricao as classe
        FROM materia_prima as mat
        LEFT JOIN tipo_materia_prima as tipo
        ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima
        LEFT JOIN classe_material as class
        ON mat.idClasse = class.idClasse
        WHERE mat.ativo = 1
        AND mat.idTipoMateriaPrima = 1
        OR mat.idTipoMateriaPrima = 2;';
$result = mysqli_query($conn,$sql);
mysqli_close($conn);
//if(isset($_SESSION['opMateriais']) && $_SESSION['opMateriais'] == ''){  
    //echo $_SESSION['opMateriais'];
    // unset($_SESSION['opMateriais']);
    
//}
if(mysqli_num_rows($result) > 0){
    //Cria e inicializa uma array 
    $array = array();

    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        array_push($array, $linha);
    }
    $vet = [];
    foreach($array as $campo){
        for($i=0; $i<count($_SESSION['materiais']); $i++){
            if($_SESSION['materiais'][$i]==$campo['id']){
                echo    '<tr>
                    <th>
                        <label class="customcheckbox">
                            <input value='.$campo['id'].' name="tableMateriais[]" type="checkbox" class="listCheckbox" />
                            <span class="checkmark"></span>
                        </label>
                    </th>
                    <td>'.$campo['nome'].'</td>
                    <td>'.$campo['tipos'].'</td>
                    <td>'.$campo['classe'].'</td>
                    <td>1200'
                    //<input step="50" id="iQuandtidade" name="nQuandtidade" type="Number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade" style="width:50%;" min="0">
                    .'</td>
                </tr>'; 
                $vet[]= $campo['id'];//.' '.$campo['nome']; 
            }
            
        }  
                      
    }
        $_SESSION['materiais'] = $vet;
        echo ' Vetor 2 : ';
        //echo $vet;
        for($i=0; $i<count($_SESSION['materiais']); $i++){
            echo $_SESSION['materiais'][$i];
        };
        
        //echo $_SESSION['materiais'];
        unset($vet);
    
}
?>