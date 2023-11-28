<?php

    function dataTableHistorico(){

        include('connection.php');

        $sql = 'SELECT * FROM historico_pedidos
                    WHERE ativo = 1
                    ORDER BY idPedido DESC;';
                

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

                $idAtual = $campo['idPedido'];                
                
                if ($idAtual != $idAnterior){

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
                            <td>'.$campo['idPedido'].'</td>
                            <td>'.$campo['nomeUsuario'].'</td>
                            <td>'.$campo['produto'].'</td>
                            <td>'.maquinaNome($campo['maquina']).'</td>';
                    
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
                        ''.materiais($campo['idPedido']).'
                        <td>
                            <div class="row">
                                <div class="col-sm-4">                                                                
                                    <button style="border:0; background-color:transparent"  type="button" data-toggle="modal" data-target="#modalPedido'.$campo['idPedido'].'">                                            
                                        <span class="fas fa-eye text-info mt-2" title="Visualizar pedido"> 
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button style="border:0; background-color:transparent" type="button" class="fas  fa-mdi-file-restore-success" data-toggle="modal" data-target="#modalExclui'.$campo['idPedido'].'">
                                        <span class="fas fa-undo text-success mt-2" title="Restaurar pedido"> 
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button style="border:0; background-color:transparent" type="button" class="fa mdi-delete-danger" data-toggle="modal" data-target="#modalExclui'.$campo['idPedido'].'">
                                        <span class="mdi mdi-delete-forever fa-2x text-danger" title="Excluir pedido"> 
                                        </span>
                                    </button>
                                </div>
                            <div>
                        </td>
                        '.modalHistorico($campo['idPedido']).'';

                    $n++;

                    $idAnterior = $idAtual;
                
                }
            }
        }        

        return $table;
    }

?>