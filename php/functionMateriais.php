<?php        
    function optionTipoPigmento(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";
        $sql = "SELECT * FROM tipo_pigmentos;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }

            foreach($array as $campo){
                $select .= "<option value ='".$campo['idTipoPigmento']."'>".$campo['descricao']."</option>";
            }
        }

        return $select;
    }

    function optionTipoMaterial(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";
        $sql = "SELECT * FROM tipo_materia_prima WHERE ativo = 1;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }

            foreach($array as $campo){
                $select .= "<option value ='".$campo['idTipoMateriaPrima']."'>".$campo['descricao']."</option>";
            }
        }

        return $select;
    }

    function optionClaseMaterial(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";
        $sql = "SELECT * FROM classe_material WHERE ativo = 1;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }

            foreach($array as $campo){
                $select .= "<option value ='".$campo['idClasse']."'>".$campo['descricao']."</option>";
            }
        }

        return $select;
    }    

    function optionMaterial($caso){
        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option>Selecione um opção</option>";     
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

        if($caso = 1){
            $sql = "SELECT mat.idMateriaPrima as id, mat.descricao as nome,"
                ." tipo.descricao as tipos," 
                ." class.descricao as classe"
                ." FROM materia_prima as mat"
                ." LEFT JOIN tipo_materia_prima as tipo"
                ." ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima"
                ." LEFT JOIN classe_material as class"
                ." ON mat.idClasse = class.idClasse"
                ." WHERE mat.ativo = 1;";
            
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
            
            foreach($array as $campo){
                
                $select .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']." - ".$campo['classe']."</option>";                                  
                                                     
            }
        }     

        }else if($caso == 2){

            $sql="SELECT mat.descricao as material,"
                ." mat.idMateriaPrima as idMaterial,"
                ." tipo.descricao as tipoMaterial,"
                ." classe.descricao as matClass,"
                ." FROM materia_fornecedor as relacao"
                ." INNER JOIN materia_prima as mat"
                ." ON mat.idMateriaPrima = relacao.idMateriaPrima"
                ." LEFT JOIN tipo_materia_prima as tipo"
                ." ON tipo.idTipoMateriaPrima = mat.idTipoMateriaPrima"
                ." LEFT JOIN classe_material as classe"
                ." ON classe.idClasse = mat.idClasse;"
                ." LEFT JOIN fornecedores as f"
                ." ON f.idFornecedor = relacao.idFornecedor"
                ." WHERE mat.ativo = 1;";

            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);

            if(mysqli_num_rows($result) > 0){
                $array = array();

                while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    array_push($array, $linha);
                }

                foreach($array as $campo){
                    $select .= "<option value='".$campo['idMaterial']."'></option>";
                }
            }
        }       
       
        return $select;        
    }

    function optionFornecedor(){

        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option>Selecione um Fornecedor</option>";     
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

        $sql = "SELECT * FROM fornecedores"
                ." WHERE ativo = 1;";
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
            
            foreach($array as $campo){
                
                $select .="<option value=".$campo['idFornecedor'].">".$campo['descricao']."</option>";                                  
                                                     
            }
        }     
        
        return $select;
    }

    function optionPigmento(){

        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option>Selecione um pigmento</option>";     
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

        $sql = "SELECT p.idPigmento as id, p.descricao as nome, tipo.descricao as tipos" 
                ." FROM pigmentos as p"
                ." LEFT JOIN tipo_pigmentos as tipo"
                ." ON p.idTipoPigmento = tipo.idTipoPigmento"
                ." WHERE p.ativo = 1;";

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
            
            foreach($array as $campo){
                
                $select .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']."</option>";                                  
                                                     
            }
        }

        return $select;
    }    
?>