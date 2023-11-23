<?php        
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
    
        $sql = "SELECT mat.idMateriaPrima as idMateria," 
                ." mat.descricao as materia,"
                ." mat.idTipoMateriaPrima as idTipo,"
                ." mat.idClasse as classe,"
                ." mat.quantidade as qtde,"
                ." mat.observacoes as obs,"
                ." t.descricao as tipo,"
                ." c.descricao as classe,"
                ." f.descricao as fonecedor"
                ." FROM materia_prima as mat"
                ." LEFT JOIN tipo_materia_prima as t"
                ." ON mat.idTipoMateriaPrima = t.idTipoMateriaPrima"
                ." LEFT JOIN classe_material as c"
                ." ON mat.idClasse = c.idClasse"
                ." RIGHT JOIN materia_fornecedor as mf"
                ." ON mat.idMateriaPrima = mf.idMateriaPrima"
                ." LEFT JOIN fornecedores as f"
                ." ON f.idFornecedor = mf.idFornecedor"
                ." WHERE mat.ativo = 1;";
    
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
                        '<tr align-items="center";>
                            <td>'.$campo['materia'].'</td>
                            <td>'.$campo['fonecedor'].'</td>
                            <td>'.$campo['tipo'].'</td>
                            <td>'.$campo['classe'].'</td>
                            <td>'.$campo['qtde'].'g </td>
                            <td><label>'.$campo['obs'].'</label></td>
                            <td>            
                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAlteraMateria'.$campo['idMateria'].'">
                                    Alterar
                                </button>
                                <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExcluiMateria'.$campo['idMateria'].'">
                                    Desativar
                                </button>
                            </td>    


                            
                            <div class="modal fade" id="modalExcluiMateria'.$campo['idMateria'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>                            
                                        <div class="modal-body">
                                            <form method="POST" action="php/saveMateriais.php? validacao=DMP&idMateria='.$campo["idMateria"].'">
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
                                                        <label class="col-md-3 m-t-15" style="text-align: right;">Classe</label
                                                        <div class="col-md-9">
                                                            <select id="iClasse" name="nClasse" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                '.optionClaseMaterial().'
                                                            </select>
                                                        </div>
                                                    </div>
                                
                                                    <div class="form-group row">
                                                        <label class="col-md-3 m-t-15" style="text-align: right;">Tipo</label>
                                                        <div class="col-md-9">
                                                            <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                '. optionTipoMaterial().'
                                                            </select>
                                                        </div>
                                                    </div>
                                
                                                    <div style="align-itens= side;"  class="form-group row">
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
                ." f.descricao as fonecedor"
                ." FROM pigmentos as p"
                ." LEFT JOIN tipo_pigmentos as t"
                ." ON p.idTipoPigmento = t.idTipoPigmento"
                ." RIGHT JOIN pigmento_fornecedor as pf"
                ." ON p.idPigmento = pf.idPigmento"
                ." LEFT JOIN fornecedores as f"
                ." ON f.idFornecedor = pf.idFornecedor"
                ." WHERE p.ativo = 1;";
    
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
                            .'<td>'                                                
                                .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAlteraPigmento'.$campo['idPigmento'].'">'
                                    .'Alterar'
                                .'</button>'
                                .'<button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExcluiPigmento'.$campo['idPigmento'].'">'
                                    .'Desativar'
                                .'</button>'
                            .'</td>'



    
                            // MODAL DESATIVA CADASTRO DE PIGMENTO
                            ."<div class='modal fade' id='modalExcluiPigmento".$campo['idPigmento']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>"
                                ."<div class='modal-dialog' role='document '>"
                                    ."<div class='modal-content'>"
                                        .'<div class="modal-header">'
                                            .'<h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>'
                                            .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                                .'<span aria-hidden="true ">&times;</span>'
                                            .'</button>'
                                        .'</div>'                                  
                                        .'<div class="modal-body">'
                                        .''
                                        .'  <form method="POST" action="php/savePigmentos.php? validacao=D&id='.$campo["idPigmento"].'">'
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
                    
                    $select .="<option value=".$campo['id'].">".$campo['nome']." - ".$campo['tipos']." - ".$campo['classe']."</option>";                                  
                                                        
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