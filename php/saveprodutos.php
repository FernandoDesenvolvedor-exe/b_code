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

    }else if ($validacao == 'UPF') {

        $idProduto = $_GET['idProduto'];
        $idFeramental = $_GET['idFerramental'];
        $descPdto = stripslashes($_POST['nProduto']);
        $descFerr = stripslashes($_POST['nMolde']);
        $idTipoFerr = $_POST['nTipoFerramental'];
        $qtde = $_POST['nQtd'];

        $arrayProduto = array($descPdto,$qtde,$idProduto);

        validaBanco($arrayTabela);
        
        $sql = "UPDATE produtos SET descricao=".$descPdto.", peso=".$qtde.")"
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

    } else if ($validacao == 'DPF'){

        $idProduto = $_GET['idProduto'];

        $sql="UPDATE ferramental SET ativo= 0 WHERE idProduto=".$idProduto.";";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header('location: ../produtos.php');

?>