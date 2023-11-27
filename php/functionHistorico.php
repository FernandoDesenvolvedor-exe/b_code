<?php

    function dataTableHistorico(){

        include('function.php');
        include('connection.php');

        $sql = 'SELECT * FROM historico_pedidos
                    WHERE ativo = 1
                    ORDER BY idPedido ASC;';
                

        $table = "";

        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0){

            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }

            $n = 1;
            $idAnterior = 0;
            $idAtual = 0;

            foreach($array as $campo){
                
                if(multipleMateriais($campo['idPedido']) ==){
                    if ($n == 1){
                        $dataAberto =''.substr($campo['dataHora_aberto'], 8, 2).'/';
                        $dataAberto .=''.substr($campo['dataHora_aberto'], 5, 2).'/';
                        $dataAberto .=''.substr($campo['dataHora_aberto'], 0, 4).'';
                        $horaAberto = substr($campo['dataHora_aberto'], 11, 8);

                        $dataProducao =''.substr($campo['dataHora_producao'], 8, 2).'/';
                        $dataProducao .=''.substr($campo['dataHora_producao'], 5, 2).'/';
                        $dataProducao .=''.substr($campo['dataHora_producao'], 0, 4).'';
                        $horaProducao = substr($campo['dataHora_producao'], 11, 8);
                        
                        $dataFechado =''.substr($campo['dataHora_fechado'], 8, 2).'/';
                        $dataFechado .=''.substr($campo['dataHora_fechado'], 5, 2).'/';
                        $dataFechado .=''.substr($campo['dataHora_fechado'], 0, 4).'';
                        $horaFechado = substr($campo['dataHora_fechado'], 11, 8);

                        $table .=                
                            '<tr align-items="center";>
                                <td>'.$campo['pedidoId'].'</td>
                                <td>'.$campo['nomeUsuario'].'</td>
                                <td>'.$campo['produto'].'</td>
                                <td>'.$campo['maquina'].'</td>';
                        
                        if ($campo['statusPedido'] == 1){     

                            $table .='<td>
                                        Em aberto                              
                                    </td>'; 

                        } else if ($campo['statusPedido'] == 2) {

                            $table .='<td>       
                                        Em Produção
                                    </td>';

                        } else if ($campo['statusPedido'] == 3) {

                            $table .='<td>Concluido</td>';

                        } else if ($campo['statusPedido'] == 0) {

                            $table .='<td>Cancelado</td>';

                        }

                        $table .=
                            ''.materiais($campo['pedidoId']).'
                            <td>
                                <div class="divButtons">
                                    <div class="div1">                                                                         
                                        <button style="width: auto; border-radius: 5px;" type="button;" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$campo['pedidoId'].'">
                                            Visualizar
                                        </button>
                                    </div>
                                    <div class="div2">
                                        <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$campo['pedidoId'].'">
                                            Desativar
                                        </button>
                                    </div>
                                <div>
                            </td>';

                        $n++;
                    } 


                    } if (multipleMateriais($campo['idPedido']) == $n){

                        $n = 1;

                    }

                } else {


                }

                $n++;
            }
        }        

        return $table;
    }

?>