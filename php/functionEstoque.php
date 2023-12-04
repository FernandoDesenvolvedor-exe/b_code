<?php 
    function alteraEstoque($idPedido){

        $sql = 'SELECT * FROM veiw_altera_estoque WHERE idPedido = '.$idPedido.'';
        
        include('connection.php');
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if (mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            $idPigmento = '';
            $qtdPigmento = '';
            $estoquePigmento = '';

            foreach($array as $campo){
                $sql = 'UPDATE materia_prima SET quantidade = '.($campo['estoqueMaterial'] - ($campo['qtdMaterial'] * $campo['producao'])).'';

                include('connection.php');
                $result = mysqli_query($conn,$sql);
                mysqli_close($conn);

                $producao = $campo['producao'];
                $idPigmento = $campo['idPigmento'];
                $qtdPigmento = $campo['qtdPigmento'];
                $estoquePigmento = $campo['estoquePigmento'];
            }

            $sql = 'UPDATE materia_prima SET quantidade = '.($estoquePigmento - ($qtdPigmento * $producao)).'';

            include('connection.php');
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);
        }        
    }

    function validaEstoque($idMaterial,$quantidade,$tabela,$nomeId){
        $minimo = $_SESSION['estoqueMinimo'];

        $sql = 'SELECT quantidade FROM '.$tabela.' WHERE '.$nomeId.' = '.$idMaterial.'';

        include('connection.php');
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $validado = false;

        if(mysqli_num_rows($result) > 0){            
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                if($campo['quantidade'] <= $minimo){
                    $validado = false;
                } else {
                    if($quantidade > $campo['quantidade']){                        
                        $validado = true;
                    }
                }
            }

            return $validado;
        }
    }
?>