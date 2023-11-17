<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}  
include('php/connection.php');
$sql = 'SELECT mat.idMateriaPrima as id,
        mat.descricao as nome,
        mat.ativo as ativo,
        tipo.descricao as tipos,
        class.descricao as classe
        FROM materia_prima as mat
        LEFT JOIN tipo_materia_prima as tipo
        ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima
        LEFT JOIN classe_material as class
        ON mat.idClasse = class.idClasse
        WHERE mat.ativo = 1
        AND (mat.idTipoMateriaPrima = 1
        OR mat.idTipoMateriaPrima = 2);';
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
    foreach($array as $campo){
                echo    '<tr>
                    <th>
                        <label class="customcheckbox">
                            <input value='.$campo['id'].' name="tableMateriais[]" type="checkbox" class="listCheckbox" />
                            <span class="checkmark"></span>
                        </label>
                    </th>
                    <td>'.$campo['nome'].'</td>
                    <td>'.$campo['tipos'].'</td>
                    <td>'.$campo['ativo'].'</td>
                    <td>
                    <input id="iQuantidade" name="nQuantidade'.$campo['id'].'" type="Number" class="form-control" placeholder="Quantidade" style="width:50%;" min=0>
                    </td>
                </tr>'; 
                       
    }
}
?>