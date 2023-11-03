<?php 

    function validaBanco($array) {

        include("connection.php");

        
        
    }
    function buscaId($tableName, $idName){

        include('connection.php');

        $sql = "SELECT MAX(".$idName.") as maior" 
                ." FROM ".$tableName.";";
        
        $id = '';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                $id = $campo['maior'];
                
            }
        }

        return $id;
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