<?php
    function saveUsuario($email, $senha, $nome, $sobrenome, $turma, $tipoUsu){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        include("connection.php");

        //var_dump($tipoUsu);
        //die();
        //____________________________________________Inserir dados no Banco___________________________________________________________________
        $sqlInsert = "Insert into usuarios (login, senha, nome , sobrenome, idTurma, tipo, ativo) values
                        ('".$email."', md5('".$senha."'), '".$nome."' , '".$sobrenome."', ".$turma.", ".$tipoUsu.", 1);";
        
        
        
        //var_dump($nome,$sobrenome,$email,$senha,$turma,$tipoUsu,'    SQl:    '."Insert into usuarios (login, senha, nome , sobrenome, idTurma, tipo , ativo) values"
        //."('".$email."', md5('".$senha."'), '".$nome."' , '".$sobrenome."', ".$turma.", ".$tipoUsu.", 1);");
        //var_dump($sqlInsert);
        
        mysqli_query($conn, $sqlInsert);
        mysqli_close($conn);
    }
    
    function dataTableUser(){

        include('connection.php');

        $sql = 'SELECT u.idUsuario as idUser,
                u.login as login,
                u.nome as nome,
                u.sobrenome as sobNome,
                u.idTurma as idTurma,
                u.tipo as tipo,
                t.turno as turno,
                t.nomeTurma as nTurma,
                u.ativo as ativo
                FROM usuarios as u
                LEFT JOIN turma as t
                ON u.idTurma = t.idTurma';

        $table = '';

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if (mysqli_num_rows($result) > 0){

            $array = array();

            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
                array_push($array,$linha);
            }

            $a = '';

            foreach($array as $campo){
                
                $table .=   
                        "<tr align-items='center';>
                            <td>".$campo['idUser']."</td>
                            <td>".$campo['login']."</td>
                            <td>".$campo['nome']." ".$campo['sobNome']."</td>
                            <td>".$campo['nTurma']."</td>
                            <td>".$campo['turno']."</td>";
                if ($campo['tipo'] == 2){

                    $table .= "<td> Usuário Comum </td>";
                    
                } else if ($campo['tipo'] == 1){

                    $table .= "<td> Administrador </td>";

                }
                $table .=
                            "<td>                           
                                <button style='width:50%' type='button' class='btn btn-info margin-5' data-toggle='modal' data-target='#EditaModal".$campo['idUser']."'>
                                    Alterar
                                </button>";
                if($campo['ativo']==1){
                    $table .=
                                "<button style='width:50%' type='button' class='btn btn-danger margin-5' data-toggle='modal' data-target='#DesativaModal".$campo['idUser']."'>
                                    Desativar
                                </button>
                            </td>";
                }else{
                    $table .=
                                "<button style='width:50%' type='button' class='btn btn-success margin-5' data-toggle='modal' data-target='#AtivaModal".$campo['idUser']."'>
                                    Ativar
                                </button>
                            </td>"; 
                }
                
                $table .=
                            "<div class='modal fade' id='DesativaModal".$campo['idUser']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>
                                <div class='modal-dialog' role='document '>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'>Desativar Usuário - ".$campo['nome']." ".$campo['sobNome']."</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>                                 
                                        <div class='modal-body'>
                                            <form method='POST' action='php/validaCadastroUsuario.php? validacao=D&id=".$campo["idUser"]."'>
                                                <label> Confirmar esta ação? </label>
                                                <div align-items='right'>
                                                    <button  type='submit' id='iBtnSalvar' name='nBtnSalvar' class='btn btn-primary'> Confirmar </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='modal fade' id='AtivaModal".$campo['idUser']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true '>
                                <div class='modal-dialog' role='document '>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'>Ativar Usuário - ".$campo['nome']." ".$campo['sobNome']."</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>                                 
                                        <div class='modal-body'>
                                            <form method='POST' action='php/validaCadastroUsuario.php? validacao=D&id=".$campo["idUser"]."'>
                                                <label> Confirmar esta ação? </label>
                                                <div align-items='right'>
                                                    <button  type='submit' id='iBtnSalvar' name='nBtnSalvar' class='btn btn-primary'> Confirmar </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>"


                            .'<div class="modal fade" id="EditaModal'.$campo["idUser"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alterar Usuário - '.$campo['nome'].' '.$campo['sobNome'].' </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" class="form-horizontal"  enctype="multipart/form-data" action= "php/validaCadastroUsuario.php?validacao=U&id='.$campo['idUser'].'">
                                                <div class="card-body">
                                                    <!-- User nome -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend style="width: 100%; height:100%;">
                                                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-lg" name="nNome" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1" maxlength="80">
                                                        <input type="text" class="form-control form-control-lg" name="nSobrenome" placeholder="Sobrenome" aria-label="Username" aria-describedby="basic-addon1" maxlength="80">
                                                    </div>

                                                    <!-- email -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control form-control-lg" name="nEmail" placeholder="Email*" aria-label="Username" aria-describedby="basic-addon1" maxlength="50">
                                                    </div>

                                                    <!-- senha -->
                                                    <div class="input-group mb-3">
                                                        <!-- senha -->
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                                        </div>
                                                        <input type="password" class="form-control form-control-lg" name="nSenha" placeholder="Senha" aria-label="Password" aria-describedby="basic-addon1" minlength="4" maxlength="32">
                                                    </div>

                                                    <!-- confirma senha -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                                        </div>
                                                        <input type="password" class="form-control form-control-lg" name="nConfirmSenha" placeholder="Confirmar senha" aria-label="Password" aria-describedby="basic-addon1" minlength="4" maxlength="32">
                                                    </div>

                                                    <!-- turma -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend" style="width: 100%; height:100%;">
                                                            <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                                            <select name="nTurma" class="select2 form-control custom-select" style="width: 100%; height:100%;">
                                                                   '.optionTurmas().'
                                                            </select>
                                                        </div>
                                                    </div>
                                                
                                                    <!-- Tipo Usuario -->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend" style="width: 100%; height:100%;">
                                                            <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                                            <select name="nTipoUsu" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                <option value="">Nivel de Acesso</option>
                                                                <optgroup label="Niveis">
                                                                    <option value=1>Administrador</option>
                                                                    <option value=2>Comum</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-top">
                                                    <div class="card-body">
                                                        <button type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">Salvar</button>
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

?>