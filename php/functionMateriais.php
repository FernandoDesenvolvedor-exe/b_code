<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    function selectCor($id,$coluna){
        if($coluna == 1){
            $coluna = 'codigo';            
        } else if ($coluna == 2){
            $coluna = 'lote';            
        }

        $sql='SELECT * FROM pigmentos WHERE idPigmento = '.$id.'';

        include('connection.php');
        $result=mysqli_query($conn,$sql);
        mysqli_close($conn);

        $resultado = '';

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                $resultado = $campo[''.$coluna.''];
            }
        }

        return $resultado;
    }

    function materiaisHistorico($id,$case){

        include('connection.php');

        $sql =' SELECT  mat.descricao as material,
                        t.descricao as tipo,
                        c.descricao as classe,
                FROM receita_materia_prima rmat
                WHERE  = '.$id.';';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $table= '';

        if(mysqli_num_rows($result) > 0){            
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            $n = 1;

            foreach($array as $campo){

                // case 1 para modal -- case 2 para tabela 
                switch($case){
                    case 1:                                                   
                        $table .=
                                '<div class="card-body">
                                    <label>Matéria Prima</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$campo['materiaPrima'].'">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$campo['tipoMateria_prima'].'">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$campo['classeMateria_prima'].'g">
                                        </div>
                                    </div>
                                </div>                                        
                                <div class="form-group row">
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantiade usada</label>
                                    <div class="col-lg-3">
                                        <input type="text" id="idQtdeMaterial" name="nQtdeMaterial[]" class="form-control" value="'.($campo['quantidadeMateria_prima'] * $campo['qtdPrevista']).'g">
                                    </div> 
                                </div>
                                    
                                <div class="form-group row">
                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                    <div class="col-sm-8">
                                        <input value="'.$campo['fornecedorMateria_prima'].'" id="idFornecedor" name="nFornecedor[]" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                    </div>
                                </div>';
                    break;
                        
                    case 2:
                        if(count($array) == $n){
                            $table .= ' '.$campo['materiaPrima'].'';
                        } else {
                            $table .= ''.$campo['materiaPrima'].' -';
                        }
                    break;                      
                }

                $n++;                
            }
        }
        
        return $table;
    }    
    
    function nomeFornecedorPigmento($id){
        $sql='  SELECT f.descricao as fornecedor
                FROM pigmento_fornecedor pf
                LEFT JOIN fornecedores f 
                ON pf.idFornecedor = f.idFornecedor
                WHERE pf.idPigmento = '.$id.'';

        include('connection.php');
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $fornecedor = '';

        if(mysqli_num_rows($result) > 0){
            $array = array();
            while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                $fornecedor = $campo['fornecedor'];
            }
        }

        return $fornecedor;
    }
    function materiaisReceita($idReceita,$case){

        include('connection.php');

        $sql ='SELECT * FROM view_materia_receitas WHERE id = '.$idReceita.';';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $table= '';

        if(mysqli_num_rows($result) > 0){            
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            $n = 1;

            foreach($array as $campo){                
                // case 1 para modal -- case 2 para tabela 
                switch($case){
                    case 1:                                                   
                        $table .=
                                '<div class="card-body">
                                    <label>Matéria Prima</label>
                                    <div class="row mb-3">                                    
                                        <div class="col-sm-2">
                                            <input type="text"  id="idQuantidadeMat" name="nQuantidadeMat[]" class="form-control" value="'.$campo['quantidade'].'" title="Por produto" readonly>                                            
                                        </div>
                                        <a class="col-sm-1 mt-3">g</a>
                                        <div class="col-sm-3">
                                            <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$campo['material'].'" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$campo['tipo'].'" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$campo['classe'].'" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-8">
                                            <input id="idMateriaFornecedor" name="nMateriaFornecedor[]" type="text" class="form-control" style="width: 100%; height:36px;" value="'.$campo['fornecedor'].'" readonly>
                                        </div>                                        
                                        <div class="col-lg-3" hidden>
                                            <input type="text" id="idIdMaterial" name="nIdMaterial[]" class="form-control" value="'.$campo['id'].'" readonly>
                                        </div>    
                                    </div>
                                </div>';
                    break;
                        
                    case 2:
                        if(count($array) == $n){
                            $table .= ' '.$campo['material'].'';
                        } else {
                            $table .= ''.$campo['material'].' -';
                        }
                    break;                      
                }

                $n++;                
            }
        }
        
        return $table;
    }
    function materiaisPedido($idPedido,$case){

        include('connection.php');

        $sql ='SELECT * FROM historico_pedidos WHERE idPedido = '.$idPedido.';';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        $table= '';

        if(mysqli_num_rows($result) > 0){            
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            $n = 1;

            foreach($array as $campo){
                // case 1 para modal -- case 2 para tabela 
                switch($case){
                    case 1:                                                   
                        $table .=   
                                '   <h4>Matéria Prima<h4>
                                    <div class="form-group row">                          
                                        <div class="col-sm-2">
                                            <input type="text"  id="idQuantidadeMat" name="nQuantidadeMat[]" class="form-control" value="'.$campo['quantidadeMateria_prima'].'" title="Por produto" readonly>                                            
                                        </div>
                                        <a class="col-sm-1 mt-3">g</a>
                                        <div class="col-sm-3">
                                            <input type="text" id="idMaterial" name="nMaterial[]" class="form-control" value="'.$campo['materiaPrima'].'" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" id="idTipoMaterial" name="nTipoMaterial[]" class="form-control" value="'.$campo['tipoMateria_prima'].'" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text"  id="idClasseMaterial" name="nClasseMaterial[]" class="form-control" value="'.$campo['classeMateria_prima'].'" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                        <div class="col-sm-8">
                                            <input id="idMateriaFornecedor" name="nMateriaFornecedor[]" type="text" class="form-control" style="width: 100%; height:36px;" value="'.$campo['fornecedorMateria_Prima'].'" readonly>
                                        </div>                                        
                                        <div class="col-sm-3" hidden>
                                            <input type="text" id="idIdMaterial" name="nIdMaterial[]" class="form-control" value="'.$campo['idMateriaPrima'].'" readonly>
                                        </div>    
                                    </div>';
                        break;
                        
                    case 2:
                        if(count($array) == $n){
                            $table .= ' '.$campo['materiaPrima'].'';
                        } else {
                            $table .= ''.$campo['materiaPrima'].' -';
                        }
                        break;   
                    
                    case 3:
                        $table .= '
                        
                                <div class="col-lg-12 mt-4 mb-2">
                                    <h6>Matéria Prima</h6>
                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Material:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['materiaPrima'].'" id="idQtdPrev" name="nQtdPrev" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">                                        
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de material:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['tipoMateria_prima'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">                                    
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Classe:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['classeMateria_prima'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['fornecedorMateria_Prima'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade de matéria prima:</label>
                                        <div class="col-sm-8">
                                            <input value="'.$campo['quantidadeMateria_prima'].'" type="text" class="form-control" style="width: 100%; height:36px;" title="p/ produto" disabled>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Total utilizado:</label>
                                        <div class="col-sm-8">
                                            <input value="'.($campo['quantidadeMateria_prima'] * $campo['producaoPrevista']).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                        </div>
                                    </div>
                                </div>';
                        break;  

                }

                $n++;                
            }
        }
        
        return $table;
    }
    function optionTipoPigmento(){

        include('connection.php');

        $select = "<option value=''> Selecione uma opção </option>";
        $sql = "SELECT * FROM tipo_pigmentos;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }

            foreach($array as $campo){
                $select .= "<option value ='".$campo['idTipoPigmento']."'>".$campo['descricao']."</option>";
            }
        }

        return $select;
    }

    function dataTableMateria(){
        include('connection.php');
    
        $sql = "SELECT mat.idMateriaPrima as idMateria,
                mat.descricao as materia,
                mat.idTipoMateriaPrima as idTipo,
                mat.idClasse as classe,
                mat.quantidade as qtde,
                mat.observacoes as obs,
                t.descricao as tipo,
                c.descricao as classe,
                f.descricao as fonecedor,
                mat.ativo as ativo
                FROM materia_prima as mat
                LEFT JOIN tipo_materia_prima as t
                ON mat.idTipoMateriaPrima = t.idTipoMateriaPrima
                LEFT JOIN classe_material as c
                ON mat.idClasse = c.idClasse
                RIGHT JOIN materia_fornecedor as mf
                ON mat.idMateriaPrima = mf.idMateriaPrima
                LEFT JOIN fornecedores as f
                ON f.idFornecedor = mf.idFornecedor";
                if($_SESSION['tipo']==2){
                    $sql.=' WHERE mat.ativo=1';//SE FOR USUARIO COMUM VER APENAS ATIVOS
                }
                $sql.=";";
    
        $table = "";
    
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    
        if (mysqli_num_rows($result) > 0){
    
            $array = array();
    
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }
    
            foreach($array as $campo){
                
                $table .=   
                        '<tr align-items="center">
                            <td>'.$campo['materia'].'</td>
                            <td>'.$campo['fonecedor'].'</td>
                            <td>'.$campo['tipo'].'</td>
                            <td>'.$campo['classe'].'</td>
                            <td>'.$campo['qtde'].'g </td>
                            <td><label>'.$campo['obs'].'</label></td>';
                //ALTERAR
                $table .=
                            '<td> 
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-4">
                                        <a href="#" class="fas fa-eye text-info" align="center" data-toggle="modal" data-target="#modalAlteraMateria'.$campo['idMateria'].'" title="Alterar Material"></a>
                                    </div>';
                if($_SESSION['tipo']==1){
                    if($campo['ativo']==1){
                        //DESATIVAR
                        $table .=
                                    '<div class="col-sm-4">
                                        <a href="#" class="fas fa-unlink text-danger" align="center" data-toggle="modal" data-target="#modalDesativaMateria'.$campo['idMateria'].'" title="Desativar Material"></a>
                                    </div>
                                </div>
                            </td>'; 
                    }else{
                        //ATIVAR
                        $table .=   
                                    '<div class="col-sm-4">
                                        <a href="#" class="fas fa-undo text-success" align="center" data-toggle="modal" data-target="#modalAtivaMateria'.$campo['idMateria'].'" title="Ativar Material"></a>
                                    </div>
                                </div>
                            </td>'; 
                    }
                }else{
                    //DESATIVAR
                    $table .=
                                '<div class="col-sm-4">
                                    <a href="#" class="fas fa-unlink text-danger" align="center" data-toggle="modal" data-target="#modalDesativaMateria'.$campo['idMateria'].'" title="Desativar Material"></a>
                                </div>
                                </div>
                            </td>';

                }
                //MODAL ATIVAR/DESATIVAR/ALTERAR
                $table .=   
                            '<div class="modal fade" id="modalDesativaMateria'.$campo['idMateria'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>                            
                                        <div class="modal-body">
                                            <form method="POST" action="php/saveMateriais.php?op=0&validacao=DMP&idMateria='.$campo["idMateria"].'">
                                                <label> Confirmar esta ação? </label>
                                                <div align-items="right">
                                                    <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalAtivaMateria'.$campo['idMateria'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ativar Produto/molde</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>                            
                                        <div class="modal-body">
                                            <form method="POST" action="php/saveMateriais.php?op=1&validacao=DMP&idMateria='.$campo["idMateria"].'">
                                                <label> Confirmar esta ação? </label>
                                                <div align-items="right">
                                                    <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalAlteraMateria'.$campo['idMateria'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                               <div class="modal-dialog" role="document ">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true ">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                                                                    
                                           <form method="POST" class="form-horizontal" action= "php/saveMateriais.php? validacao=UMP&idMateria='.$campo['idMateria'].'&qtd='.$campo['qtde'].'">

                                                <div class="card-body">                                                                                                       
                                                    <h4 class="card-title">Informações da matéria Prima</h4>

                                                    <div class="form-group row">
                                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" value="'.$campo['materia'].'" class="form-control" id="iDescricao" name= "nDescricao" placeholder="Nome do material"></input>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-3 text-right control-label col-form-label">Classe</label>
                                                        <div class="col-md-9">
                                                            <select id="iClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                '.optionClaseMaterial().'
                                                            </select>
                                                        </div>
                                                    </div>
                                
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 text-right control-label col-form-label">Tipo</label>
                                                        <div class="col-md-9">
                                                            <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                '. optionTipoMaterial().'
                                                            </select>
                                                        </div>
                                                    </div>
                                
                                                    <div class="form-group row">
                                                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                        <div style="display:inline;" class="col-sm-9">
                                                            <select id="iFornecedor" name="nFornecedor" class="select2 form-control custom-select" style="width: 100%; height:36px;">                                           
                                                                '.optionFornecedor().'                                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                
                                                    <div class="form-group row">
                                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório">'.$campo['obs'].'</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">  

                                                    <h4 class="card-title">Estoque de material</h4> 

                                                    <div class="form-group row">
                                                        <label for="cono1" class="col-sm-5 text-right control-label col-form-label">Adicionar ou retirar:</label>
                                                        <div class="col-sm-3">
                                                            <input id="iQuandtidade" value=0 name="nQuandtidade" min="-'.$campo['qtde'].'" type="number" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade em gramas" style="width= 10%;">
                                                        </div>
                                                    </div>                                                
                                                
                                                </div>

                                                <div class="border-top">
                                                    <div class="card-body">
                                                        <button type="submit" id="iBtnSalvar" name="nBtnSalvar" onclick="alterarValorObs()" class="btn btn-primary">Salvar</button>
                                                    </div>                      
                                                </div>

                                           </form>
                            
                                       </div>
                                   </div>
                               </div>
                            </div>
                            
                            
                        </tr>';
    
            }
        }        
    
        return $table;
    }

    function dataTablePigmento(){

        include('connection.php');
    
        $sql = "SELECT p.idPigmento as idPigmento," 
                ." p.descricao as pigmento,"
                ." p.codigo as cod,"
                ." p.lote as lote,"
                ." p.idTipoPigmento as idTipo,"
                ." p.quantidade as qtde,"
                ." p.observacoes as obs,"
                ." t.descricao as tipo,"
                ."p.ativo as ativo,"
                ." f.descricao as fonecedor"
                ." FROM pigmentos as p"
                ." LEFT JOIN tipo_pigmentos as t"
                ." ON p.idTipoPigmento = t.idTipoPigmento"
                ." RIGHT JOIN pigmento_fornecedor as pf"
                ." ON p.idPigmento = pf.idPigmento"
                ." LEFT JOIN fornecedores as f"
                ." ON f.idFornecedor = pf.idFornecedor";
    
        $table = "";
    
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    
        if (mysqli_num_rows($result) > 0){
    
            $array = array();
    
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }
    
            foreach($array as $campo){
                
                $table .=   
                        '<tr align-items="center";>'
                            .'<td>'.$campo['pigmento'].'</td>'
                            .'<td>'.$campo['fonecedor'].'</td>'
                            .'<td>'.$campo['cod'].'</td>'
                            .'<td>'.$campo['lote'].'</td>'
                            .'<td>'.$campo['tipo'].'</td>'
                            .'<td>'.$campo['qtde'].'g</td>'
                            .'<td>'.$campo['obs'].'</td>'
                            .'<td>                                                
                                <div class="d-flex justify-content-center">                                                
                                    <div class="col-sm-3">
                                        <a href="#" class="fas fa-eye text-info" data-toggle="modal" data-target="#modalAlteraPigmento'.$campo['idPigmento'].'"></a>
                                    </div>';
                if($campo['ativo']==1){
                    //Desativa
                                    $table .=        
                                    '<div class="col-sm-3">
                                        <a href="#" class="fas fa-unlink text-danger" data-target="#modalExcluiPigmento'.$campo['idPigmento'].'"></a>
                                    </div>
                                </div>
                            </td>';
                }else{
                    //Ativa
                                    $table .=     
                                    '<div class="col-sm-3">
                                    <a href="#" class="fas fa-undo text-success" align="center" data-toggle="modal" data-target="#AtivaModal'.$campo['idUser'].'" title="Ativar Usúario"></a>
                                        <a href="#" class="fas fa-undo text-success" data-target="#modalExcluiPigmento'.$campo['idPigmento'].'"></a>
                                    </div>
                                </div>
                            </td>';
                }
                $table .=     


                            

    
                            // MODAL DESATIVA CADASTRO DE PIGMENTO
                            "<div class='modal fade' id='modalExcluiPigmento".$campo['idPigmento']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Desativar Pigmento/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                        .''
                                        .'  <form method="POST" action="php/savePigmentos.php?op=0&validacao=D&id='.$campo["idPigmento"].'">'
                                        .'      <label> Confirmar esta ação? </label>'
                                        .'      <div align-items="right">'
                                        .'          <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                        .'      </div>'
                                        .'  </form>'
                                        .''
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>' 
                            ."<div class='modal fade' id='modalExcluiPigmento".$campo['idPigmento']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Ativar Pigmento/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                        .''
                                        .'  <form method="POST" action="php/savePigmentos.php?op=1&validacao=D&id='.$campo["idPigmento"].'">'
                                        .'      <label> Confirmar esta ação? </label>'
                                        .'      <div align-items="right">'
                                        .'          <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>'
                                        .'      </div>'
                                        .'  </form>'
                                        .''
                                        .'</div>'
                                    .'</div>'
                                .'</div>'
                            .'</div>' 

                            // MODAL NOVA MATÈRIA PRIMA -->
                            .'<div class="modal fade" id="modalAlteraPigmento'.$campo['idPigmento'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">'
                            .'    <div class="modal-dialog" role="document ">'
                            .'        <div class="modal-content">'
                            .'            <div class="modal-header">'
                            .'                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto e molde</h5>'
                            .'                <button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                            .'                    <span aria-hidden="true ">&times;</span>'
                            .'                </button>'
                            .'            </div>'
                            .'            <div class="modal-body">'
                            .''
                            .'                    <form method="POST" class="form-horizontal" action= "php/savePigmentos.php? validacao=U&id='.$campo['idPigmento'].'">'
                            .'                    <div class="card-body">'
                            .''
                            .'                        <div class="form-group row">'
                            .'                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do material</label>'
                            .'                            <div class="col-sm-9">'
                            .'                                <input type="text" class="form-control" id="iDescricao" name="nDescricao" placeholder="Nome do pigmento">'
                            .'                            </div>'
                            .'                        </div> '
                            .''
                            .'                        <div class="form-group row">'
                            .'                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Código</label>'
                            .'                            <div class="col-sm-9">'
                            .'                                <input type="text" class="form-control" id="iCodigo" name="nCodigo" placeholder="Opcional">'
                            .'                            </div>'
                            .'                        </div>'
                            .''
                            .'                        <div class="form-group row">'
                            .'                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Lote</label>'
                            .'                            <div class="col-sm-9">'
                            .'                                <input type="text" class="form-control" id="iLote" name="nLote" placeholder="Opcional">'
                            .'                            </div>'
                            .'                        </div>'
                            .''
                            .'                        <div class="form-group row">'
                            .'                            <label class="col-md-3 m-t-15" style="text-align: right;">Tipo</label>'
                            .'                            <div class="col-md-9">'
                            .'                                <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">'
                            .'                                    '.optionTipoPigmento().''
                            .'                                </select>'
                            .'                            </div>'
                            .'                        </div>'
                            .''
                            .'                        <div style="align-itens= side;" class="form-group row">'
                            .'                            <label for="email1" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>'
                            .'                            <div style="display:inline;" class="col-sm-9">'
                            .'                                <select id="iFornecedor" name="nFornecedor" class="select2 form-control custom-select" style="width: 100%; height:36px;">                                           '
                            .'                                    '.optionFornecedor().''
                            .'                                </select>'
                            .'                            </div>'
                            .'                        </div>'
                            .''
                            .'                        <div class="form-group row">'
                            .'                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade</label>'
                            .'                            <div class="col-sm-9">'
                            .'                                <input id="iQuandtidade" name="nQuandtidade" type="text" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade em gramas" style="width= 10%;">'
                            .'                            </div>'
                            .'                        </div>'
                            .''
                            .'                        <div class="form-group row">'
                            .'                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>'
                            .'                            <div class="col-sm-9">'
                            .'                                <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Opcional"></textarea>'
                            .'                            </div>'
                            .'                        </div>'
                            .'                    </div>'
                            .'                    <div class="border-top">'
                            .'                        <div class="card-body">'
                            .'                            <button type="submit" class="btn btn-primary">Salvar</button>'
                            .'                        </div>                      '
                            .'                    </div>'
                            .'                </form>'                            
                            .''
                            .'            </div>'
                            .'        </div>'
                            .'    </div>'
                            .'</div>'
                            .''
                            
                        ."</tr>";
    
            }
        }        
    
        return $table;
    }

    function optionTipoMaterial(){

        include('connection.php');

        $select = "<option value=''> Selecione uma opção </option>";
        $sql = "SELECT * FROM tipo_materia_prima WHERE ativo = 1;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }

            foreach($array as $campo){
                $select .= "<option value ='".$campo['idTipoMateriaPrima']."'>".$campo['descricao']."</option>";
            }
        }

        return $select;
    }

    function optionClaseMaterial(){

        include('connection.php');

        $select = "<option value=''> Selecione uma opção </option>";
        $sql = "SELECT * FROM classe_material WHERE ativo = 1;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                array_push($array, $linha);            
            }

            foreach($array as $campo){
                $select .= "<option value ='".$campo['idClasse']."'>".$campo['descricao']."</option>";
            }
        }

        return $select;
    }    

    function optionMaterial($caso){
        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option value='0'>Selecione um opção</option>";   
         
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

        if($caso == 1){
            $sql = 'SELECT mat.idMateriaPrima as id,
                mat.descricao as nome,
                tipo.descricao as tipos,
                class.descricao as classe
                FROM materia_prima as mat
                LEFT JOIN tipo_materia_prima as tipo
                ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima
                LEFT JOIN classe_material as class
                ON mat.idClasse = class.idClasse
                WHERE mat.ativo = 1
                AND (mat.idTipoMateriaPrima = 1
                OR mat.idTipoMateriaPrima = 2);';
            
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
                
                $select .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']." - ".$campo['classe']."</option>";                                  
                                                     
            }
        }     

        }else if($caso == 2){
            $select = "<option value='0'>Selecione um opção</option>";
            $sql = 'SELECT mat.idMateriaPrima as id,
                        mat.descricao as nome,
                        tipo.descricao as tipos,
                        class.descricao as classe,
                        f.descricao as fornecedor
                    FROM materia_prima mat
                    LEFT JOIN tipo_materia_prima tipo
                    ON mat.idTipoMateriaPrima = tipo.idTipoMateriaPrima
                    LEFT JOIN classe_material class
                    ON mat.idClasse = class.idClasse
                    LEFT JOIN materia_fornecedor mf
                    ON mat.idMateriaPrima = mf.idMateriaPrima
                    LEFT JOIN fornecedores f
                    ON mf.idFornecedor = f.idFornecedor
                    WHERE mat.ativo = 1
                    AND mat.idTipoMateriaPrima = 1;';
        
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
                    
                    $select .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']." - ".$campo['classe']." - ".$campo['fornecedor']."</option>";                                  
                                                        
                }
            }     
        }
        return $select;        
    }

    function optionFornecedor(){

        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option value=''>Selecione um Fornecedor</option>";     
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

        $sql = "SELECT * FROM fornecedores"
                ." WHERE ativo = 1;";
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
                
                $select .="<option value=".$campo['idFornecedor'].">".$campo['descricao']."</option>";                                  
                                                     
            }
        }     
        
        return $select;
    }

    function optionPigmento(){

        // acessa a conexão com o banco de dados         
        include("connection.php");

        //inicializa variavel select 
        $select = "<option value=''>Selecione um pigmento</option>";     
        //script sql a ser enviado ao banco de dados. Busca as informações solicitadas

        $sql = "SELECT p.idPigmento as id, p.descricao as nome, tipo.descricao as tipos" 
                ." FROM pigmentos as p"
                ." LEFT JOIN tipo_pigmentos as tipo"
                ." ON p.idTipoPigmento = tipo.idTipoPigmento"
                ." WHERE p.ativo = 1;";

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
                
                $select .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']."</option>";                                  
                                                     
            }
        }

        return $select;
    }    
?>