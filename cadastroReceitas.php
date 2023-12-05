<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    include('php/function.php');  

    if (isset($_SESSION['user']) == 0){

        //alert(1,'Acesso negado!','Tentativa de acesso ilegal!');
        
        header('location: login');

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php  
            include('links/cabecalho.php');
        ?>
        <title>Cadastro Receita</title>
    </head>

    <body>
        <div id="main-wrapper">  
            <?php include('links/preloader.php');?> 
            <?php  include('links/menu.php');?>    
            <div class="page-wrapper">      
                <?php include('links/side_bar_direita.php');?>
                <div class="container-fluid"> 
                    <button for="idVoltarBtn" id="idVoltarBtn" class='btn btn-primary'>
                        <a style="color: white;" href="receitas.php?idProduto=<?php echo $_GET['idProduto']?>&pr=<?php echo $_GET['pr']?> ">
                            Voltar
                        </a>
                    </button>
                    <br>
                    
                    <!-- AQUI ESTA A GET COM O ID DO PRODUTO $_GET['idProduto'] -->

                    <!-- Start Page Content -->                    
                    <div class="card">
                        <!-- Cria um formulário -->                            
                        <form method="POST" class="form-horizontal" action="php/validaReceita.php?idProduto=<?php echo $_GET['idProduto']?>&pr=<?php echo $_GET['pr']?>">
                            <div class="card-body">
                                <!-- Titulo da div -->
                                <h4 class="card-title">Receita</h4>
                                <?php 
                                    if(isset($_SESSION['msgErro'])){ 
                                        echo $_SESSION['msgErro'];
                                        unset($_SESSION['msgErro']);
                                    }
                                ?>
                                
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Produto</label>
                                    <div class="col-sm-9">
                                        <select id="iProduto" name="nProduto" class="select2 form-control custom-select" style="width: 80%; height:36px;">
                                            <?php echo optionProdutos($_GET['idProduto']);?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Material</label>
                                    <div class="col-sm-9">
                                        <select id="iMaterial" name="nMaterial" class="select2 form-control custom-select" style="width: 80%; height:36px;" required>
                                            <?php
                                                echo optionMaterial(2);
                                            ?> 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" id="divQtdMaterial">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Quant. Material</label>
                                    <div class="col-sm-5" id='qntM'>
                                        <input id="iQuantMaterial" name="nQuantMaterial" type="number" class="form-control" placeholder="quantidade Material" style="width:100%;" min="0" required>
                                    </div>                                    
                                    <div class="col-sm-4 align-start" align="left">
                                        <button type="button" id="btnAddReciclado" class="btn btn-primary">Adicionar Reciclado</button>
                                    </div>
                                </div>

                                <div class="form-group row" id="divReciclado">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reciclado</label>
                                    <div class="col-sm-9" id='qntM'>
                                    <select id="iReciclado" name="nReciclado" class="select2 form-control custom-select" style="width: 80%; height:36px;">
                                            <?php
                                                echo optionMaterial(3);
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="divQtdReciclado">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Quant. Reciclado</label>
                                    <div class="col-sm-9" id='qntM'>
                                        <input id="iQuantReciclado" name="nQuantReciclado" type="number" class="form-control" placeholder="quantidade reciclado" style="width:30%;" min="0"  >                                        
                                    </div>
                                </div>
                                <div class="form-group row" id="divSelectPigmento">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Pigmento</label>
                                    <div class="col-md-9">
                                        <select id="iPigmento" name="nPigmento" class="select2 form-control custom-select" style="width: 80%; height:36px;">
                                           
                                        </select>
                                    </div>                  
                                </div>

                                <div class="form-group row" id="divQtdPigmento">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Quantidade Pigmento</label>
                                    <div class="col-sm-1" id='qntM'>
                                        <input id="iQuantPigmento" name="nQuantPigmento" type="number" class="form-control col-sm-11" id="iQuantidade" name="nQuantidade" placeholder="0" style="width:100%;" unit="%" min="0" max='6'>                                        
                                    </div>
                                    <label for="nQuantPigmento" class="control-label col-sm-7 col-form-label">%</label>
                                </div>          

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="width:80%;" id= "iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="padding: 10px;"> 
                                    <h4 class="card-title">Receita <?php echo $_GET['pr']?></h4>
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantidade</th>
                                                </tr>
                                            </thead>
                                        </table>
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
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>
                </footer>
            </div>
        </div>
        <?php include('links/script.php'); ?>
        <script>
            $('document').ready(function(){
                $('#divSelectPigmento').hide();
                $('#divQtdMaterial').hide();
                $('#divQtdPigmento').hide();
                $('#divReciclado').hide();
                $('#divQtdReciclado').hide();

                $('#btnAddReciclado').on('click', function(){
                    if($('#divQtdReciclado').is(':hidden')){                        
                        $('#divQtdReciclado').show();
                        $('#divReciclado').show();
                        $('#btnAddReciclado').text('Remover Reciclado');
                    } else {                     
                        $('#btnAddReciclado').text('Adicionar Reciclado');
                        $('#iQuantReciclado').val('');
                        $('#divQtdReciclado').hide();
                        $('#iReciclado').val('');
                        $('#divReciclado').hide();
                    }
                })


                
                $('#divQtdMaterial').on('change', function(){
                    $('#zero_config').empty();
                    $('#zero_config').append('<thead><tr><th>Item</th><th>Quantidade</th></tr></thead>');
                    var material='';
                    var pigmento='';
                    console.log('a - '+material+' b- '+pigmento);
                    if($('#iQuantMaterial').val()!='' && $('#iQuantPigmento').val()!=''){
                        var pesoPigmento=0;
                        var pesoMaterial=$('#iQuantMaterial').val();
                        var porcentPigmento=$('#iQuantPigmento').val();
                        pesoPigmento=pesoMaterial*(porcentPigmento/100);
                        console.log('1- '+pesoMaterial);
                        console.log('2- '+porcentPigmento);
                        console.log('3- '+pesoPigmento);
                        pesoMaterial=pesoMaterial-pesoPigmento;
                        material='| '+pesoMaterial+'g';
                        pigmento='| '+pesoPigmento+'g';
                    }
                    console.log('mat: '+material);
                    console.log('pig: '+pigmento);
                    if($('#iQuantMaterial').val()!=''){
                        $('#zero_config').append('<tr><td>Material</td><td>'+$('#iQuantMaterial').val()+'g '+material+'</td></tr>');
                        $('#iQuantReciclado').prop('max',$('#iQuantMaterial').val());
                    }
                    if($('#iQuantReciclado').val()!='' && $('#iQuantReciclado').val()!=0){
                        $('#zero_config').append('<tr><td>Reciclado</td><td>'+$('#iQuantReciclado').val()+'g</td></tr>');
                    }
                    if($('#iQuantPigmento').val()!=''){
                        $('#zero_config').append('<tr><td>Pigmento</td><td>'+$('#iQuantPigmento').val()+'% '+pigmento+'</td></tr>');
                    }
                });
                $('#iQuantReciclado').on('change', function(){
                    $('#zero_config').empty();
                    $('#zero_config').append('<thead><tr><th>Item</th><th>Quantidade</th></tr></thead>');
                    var material='';
                    var pigmento='';
                    if($('#iQuantMaterial').val()!='' && $('#iQuantPigmento').val()!=''){
                        var pesoMaterial=$('#iQuantMaterial').val();
                        var porcentPigmento=$('#iQuantPigmento').val();
                        var pesoPigmento=pesoMaterial*(porcentPigmento/100);
                        pesoMaterial=pesoMaterial-pesoPigmento;
                        material='| '+toString(pesoMaterial)+'g';
                        pigmento='| '+toString(pesoPigmento)+'g';
                    }
                    if($('#iQuantMaterial').val()!=''){
                        $('#zero_config').append('<tr><td>Material</td><td>'+$('#iQuantMaterial').val()+'g '+material+'</td></tr>');
                    }
                    if($('#iQuantReciclado').val()!='' && $('#iQuantReciclado').val()!=0){
                        $('#iReciclado').prop('required',true);
                        $('#zero_config').append('<tr><td>Reciclado</td><td>'+$('#iQuantReciclado').val()+'g</td></tr>');
                    }else{
                        $('#iQuantReciclado').prop('required',false);
                    }
                    if($('#iQuantPigmento').val()!=''){
                        $('#zero_config').append('<tr><td>Pigmento</td><td>'+$('#iQuantPigmento').val()+'% '+pigmento+'</td></tr>');
                    }
                });
                $('#iQuantPigmento').on('change', function(){
                    $('#zero_config').empty();
                    $('#zero_config').append('<thead><tr><th>Item</th><th>Quantidade</th></tr></thead>');
                    var material='';
                    var pigmento='';
                    if($('#iQuantMaterial').val()!='' && $('#iQuantPigmento').val()!=''){
                        var pesoMaterial=$('#iQuantMaterial').val();
                        var porcentPigmento=$('#iQuantPigmento').val();
                        var pesoPigmento=pesoMaterial*(porcentPigmento/100);
                        pesoMaterial=pesoMaterial-pesoPigmento;
                        material='| '+toString(pesoMaterial)+'g';
                        pigmento='| '+toString(pesoPigmento)+'g';
                    }
                    if($('#iQuantMaterial').val()!=''){
                        $('#zero_config').append('<tr><td>Material</td><td>'+$('#iQuantMaterial').val()+'g '+material+'</td></tr>');
                    }
                    if($('#iQuantReciclado').val()!='' && $('#iQuantReciclado').val()!=0){
                        $('#zero_config').append('<tr><td>Reciclado</td><td>'+$('#iQuantReciclado').val()+'g</td></tr>');
                    }
                    if($('#iQuantPigmento').val()!=''){
                        $('#iPigmento').prop('required',true);
                        $('#zero_config').append('<tr><td>Pigmento</td><td>'+$('#iQuantPigmento').val()+'% '+pigmento+'</td></tr>');
                    }else{
                        $('#iQuantPigmento').prop('required',false);
                    }
                });

                //Busca no banco de dados e preenche o select de pigmentos e reciclados com as informações encontradas
                $('#iMaterial').on('change', function(){
                    datas = 'campo1='+$(this).val();

                    if($('#iMaterial').val() == '0'){
                        $('#divSelectPigmento').hide();
                        $('#divQtdMaterial').hide();
                        $('#divQtdPigmento').hide();
                        $('#divReciclado').hide();
                        $('#divQtdReciclado').hide();
                    } else {   
                        //Pigmentos relacionados ao material                  
                        $.ajax({
                            url: "php/carregaPigmentosCompativeis.php",
                            type: "POST",
                            data: datas,
                            dataType: "html",
                            success: function(html) {
                                $('#iPigmento').html(html);
                                $('#divSelectPigmento').show();   
                                $('#divQtdMaterial').show();                        
                                $('#divQtdPigmento').show();
                            }
                        });  
                        //Reciclados da mesma classe que o material
                        $.ajax({
                            url: "php/carregaRecicladosCompativeis.php",
                            type: "POST",
                            data: datas,
                            dataType: "html",
                            success: function(html) {
                                $('#iReciclado').html(html);
                            }
                        });
                    }                  
                });               
            })
            /*
            //Função Geral
            function setTableReceita(){
                $('#zero_config').empty();
                $('#zero_config').append('<thead><tr><th>Item</th><th>Quantidade</th></tr></thead>');
                var material='';
                var pigmento='';
                console.log('a - '+material+' b- '+pigmento);
                if($('#iQuantMaterial').val()!='' && $('#iQuantPigmento').val()!=''){
                    var pesoPigmento=0;
                    var pesoMaterial=$('#iQuantMaterial').val();
                    var porcentPigmento=$('#iQuantPigmento').val();
                    pesoPigmento=pesoMaterial*(porcentPigmento/100);
                    console.log('1- '+pesoMaterial);
                    console.log('2- '+porcentPigmento);
                    console.log('3- '+pesoPigmento);
                    pesoMaterial=pesoMaterial-pesoPigmento;
                    material='| '+pesoMaterial+'g';
                    pigmento='| '+pesoPigmento+'g';
                }
                console.log('mat: '+material);
                console.log('pig: '+pigmento);
                if($('#iQuantMaterial').val()!=''){
                    $('#zero_config').append('<tr><td>Material</td><td>'+$('#iQuantMaterial').val()+'g '+material+'</td></tr>');
                    $('#iQuantReciclado').prop('max',$('#iQuantMaterial').val());
                }
                if($('#iQuantReciclado').val()!='' && $('#iQuantReciclado').val()!=0){
                    $('#zero_config').append('<tr><td>Reciclado</td><td>'+$('#iQuantReciclado').val()+'g</td></tr>');
                }
                if($('#iQuantPigmento').val()!=''){
                    $('#zero_config').append('<tr><td>Pigmento</td><td>'+$('#iQuantPigmento').val()+'% '+pigmento+'</td></tr>');
                }
            }
            */
            
        </script>
    </body>    
</html>