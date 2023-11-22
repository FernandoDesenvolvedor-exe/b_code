<?php 
    include("");

    $table = 
            '<thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Quantidade de produtos</th>
                    <th>Refugos</th>
                    <th>Data</th>
                    <th>Inicio</th>
                    <th>Duração</th>
                </tr>
            </thead>
            <tbody>
                '.dataTablePedido().'
            </tbody>';






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

?>