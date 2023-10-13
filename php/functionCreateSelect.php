<?php
function selectMateriaPrima(){

    // acessa a conexão com o banco de dados 
    include("connection.php");
            
    // Cria uma div com select e opções e salava na variavel $select
    // para um melhor exemplo va em https://themewagon.github.io/matrix-admin/form-basic.html
    // procure single-select
    $select = "<div class='form-group row'>"
                ."<label class='col-md-3 m-t-15'>Multiple Select</label>"
                ."<div class='col-md-9'>"
                ."<select class='select2 form-control m-t-15' multiple style='height: 36px; width: 100%;'>";
                
                //='multiple'
    //script sql a ser enviado ao banco de dados. Busca as informações solicitadas
    $sql = "SELECT mat.idMateriaPrima, mat.descricao as mat_desc, classe.descricao as class_desc, tipo.descricao as tipo_desc"
            ." FROM materia_prima as mat"
            ." LEFT JOIN classe_material as classe"
            ." ON mat.idClasse = classe.idClasse"
            ." RIGHT JOIN tipo_materia_prima as tipo"
            ." ON tipo.idTipoMateriaPrima = mat.idTipoMateriaPrima"
            ." ORDER BY classe.descricao, tipo.descricao;"; 
    
    //mysqli_query($conn,$sql) cria uma conexão com o banco de dados atraves de $conn,
    //executa o script sql na variavel $sql,
    //salva o resultado em $result
    //mysqli_close($conn) fecha a conexão
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    //este if verifica se foi encontrado um linha correspondente ao que foi enviado

    
    if(mysqli_num_rows($result) > 0){
        //Cria e inicializa uma array 
        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);
        }

        $num = 1;

        foreach($array as $campo){
            $idMateriaPrima = $campo['idMateriaPrima'];
            $materia_prima = $campo['mat_desc'];
            $classe = $campo['class_desc'];
            $tipo = $campo['tipo_desc'];

            //var_dump($tipo);
            //die();
            
            if($classe == 'Comodities'){
                $select .= "<optgroup label='".$classe."'>"
                                ."<option value='".$idMateriaPrima."'>".$materia_prima."</option>"
                                ."</optgroup>"                                
                                ."</optgroup>";
            }                      
        }

        $select .= "</select>"
                    ."</div>"
                    ."</div>";
    }

    return $select;
}
?>