<?php   
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    } 

    $_SESSION['msgLogin'] = '';

    include('connection.php');
    include('function.php'); 

    $validacao = $_GET["validacao"];   

    if($validacao == 'IMP'){    //insert materia prima

        $descricao = stripslashes($_POST['nDescricao']);
        $quantidade = stripslashes($_POST['nQuandtidade']);
        $classe = stripslashes($_POST['nClasse']);       
        $tipoMaterial = stripslashes($_POST['nTipo']);
        $observacoes = stripslashes($_POST['nObservacoes']);
        $fornecedor = stripslashes($_POST['nFornecedor']);

        //Script SQL que insere na tabela materia_prima os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO materia_prima(idClasse, idTipoMateriaPrima, descricao, quantidade, ativo, observacoes)" 
                ." VALUES(".$classe.",".$tipoMaterial.",'".$descricao."',".$quantidade.", 1, '".$observacoes."');";

        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql);  
        
        //Traz o id dos dados Inseridos acima na tabela 
        $idMaterial = buscaId("materia_prima","idMateriaPrima");

        $sql =" INSERT INTO materia_fornecedor(idMateriaPrima, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";
        
        $result = mysqli_query($conn,$sql);
        
        //fecha a conexão
        mysqli_close($conn);

    }else if($validacao == 'DMP') {  // DESATIVA UM CADASTRO DE MATERIA_PRIMA

        $sql='UPDATE materia_prima SET ativo = 0 WHERE idMateriaPrima = '.$_GET['idMateria'].';';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

    }else if($validacao == 'UMP') {  // ATUALIZA UM CADASTRO DE MATERIA_PRIMA

        $descMat = stripslashes($_POST['nDescricao']);
        $qtde = stripslashes($_POST['nQuandtidade']); 
        $obs = stripslashes($_POST['nObservacoes']);        

        if (isset($descMat) == true && $descMat != ""){  //SE DESCRICAO FOR DIFERENTE DE NULL OU ''

            if (isset($_POST['nClasse']) == true && $_POST['nClasse'] != ""){  

                if (isset($_POST['nTipo']) == true && $_POST['nTipo'] != ""){

                    if (isset($qtde) == true && $qtde != ""){  

                        if (isset($obs) == true && $obs != ""){ 
                            
                            $sql='UPDATE materia_prima'
                                    .' SET idClasse = '.$_POST['nClasse'].','
                                    .' idTipoMateriaPrima = '.$_POST['nTipo'].','
                                    .' descricao ="'.$descMat.'",'
                                    .' quantidade = '.$qtde.','
                                    .' observacoes = '.$obs.','
                                    .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                        } else{
                            
                            $sql='UPDATE materia_prima'
                                    .' SET idClasse = '.$_POST['nClasse'].','
                                    .' idTipoMateriaPrima = '.$_POST['nTipo'].','
                                    .' descricao ="'.$descMat.'",'
                                    .' quantidade = '.$qtde.','
                                    .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                        }

                    }else {

                        $sql='UPDATE materia_prima'
                                .' SET idClasse = '.$_POST['nClasse'].','
                                .' idTipoMateriaPrima = '.$_POST['nTipo'].','
                                .' descricao ="'.$descMat.'",'
                                .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                    }

                } else{

                    $sql='UPDATE materia_prima'
                            .' SET idClasse = '.$_POST['nClasse'].','
                            .' descricao ="'.$descMat.'",'
                            .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                }
            }else {

                $sql='UPDATE materia_prima'
                        .' descricao ="'.$descMat.'",'
                        .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

            }       

        } else{   //SE DESCRICAO FOR = A NULL OU ''

            if (isset($_POST['nClasse']) == true && $_POST['nClasse'] != ""){  

                if (isset($_POST['nTipo']) == true && $_POST['nTipo'] != ""){

                    if (isset($qtde) == true && $qtde != ""){  

                        if (isset($obs) == true && $obs != ""){ 
                            
                            $sql='UPDATE materia_prima'
                                    .' SET idClasse = '.$_POST['nClasse'].','
                                    .' idTipoMateriaPrima = '.$_POST['nTipo'].','
                                    .' quantidade = '.$qtde.','
                                    .' observacoes = '.$obs.','
                                    .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                        } else{
                            
                            $sql='UPDATE materia_prima'
                                    .' SET idClasse = '.$_POST['nClasse'].','
                                    .' idTipoMateriaPrima = '.$_POST['nTipo'].','
                                    .' quantidade = '.$qtde.','
                                    .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                        }

                    }else {

                        $sql='UPDATE materia_prima'
                                .' SET idClasse = '.$_POST['nClasse'].','
                                .' idTipoMateriaPrima = '.$_POST['nTipo'].','
                                .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                    }

                } else{

                    $sql='UPDATE materia_prima'
                            .' SET idClasse = '.$_POST['nClasse'].','
                            .' id WHERE idMateriaPrima = '.$_GET['idMateria'].';';

                }
            }else {

                $_SESSION['msg'] = 'Nenhuma alteração foi feita';

                header('location: ../materiaPrima.php');
                die();

            } 
        }            
        
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

    }else if($validacao == 'IPG') {    //insert pigmento

        $descricao = stripslashes($_POST['nDescricao']);
        $quantidade = stripslashes($_POST['nQuandtidade']);          
        $tipoMaterial = stripslashes($_POST['nTipo']);
        $observacoes = stripslashes($_POST['nObservacoes']);
        $fornecedor = stripslashes($_POST['nFornecedor']);
        $codigo = stripslashes($_POST['nCodigo']);
        $lote = stripslashes($_POST['nLote']);   

        //Script SQL que insere na tabela pigmentos so valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO pigmentos(descricao, idTipoPigmento, quantidade, codigo, lote, ativo, observacoes)" 
                ." VALUES('".$descricao."',".$tipoMaterial.",".$quantidade.",'".$codigo."','".$lote."', 1, '".$observacoes."');";

        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql); 

        //Traz o id dos dados Inseridos acima na tabela 
        $idMaterial = buscaId("pigmentos","idPigmento");

        //Script SQL a ser enviado ao banco de dados
        $sql =" INSERT INTO pigmento_fornecedor(idPigmento, idFornecedor) VALUES (".$idMaterial.",".$fornecedor.");";
        
        //envia um script sql para o banco de dados executar
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroPigmento.php');

    }else if($validacao == 'IF') { //insert fornecedor

        $descricao = stripslashes($_POST['nFornecedor']);
        //Script SQL que insere na tabela fornecedores os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO fornecedores(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');

    }else if($validacao == 'iCM'){  //insert classe materia prima        

        $descricao = stripslashes($_POST['nClasse']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO classe_material(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');

    }else if($validacao == 'ITM'){   // insert tipo materia prima
 
        $descricao = stripslashes($_POST['nTipoMateria']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO tipo_materia_prima(descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');

    }else if($validacao == 'ITP'){    // insert tipo pigmentos

        $descricao = stripslashes($_POST['nTipoPigmento']);
        //Script SQL que insere na tabela classe_material os valores indicados, id é AUTO-INCREMENT
        $sql = "INSERT INTO tipo_pigmentos (descricao, ativo)" 
                ." VALUES('".$descricao."', 1);";

        //envia um script sql para o banco de dados executar      
        $result = mysqli_query($conn,$sql); 

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../cadastroOutros.php');
    
    }else if($validacao == 'IR'){  // Insert Relação entre um pigmento e uma ou mais matérias primas

        $pigmento = stripslashes($_POST['nPigmento']);

        for($i = 0; $i < count($_POST['nMateriaPrima']); $i++){
            
            $sql = "INSERT INTO materia_pigmento(idMateriaPrima, idPigmento)"
                    ."VALUES(".$_POST['nMateriaPrima'][$i].", ".$pigmento.");";

            $result = mysqli_query($conn, $sql);
        }

        //fecha a conexão
        mysqli_close($conn);

        header('location: ../materiaPrima.php');

    }

    header('location: ../materiaPrima.php');
?>