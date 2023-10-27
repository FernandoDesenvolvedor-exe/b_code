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

        header('location: ../cadastroMaterial.php');

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

        header('location: ../cadastroRelacao.php');

    }else if($validacao == 'IM'){   // Insert um cadastro de maquina   

        $descricao = stripslashes($_POST['nMaquina']);
        $observacoes = stripslashes($_POST['nMObservacoes']);

        $sql = "INSERT INTO maquinas(descricao, ativo, observacoes)"
                ." VALUES('".$descricao."', 1, '".$observacoes."');";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        header('location: ../cadastroMaquina.php');

    }else if($validacao == 'ITF'){ // Insert um cadastro de um tipo de ferramental
        $descricao = stripslashes($_POST['nTipoMolde']);

        $sql = "INSERT INTO tipos_ferramental(descricao, ativo) VALUES ('".$descricao."', 1);";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        header('location: ../cadastroMaquina.php');
        
    }else if($validacao == 'IPR'){       // Insert de produto e ferramental.

        $descPdto = stripslashes($_POST['nProduto']);
        $descFerr = stripslashes($_POST['nMolde']);
        $idTipoFerr = $_POST['nTipoFerramental'];

        $sql = "INSERT INTO produtos(descricao, ativo)"
                ."VALUES('".$descPdto."', 1);";

        //$result = mysqli_query($conn, $sql);        

        //Traz o ultimo id da tabela enviada nos parametros. Enviar nome da tabela e nome da coluna id  
        $idPdto = buscaId("produtos","idProduto");

        $sql = "INSERT INTO ferramental (descricao, ativo, idTiposFerramental, idProduto)"
                ." VALUES ('".$descFerr."', 1, ".$idTipoFerr.",".$idPdto.");";

        $result = mysqli_query($conn, $sql);

        $idFerr = buscaId('ferramental', 'idFerramental');

        for($i = 0; $i < count($_POST['nMaquina']); $i++){
            
            $sql = "INSERT INTO ferramental_maquina(idFerramental, idMaquina)" 
                    ."VALUES(".$idFerr.", ".$_POST['nMaquina'][$i].");";

            $result = mysqli_query($conn, $sql);
        }
        
        mysqli_close($conn);

        //VERIFICA SE TEM IMAGEM NO INPUT
        if($_FILES['nImagem']['tmp_name'] != ""){

            //Usar o mesmo nome do arquivo original
            //$nomeArq = $_FILES['Foto']['name'];
            //...
            //OU
            //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
            $extensao = pathinfo($_FILES['nImagem']['name'], PATHINFO_EXTENSION);
            $novoNome = md5($_FILES['nImagem']['name']).'.'.$extensao;        
            
            //Verificar se o diretório existe, ou criar a pasta
            if(is_dir('../dist/img/')){
                //Existe
                $diretorio = '../dist/img/';
            }else{
                //Criar pq não existe
                $diretorio = mkdir('../dist/img/');
            }
    
            //Cria uma cópia do arquivo local na pasta do projeto
            move_uploaded_file($_FILES['nImagem']['tmp_name'], $diretorio.$novoNome);
    
            //Caminho que será salvo no banco de dados
            $dirImagem = 'dist/img/'.$novoNome;
    
            include("conexao.php");
            //UPDATE
            $sql = "UPDATE produtos "
                    ." SET imagem = '".$dirImagem."'"
                    ." WHERE idProduto = ".$idPdto.";";
                    
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);
        }

        die();

        header('location: ../cadastroProdutos.php');
    }
?>