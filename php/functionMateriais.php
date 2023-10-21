<?php        
    function optionsTipoPigmento(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";
        $sql = "SELECT * FROM tipo_pigmentos;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 1){
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

        if(mysqli_num_rows($result) > 1){
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

        if(mysqli_num_rows($result) > 1){
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

    function optionsMaterial(){
        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option>Selecione um material</option>";     
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

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

        return $select;        
    }

    function fillSelectFornecedor(){

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

    function fillSelectPigmento(){

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

    function createTable(){

        //Conexão com o banco de dados 
        include('connection.php');

        //Cria uma table e salva na variavel        
        $lista = "<table id='zero_config' class='table table-striped table-bordered'>"
                    ."<thead>"
                        ."<tr>"
                            ."<th>Name</th>"
                            ."<th>Position</th>"
                            ."<th>Office</th>"
                            ."<th>Age</th>"
                            ."<th>Start date</th>"
                        ."</tr>"
                    ."</thead>"
                    ."<tbody>";

        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas
        $sql= "SELECT mat.descricao as material, classe.descricao as classe, tipo.descricao as tipo, mat.idMateriaPrima as id , mat.quantidade as qtd" 
                ." FROM materia_prima as mat"
                ." LEFT JOIN classe_material as classe"
                ." ON mat.idClasse = classe.idClasse"
                ." LEFT JOIN tipo_materia_prima as tipo"
                ." ON mat.idTipoMateriaPrima = tipo.idTipoMAteriaPrima;";

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
                $lista.=" <tr>"
                            ." <td>".$campo['material']."</td>"
                            ." <td>".$campo['classe']."</td>"
                            ." <td>".$campo['tipo']."</td>"
                            ." <td>".$campo['id']."</td>"
                            ." <td>".$campo['qtd']."</td>"
                        ." </tr>";    
            }

            $lista.="</tbody>"
                    ."</table>";    
            
            /*var_dump($lista);
            die();*/
        }else{
            
            return('ERRO'); 
        }   

        return $lista;
    }
?>