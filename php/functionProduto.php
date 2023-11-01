<?php 
    function optionProdutos(){

        include('connection.php');

        $select = "<option> Selecione uma opção </option>";

        $sql = "SELECT idProduto, descricao FROM produtos WHERE ativo = 1;";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                array_push($array, $linha);
            }

            foreach($array as $campo){
                $select .= "<option value =".$campo['idProduto']."> ".$campo['descricao']." </option>";
            }
        }

        return $select;
    }

    function cardProduto(){       

        include('connection.php');

        $card = "";    
                    
        $sql = "SELECT idProduto, descricao, imagem FROM receita"
                ." WHERE ativo = 1;";
                    
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);

        if(mysqli_num_rows($result) > 0){
            $array = array();

            while($linha = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                array_push($array,$linha);
            }

            foreach($array as $campo){
                
                $card = "<div class='col-lg-3 col-md-6'>"
                            ."<form method='POST' action='cadastroPedido.php? img=".$campo['imagem']."'>"
                                ."<div style='border-top-left-radius: 20px; border-top-right-radius: 20px' class='card'>"
                                    ."<div style='border-bottom-left-radius: 20px; border-bottom-right-radius: 20px' class='el-card-item'>"
                                        ."<div class='el-card-avatar el-overlay-1'> <img name='nImg' src='".$campo['imagem']."' alt='user'/>"
                                            ."<div class='el-overlay'>"
                                                ."<ul class='list-style-none el-info'>"
                                                    ."<li class='el-item'>"
                                                        ."<a class='btn default btn-outline' href='".$campo['imagem']."'>"
                                                        ."</a>"
                                                    ."</li>"
                                                    ."<li class='el-item'>"
                                                        ."<a class='btn default btn-outline el-link' href='javascript:void(0);'>"
                                                            ."<i class='mdi mdi-link'></i>"
                                                        ."</a>"
                                                    ."</li>"
                                                ."</ul>"
                                            ."</div>"
                                        ."</div>"
                                        ."<div class='el-card-content'>"
                                            ."<h4 value='".$campo['idProduto']."' id='idProduto' name='nProduto' class='m-b-0'>".$campo['descricao']."</h4> <span class='text-muted'></span>" 
                                            ."<button type='submit' value='Selecionar' class='btn btn-primary'> Selecionar </button>"
                                        ."</div>" 
                                    ."</div>"
                                ."</div>"
                            ."</form>"
                        ."</div>";
            }   

            
        }  
        
        return $card;
    }
?>