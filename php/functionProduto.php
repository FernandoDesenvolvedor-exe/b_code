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
                    
        $sql = "SELECT idProduto, descricao, imagem FROM produtos"
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
                            ."<div class='card'>"
                                ."<div class='el-card-item'>"
                                    ."<div class='el-card-avatar el-overlay-1'> <img src='".$campo['imagem']."' alt='user'/>"
                                        ."<div class='el-overlay'>"
                                            ."<ul class='list-style-none el-info'>"
                                                ."<li class='el-item'>"
                                                    ."<a class='btn default btn-outline image-popup-vertical-fit el-link' href='".$campo['imagem']."'>"
                                                        ."<i class='mdi mdi-magnify-plus'></i>"
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
                                        ."<h4 class='m-b-0'>".$campo['descricao']."</h4> <span class='text-muted'></span>" 
                                    ."</div>"
                                ."</div>"
                            ."</div>"
                        ."</div>";
            }   

            
        }  
        
        return $card;
    }
?>