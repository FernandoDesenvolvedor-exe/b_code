<?php  
/*
Validações
-Cadastro - ok
-Ativa/Desativa - ok
-Alterar - ok
-Insert classe - ok
-Insert tipo - ok
*/

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 
    

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php'); 

    $validacao = $_GET["validacao"];
    $abreHTMLalert = '<div class="input-group mb-3">'
                        .'<div class="input-group-prepend" style="width: 100%; height:100%;">'
                            .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>'; 

    if($validacao == 'IMP'){    //insert materia prima

        $descricao = stripslashes($_POST['nDescricao']);
        $quantidade = stripslashes($_POST['nQuandtidade']);
        $classe = stripslashes($_POST['nClasse']);       
        $tipoMaterial = stripslashes($_POST['nTipo']);
        $observacoes = stripslashes($_POST['nObservacoes']);
        $fornecedor = stripslashes($_POST['nFornecedor']);      
        if(!validarDado(4,$descricao)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../materiaPrima.php');
            die();
        }
        if(!validarDado(4,$observacoes)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../materiaPrima.php');
            die();
        }

        //Script SQL que insere na tabela materia_prima os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, ativo, observacoes)" 
                ." VALUES(".$classe.",".$tipoMaterial.",'".$descricao."',".$quantidade.", 1, '".$observacoes."');";

        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql);
        
        //Traz o id dos dados Inseridos acima na tabela 
        $idMaterial = buscaId("materia_prima","idMateriaPrima");

        $sql =" INSERT INTO materia_fornecedor(idMateriaPrima, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";
        
        $result = mysqli_query($conn,$sql);

        if (count($_POST['nPigmento']) > 0){ 

            for($n = 0; $n < count($_POST['nPigmento']); $n++){
                
                $sql = "INSERT INTO materia_pigmento(idMateriaPrima, idPigmento)"
                        ."VALUES(".$idMaterial.", ".$_POST['nPigmento'][$n].");";
    
                $result = mysqli_query($conn, $sql);
            } 
        }
        
        //fecha a conexão
        mysqli_close($conn);

    }else if($validacao == 'DMP') {  // Ativa/DESATIVA UM CADASTRO DE MATERIA_PRIMA
        include('connection.php');
        $sql= 'SELECT ativo FROM materia_prima WHERE idMateriaPrima = '.$_GET["idMateria"].';';
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }
            foreach($array as $campo){
                //echo $sql.'<br>'.$campo['ativo'].'<br>'.$_GET["idMateria"];die();
                if($campo['ativo']==1){
                    $sqlUpdate = 'UPDATE materia_prima SET ativo = 0 WHERE idMateriaPrima = '.$_GET["idMateria"].';';
                }else{
                    $sqlUpdate = 'UPDATE materia_prima SET ativo = 1 WHERE idMateriaPrima = '.$_GET["idMateria"].';';
                }
            }
        }
        $result = mysqli_query($conn,$sqlUpdate);
        mysqli_close($conn);

    }else if($validacao == 'UMP') {  // ATUALIZA UM CADASTRO DE MATERIA_PRIMA

        $descMat = stripslashes($_POST['nDescricao']);
        $obs = stripslashes($_POST['nObservacoes']);
        //TESTE: echo $descMat.''.validarDado(4,$descMat).' '.$obs.''.validarDado(4,$obs);die();
        if(!validarDado(4,$descMat)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../materiaPrima.php');
            die();
        }
        if(!validarDado(4,$obs)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../materiaPrima.php');
            die();
        }

        if (isset($descMat) == true && $descMat != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE materia_prima'
                    .' SET descricao ="'.$descMat.'"'
                    .' WHERE idMateriaPrima = '.$_GET['idMateria'].';';
        
            $result = mysqli_query($conn,$sql);
        }

        if (isset($_POST['nQuandtidade']) == true && $_POST['nQuandtidade'] != 0){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''

            $sql='UPDATE materia_prima'
                    .' SET quantidade ="'.($_GET['qtd'] + $_POST['nQuandtidade']).'"'
                    .' WHERE idMateriaPrima = '.$_GET['idMateria'].';';
        
            $result = mysqli_query($conn,$sql);
        }

        if (isset($obs) == true && $obs != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE materia_prima'
                    .' SET observacoes ="'.$obs.'"'
                    .' WHERE idMateriaPrima = '.$_GET['idMateria'].';';
        
            $result = mysqli_query($conn,$sql);  
        }

        if (isset($_POST['nClasse']) == true && $_POST['nClasse'] != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE materia_prima'
                    .' SET idClasse ="'.$_POST['nClasse'].'"'
                    .' WHERE idMateriaPrima = '.$_GET['idMateria'].';';
        
            $result = mysqli_query($conn,$sql);  
        }

        if (isset($_POST['nTipo']) == true && $_POST['nTipo'] != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE materia_prima'
                    .' SET idTipoMateriaPrima ="'.$_POST['nTipo'].'"'
                    .' WHERE idMateriaPrima = '.$_GET['idMateria'].';';

            $result = mysqli_query($conn,$sql);  
        }
        
        if (isset($_POST['nFornecedor']) == true && $_POST['nFornecedor'] != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''
            $sql='UPDATE materia_fornecedor'
                    .' SET idFornecedor ="'.$_POST['nFornecedor'].'"'
                    .' WHERE idMateriaPrima = '.$_GET['idMateria'].';';

            $result = mysqli_query($conn,$sql);        
        }
        
        mysqli_close($conn);

    }else if($validacao == 'iCM'){  //insert classe materia prima        

        $descricao = stripslashes($_POST['nClasse']);
        if(!validarDado(4,$descricao)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../materiaPrima.php');
            die();
        }

        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO classe_material(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

    }else if($validacao == 'ITM'){   // insert tipo materia prima
 
        $descricao = stripslashes($_POST['nTipoMateria']);
        if(!validarDado(4,$descricao)){
            $_SESSION['msgErro'] = $abreHTMLalert.'Apenas letras, numeros e caracters especiais (.,!,@,#,$,%,_,-).'.$fechaHTMLalert;
            header('location: ../materiaPrima.php');
            die();
        }
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO tipo_materia_prima(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

    }

    header('location: ../materiaPrima.php');
?>