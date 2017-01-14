<?php
require_once 'biblioteca/read.data.php';
require_once 'biblioteca/funcoes.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="sistemas e aplicativos" content="NFE, S@T, Aplicativo, sistema, sat, Ordem de serviço, venda, online, nota fiscal eletrônica gratuita, secretaria da fazenda, SEFAZ, sefaz, Controle Administrativo, Gestão de sua empresa, Administrativa">
    <meta name="Marcos Brás" content="">
    <link rel="icon" href="favicon.ico">

    <title>Aplicativos comerciais</title>

    <!-- Bootstrap core CSS -->
    <link href="/stylebootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/stylebootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/stylebootstrap/css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/stylebootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Aplicativos e sistemas comerciais</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Aplicativos & Sistemas</h1>
        <p>Nossos sistemas tem mensalidade, mas não se assuste! O valor pago por mês é a garantia de um serviço de qualidade, pois, promove a constante evolução de nossos sistemas e a correção de eventuais bugs ou problemas sem a necessidade de gastos adicionais com atualizações frequentes.</p>
        <p>Conheça nossos sistemas online</p>
        <p>Ordem de serviço e registro de vendas totalmente online, não precisa instalar na sua máquina, Clique no botão abaixo, registre-se e use-o</p> 
        <p><a class="btn btn-primary btn-lg" href="https://goo.gl/U6713R" role="button">Ordem de Serviço Online&raquo;</a></p>
        
        <p></p>
        <p></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Nota fiscal eletrônica - Sistema E-NFE</h2>
          <p>Emissor NFE é instalado na sua máquina, porém, após a instalação e as devidas configurações você vai perceber um sistema muito simples de manusear e de realizar a transmissão de suas notas para a secretaria da fazenda(SEFAZ). Deixe a instalação, configuração<sup>*</sup> e treinamento por nossa conta. Clique em detalhe E-ENFE e veja demonstração do aplicativo.</p>
          <p><a class="btn btn-default" href="#det-enefe" role="button">Detalhes E-NFE &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Controle Administrativo, Gestão de sua empresa - Sistema DataSAC</h2>
          <p>Sistema DataSAC é instalado em sua máquina, este aplicativo permite cadastrar clientes, produtos, fornecedores, entre outros, e facilita a gestão de contas a pagar, receber, caixa, etc... Este sistema também vai acompanhado de um moderno módulo PDV ou frente de caixa, este módulo permite a transmissão de cupom fiscal S@T <sup>**</sup> e funciona independente do servidor de arquivos estar ligado, com esta caracteristica o servidor permite a conexão de muitos pontos de venda sem perder a performance. Clique em detalhe DataSAC e veja demonstração do aplicativo.</p>
          <p><a class="btn btn-default" href="#" role="button">Detalhes DataSAC &raquo;</a></p>
       </div>
       <div class="col-md-4">
          <h2>Gestão administrativa - Sistema SYSTCOM</h2>
          <p>Este sistema é similar ao DataSAC, porém, para seu módulo PDV ou frente de caixa funcionar depende do servidor de arquivos estar ligado; Sistema excelente para empresa com poucos pontos de venda. Clique em detalhe SYSTCOM e veja demonstração do aplicativo.</p>
          <p><a class="btn btn-default" href="#" role="button">Detalhes Systcom &raquo;</a></p>
        </div>

       <div class="col-md-4">
          <h2 id="det-enefe">Demosntração Sistema E-NFE</h2>
          <img alt="Clientes" src="img/telanfe/telas/tela_cliente.jpg"/>
          
        </div>
          
          
          
      </div>

      <hr>

      <footer>
        <p>&copy; 2017 Marcos Brás - Desenvolvedor Freelancer, Inc.</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/stylebootstrap/js/jquery.min.js"><\/script>')</script>
    <script src="/stylebootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/stylebootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
