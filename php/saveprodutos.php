<?php
    $validacao = $_GET['validacao'];
    include('connection.php');
    include('function.php');

    if ($validacao == 'IPF'){       // Insert de produto e ferramental.

        $descPdto = stripslashes($_POST['nProduto']);
        $descFerr = stripslashes($_POST['nMolde']);
        $idTipoFerr = $_POST['nTipoFerramental'];
        $qtde = $_POST['nQtd'];

        $sql = "INSERT INTO produtos(descricao, peso, ativo)"
                ."VALUES('".$descPdto."',".$qtde.", 1);";

        $result = mysqli_query($conn, $sql);        

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
        if(isset($_FILES['nImagem']['tmp_name']) != ""){

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

            include("connection.php");
            //UPDATE
            $sql = "UPDATE produtos "
                    ." SET imagem = '".$dirImagem."'"
                    ." WHERE idProduto = ".$idPdto.";";
                    
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);
        }

    }else if ($validacao == 'UPF') { // update de um produto 

        $descPdto = stripslashes($_POST['nProduto']);
        $descFerr = stripslashes($_POST['nMolde']);
        
        if (isset($_POST['nProduto']) == true && $_POST['nProduto'] != ""){  //update da tabela de produtos

            if (isset($_POST['nQtd']) == true && $_POST['nQtd'] != ""){

                $sql = 'UPDATE produtos' 
                        .' SET peso = '.$_POST['nQtd'].','
                        .' descricao = "'.$descPdto.'"'
                        .' WHERE idProduto = '.$_GET['idProduto'].';';

                $result = mysqli_query($conn, $sql);
    
            } else{

                $sql = 'UPDATE produtos'
                        .' SET descricao = "'.$descPdto.'"'
                        .' WHERE idProduto = '.$_GET['idProduto'].';';                

                $result = mysqli_query($conn, $sql);

            }

        } else{

            if (isset($_POST['nQtd']) == true && $_POST['nQtd'] != ""){
                
                $sql = 'UPDATE produtos' 
                .' SET peso = '.$_POST['nQtd'].''
                .' WHERE idProduto = '.$_GET['idProduto'].';';

                $result = mysqli_query($conn, $sql);
            
            }
        }

        if (isset($_POST['nMolde']) == true && $_POST['nMolde'] != ""){

            if (isset($_POST['nTipoFerramental']) == true && $_POST['nTipoFerramental'] != ""){

                $sql = 'UPDATE ferramental'
                .' SET idTiposFerramental = '.$_POST['nTipoFerramental'].','
                .' descricao = "'.$descFerr.'"'
                .' WHERE idFerramental = '.$_GET['idFerramental'].';'; 

                $result = mysqli_query($conn, $sql);  
    
            }else {

                $sql = 'UPDATE ferramental'
                .' SET descricao = "'.$descFerr.'"'
                .' WHERE idFerramental = '.$_GET['idFerramental'].';';

                $result = mysqli_query($conn, $sql);
            }
        
        } else{

            if (isset($_POST['nTipoFerramental']) == true && $_POST['nTipoFerramental'] != ""){

                $sql = 'UPDATE ferramental'
                .' SET idTiposFerramental = '.$_POST['nTipoFerramental'].''
                .' WHERE idFerramental = '.$_GET['idFerramental'].';';

                $result = mysqli_query($conn, $sql);
    
            }
        }            
        
        mysqli_close($conn);

        //VERIFICA SE TEM IMAGEM NO INPUT
        if(isset($_FILES['nImagem']['tmp_name']) != ""){

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

            include("connection.php");
            //UPDATE
            $sql = "UPDATE produtos "
                    ." SET imagem = '".$dirImagem."'"
                    ." WHERE idProduto = ".$_GET['idProduto'].";";
                    
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);

        }

    } else if ($validacao == 'DPF'){ // DELETE DE UM CADASTRO DE PRODUTOS

        $idProduto = $_GET['idProduto'];

        $sql="UPDATE produtos SET ativo= 0 WHERE idProduto=".$idProduto.";";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

    } else if ($validacao == 'ITF'){ // Insert um cadastro de um tipo de ferramental

        $descricao = stripslashes($_POST['nTipoMolde']);

        $sql = "INSERT INTO tipos_ferramental(descricao, ativo) VALUES ('".$descricao."', 1);";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        
    } else if($validacao == 'IM'){   // Insert um cadastro de maquina   

        $descricao = stripslashes($_POST['nMaquina']);
        $observacoes = stripslashes($_POST['nMObservacoes']);

        $sql = "INSERT INTO maquinas(descricao, ativo, observacoes)"
                ." VALUES('".$descricao."', 1, '".$observacoes."');";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

    } else if($validacao == 'IRMF'){   // Insert um cadastro de ferramental_maquina   

        $maquina = stripslashes($_POST['nRMaquina']);
        $molde = stripslashes($_POST['nRFerramental']);

        $sql = "INSERT INTO ferramental_maquina(idFerramental, idMaquina)"
                ." VALUES(".$maquina.", ".$molde.");";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    
    } else if($validacao == 'UM'){ // UPDATE de um cadastro de maquinas

        $descricao = stripslashes($_POST['nMaquina']);
        $observacoes = stripslashes($_POST['nMObservacoes']);        

        $sql = "UPDATE maquinas"
                ." SET descricao = '".$descricao."',"
                ." ativo = 1,"
                ." observacoes ='".$observacoes."'"
                ." WHERE idMaquina = ".$_GET['idMaquina'].";";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

    } else if($validacao == 'DM'){ // DELETE DE UM CADASTRO DE MAQUINAS

        $sql="UPDATE maquinas SET ativo = 0 WHERE idMaquina=".$_POST['nMaquina'].";";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header('location: ../produtos.php');

?>