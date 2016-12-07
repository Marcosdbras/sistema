<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../biblioteca/read.data.php';
require_once '../../biblioteca/funcoes.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>
            Ordem de serviço e venda

        </title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Nota Fiscal Eletrônica, NFE, ERP, Online, Programa, Administrativo">
        <meta name="author" content="Marcos Brás">
        <!--   <link rel="icon" href="/image/favicon.ico"> -->

        <title>Ordem de Serviço e venda</title>

        <!-- Bootstrap core CSS -->
        <link href="/stylebootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="/stylebootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="/stylebootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/stylebootstrap/css/theme.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="/stylebootstrap/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jquery-ui -->
        <script src="/stylebootstrap/css/jquery-ui/external/jquery/jquery.js"></script>
        <script src="/stylebootstrap/js/jquery-ui/jquery-ui.js"></script>




        <script src='https://www.google.com/recaptcha/api.js?hl=pt-br'></script>

        <style>
            body {
                color: #404040;
                font-family: "Helvetica Neue",Helvetica,"Liberation Sans",Arial,sans-serif;
                font-size: 14px;
                line-height: 1.4;
            }

            html {
                font-family: sans-serif;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }
        </style>       
    </head>
    <body>
        <div class="container-fluid">
            <div class="page-header">
                <h1>Registre-se...</h1>        
            </div> 

            <div class="row-fluid">

                <div class="span6 col-xs-7 col-sm-6 col-lg-8">
                    <!-- Formulário cadastro-->  
                    <form name="myform" class="form-horizontal"  onsubmit="return OnSubmitForm();" action="../processa/envia_adendo.php"  name="form" method="post" >
                        <fieldset>
                            <!-- Form Name -->
                            <div class="alert alert-success"><legend>Preencha o formulário abaixo para acessar a área administrativa do site.</legend></div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="login">Nome Usuário</label>  
                                <div class="col-md-5">
                                    <input id="login" name="login" placeholder="" class="form-control input-md" required="required" type="text">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">Email</label>  
                                <div class="col-md-6">
                                    <input id="email" name="email" placeholder="" class="form-control input-md" required="required" type="text">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email1">Confirma email</label>  
                                <div class="col-md-6">
                                    <input id="email1" name="email1" placeholder="" class="form-control input-md" required="required" type="text">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="senha">Senha</label>
                                <div class="col-md-4">
                                    <input id="senha" name="senha" placeholder="" class="form-control input-md" required="" type="password">
                                    <!--<span class="help-block">Esqueceu senha?</span>-->
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="senha1">Confirma Senha</label>
                                <div class="col-md-4">
                                    <input id="senha1" name="senha1" placeholder="" class="form-control input-md" required="required" type="password">
                                    <!--<span class="help-block">Esqueceu senha?</span>-->
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="concordou"> Concordo com os termos do contrato
                                        </label>
                                    </div>
                                </div>
                            </div>                            

                            <div class = "form-group">
                                <div class="col-md-4 g-recaptcha" data-sitekey="6Lf8yA0UAAAAAHDCinNV3ppOcosQnjjrmK_Pdo7j"></div>
                            </div> 

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="enviar"></label>
                                <div class="col-md-8">
                                    <button id="aderir" name="aderir" class="btn btn-success">Aderir</button>
                                    <button id="limpar" type="reset" name="reset"  class="btn btn-warning">Limpar</button>
                                   <!-- <input type="reset" name="reset" value="Limpar">-->
                                </div>
                            </div>



                        </fieldset>
                    </form>    


                </div>

                <div class="span6 col-xs-5 col-sm-6 col-lg-4" >

                    <?php
                    $param = DBRead('parametro_geral');
                    foreach ($param as $p) {
                        $txt_contrato = $p['txt_contrato'];
                        echo "<p> $txt_contrato </p>";
                    }
                    ?>                             


                </div>

            </div>            





        </div> 
        
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/stylebootstrap/js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/stylebootstrap/js/jquery.min.js"><\/script>');</script>
        <script src="/stylebootstrap/js/bootstrap.min.js"></script>
        <script src="/stylebootstrap/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/stylebootstrap/js/ie10-viewport-bug-workaround.js"></script>


        <script type="text/javascript">

            function OnSubmitForm() {


                var processa = true;
                
                if (document.getElementById('concordou').checked == false){
                  
                    alert('Concorde com os termos do contrato para prosseguir'); 
                   
                    processa = false;                  
                    
                }

                if (document.getElementById('email').value !== document.getElementById('email1').value) {

                    alert('email não confere, por gentileza redigite-o novamete e também seu respectivo campo de conferência'); 
                   
                    processa = false;

                }

                if (document.getElementById('senha').value !== document.getElementById('senha1').value) {

                    alert('senha não confere, por gentileza redigite-o e também seu respectivo campo de conferência'); 
            
                    processa = false;

                }


                return processa;
            }

        </script>
        
        
    </body>
</html>   







