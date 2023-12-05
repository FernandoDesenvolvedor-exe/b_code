<?php     
    function validaEstoque($idMaterial,$quantidade,$tabela,$nomeId){
        //$minimo = $_SESSION['estoqueMinimo'];

        $sql = 'SELECT quantidade,descricao FROM '.$tabela.' WHERE '.$nomeId.' = '.$idMaterial.'';

        include('connection.php');
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $validado = '';

        if(mysqli_num_rows($result) > 0){            
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                //var_dump($campo['quantidade'] - $quantidade);
                //var_dump($tabela);
                //var_dump($nomeId);
                //var_dump($idMaterial);
                //var_dump($campo['descricao']);
                //var_dump($campo['quantidade']);
                //var_dump($quantidade);
                //die();
                if(($campo['quantidade'] - $quantidade) < 0){
                    $validado = false;
                } else {
                    $validado = true;
                }
            }

            return $validado;
        }
    }

    function alteraEstoque($idPedido){        

        $sql = 'SELECT * FROM view_altera_estoque WHERE idPedido = '.$idPedido.'';
        
        include('connection.php');
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if (mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            // Valida a quantidade de material a ser usado. Se for usado mais material do que tem no estoque, retornará false, senão retornará true
            foreach($array as $campo){
                $qtdeMat = $campo['qtdMaterial'] * $campo['producao'];
                $tabela1 = 'materia_prima';
                $chavePrimaria1 = 'idMateriaPrima';

                $tabela2 = 'pigmentos';
                $chavePrimaria2 = 'idPigmento';
                $qtdePig = $campo['qtdPigmento'] * $campo['producao'];

                $validadoMateria = validaEstoque($campo['idMaterial'],$qtdeMat,$tabela1,$chavePrimaria1);
                $validadoPigmento = validaEstoque($campo['idPigmento'],$qtdePig,$tabela2,$chavePrimaria2);
            }

            if($validadoMateria == true && $validadoPigmento == true){
                // Se a validação for verdadeira, prepara uma menssagem de sucesso e mostra o quanto tirou do estoque 
                
                $idPigmento = '';
                $qtdPigmento = '';
                $estoquePigmento = '';            
                $validado = '';
                $_SESSION['ativaMsgS'] = 1;
                $_SESSION['msgSucesso'] =   '<h4 class="alert-heading">Sucesso!</h4><br>
                                            <p>Ordem de produção Registrada!</p><br>                                
                                            <hr>
                                            <p>Descontado do estoque</p>';
                foreach($array as $campo){  

                    $sql = 'UPDATE materia_prima SET quantidade = '.($campo['estoqueMaterial'] - ($campo['qtdMaterial'] * $campo['producao'])).' WHERE idMateriaPrima = '.$campo['idMaterial'].'';
    
                    include('connection.php');
                    $result = mysqli_query($conn,$sql);
                    mysqli_close($conn);
    
                    $_SESSION['msgSucesso'] .= '<p class="mb-0">'.$campo['nomeMaterial'].' = -'.($campo['qtdMaterial'] * $campo['producao']).'g</p><br>';
    
                    $producao = $campo['producao'];
                    $idPigmento = $campo['idPigmento'];
                    $qtdPigmento = $campo['qtdPigmento'];
                    $estoquePigmento = $campo['estoquePigmento'];
                    $pigmento = $campo['nomePigmento'];
                }
    
                $sql = 'UPDATE pigmentos SET quantidade = '.($estoquePigmento - ($qtdPigmento * $producao)).' WHERE idPigmento = '.$idPigmento.'';
    
                include('connection.php');
                $result = mysqli_query($conn,$sql);
                mysqli_close($conn);
                $_SESSION['msgSucesso'] .= '<p class="mb-0">'.$pigmento.' = -'.($qtdPigmento * $producao).'g</p><br>';

            } else {
                // Se a validação for falsa, prepara uma menssagem de aviso e mostra quais materiais faltam no estoque

                $_SESSION['ativaMsgA'] = 1;
                $_SESSION['msgAviso'] =   '<h4 class="alert-heading">Aviso!</h4><br>    
                                        <p>Materiais insuficientes no estoque:</p>';

                foreach($array as $campo){
    
                    $_SESSION['msgAviso'] .= '<p class="mb-0">'.$campo['nomeMaterial'].' = Quantidade atual:'.$campo['estoqueMaterial'].' - Necessário:'.($campo['qtdMaterial'] * $campo['producao']).'g</p><br>';
                    
                    $producao = $campo['producao'];
                    $idPigmento = $campo['idPigmento'];
                    $qtdPigmento = $campo['qtdPigmento'];
                    $estoquePigmento = $campo['estoquePigmento'];
                    $pigmento = $campo['nomePigmento'];
                }
                
                $_SESSION['msgAviso'] .= '<p class="mb-0">'.$pigmento.' = Quantidade atual:'.$estoquePigmento.' - Necessário: '.($qtdPigmento * $producao).'g</p><br>';
                $_SESSION['msgAviso'] .= '<p class="mb-0">Para OP de ID:'.$idPedido.'</p><br>';
            }
        }        
    }
?>