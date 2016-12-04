<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../biblioteca/read.data.php';
require_once '../../biblioteca/funcoes.php';
include_once('../processa/envia_adendo.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>


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
                <div  class="span6 col-xs-5 col-sm-6 col-lg-4" >
                    <p>Termo de Uso</p>
                    <?php 
                    
                    $param = DBRead('parametro_geral');
                    foreach ($param as $p){
                        $txt_contrato = $p['txt_contrat'];
                        echo "<p> $txt_contrato </p>";
                        
                    }
                    
                    ?>                             


                </div>    


                <div class="span6 col-xs-7 col-sm-6 col-lg-8">
                    <!-- Formulário cadastro-->  
                    <form name="myform" class="form-horizontal"  onsubmit="return OnSubmitForm();" action="../../processa/envia_adendo.php"  name="form" method="post" >
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




                        </fieldset>
                    </form>    


                </div>
            </div>            





        </div> 
    </body>
</html>   







