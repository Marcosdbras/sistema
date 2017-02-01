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
                   
                    <!--
                    
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                    -->
                    
                </div><!--/.navbar-collapse -->
            </div>
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Aplicativos & Sistemas</h1>
                <p>Nossos sistemas tem mensalidade, mas não se assuste! O valor pago por mês é a garantia de um serviço de qualidade, pois, promove a constante evolução de nossos sistemas e a correção de eventuais bugs ou problemas sem a necessidade de gastos adicionais com atualizações frequentes.</p>
                <p>Conheça nossos sistemas online</p>
                <p><a class="btn btn-primary btn-lg" href="https://sistema-marcosbras.rhcloud.com/erp" role="button">Gestão Online&raquo;</a></p>

                <p>Management Applications and Statistics & Order of Service (MAPOS - Aplicações de Gestão e Estatísticas & Ordem de Serviço)  <br />É um sistema de gerenciamento de ordem de serviço e registro de vendas totalmente online, funciona em tablet e celular. Este é um excelente sistema para ser usado quando a capitação de equipamento para conserto fica distante do seu laboratório de manutenção e você precisa de uma comunicação rápida entre os dois pontos, com ele você controla toda rotina de uma oficina mecânica, assistência técnica, entre outras, porém, não precisa instalar no seu equipamento. Clique no botão acima, registre-se e já comece a usar.</p> 
                <p><a class="btn btn-primary btn-lg" href="erp/empresa/registrar.php" role="button">Registrar-se&raquo;</a></p>

                <p>Caso não tenha a senha de acesso ao sistema ainda, por gentileza clique em registra-se para que você consiga cadastrar sua empresa e um usuário principal que lhe permitirá realizar cadastro de clientes, produtos, verificar finanças, abrir ordem de serviço, venda, entre outras.</p> 

                
                
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
                    <p><a class="btn btn-default" href="#det-enefe" role="button">Detalhes sobre o E-NFE &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Controle Administrativo, Gestão de sua empresa - Sistema DataSAC</h2>
                    <p>Sistema DataSAC é instalado em sua máquina, este aplicativo permite cadastrar clientes, produtos, fornecedores, entre outros, e facilita a gestão de contas a pagar, receber, caixa, etc... Este sistema também vai acompanhado de um moderno módulo PDV ou frente de caixa, este módulo permite a transmissão de cupom fiscal S@T <sup>**</sup> e funciona independente do servidor de arquivos estar ligado, com esta caracteristica o servidor permite a conexão de muitos pontos de venda sem perder a performance. Clique em detalhe DataSAC e veja demonstração do aplicativo.</p>
                    <p><a class="btn btn-default" href="#det-datasac" role="button">Detalhes sobre o DataSAC &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Gestão administrativa - Sistema SYSTCOM</h2>
                    <p>Este sistema é similar ao DataSAC, porém, para seu módulo PDV ou frente de caixa funcionar depende do servidor de arquivos estar ligado; Sistema excelente para empresa com poucos pontos de venda. Clique em detalhe SYSTCOM e veja demonstração do aplicativo.</p>
                    <p><a class="btn btn-default" href="#det-systcom" role="button">Detalhes sobre o Systcom &raquo;</a></p>
                    <br />
                </div>

                <div class="col-md-4">
                    <p>Desenvolvimento de sistema sob medida para você e sua empresa. Apresente seu projeto ou a necessidade do seu negócio, orçamento sem compromisso.</p>
                    <br />
                    <font color="blue">
                    <h4>Entre em contato</h4>
                    <p>Celular e Whatsapp: 11-96393-0108</p>
                    <p>email: marcosbras@hotmail.com</p>
                    </font>
                </div>
                
                <div class="col-md-4">
                    <h2 id="det-datasac">Demonstrativo DataSAC</h2> 
                    <p>Tela principal</p>
                    <img alt="Tela Principal" src="img/teladatasac/telas/tela principal.JPG" />
                    <br />
                    
                    <p>Exemplo de algumas telas Financeiras</p>
                    <img alt="Apuração de Caixa" src="img/teladatasac/telas/apuracao_de_caixa.JPG" />
                    <img alt="Contas a pagar"   src="img/teladatasac/telas/contas_a_pagar.JPG" />
                    <img alt="Contas a receber" src="img/teladatasac/telas/contas_a_receber.JPG" />
                    <br />
                    
                    <p>Exemplo de algumas telas de Cadastro</p>
                    <img alt="Cadastro de clientes"  src="img/teladatasac/telas/cadastro_cliente.JPG" />
                    <img alt="Cadastro de Produto" src="img/teladatasac/telas/cadastro_produto.JPG" />
                    <br />
                    
                    <p>tela de venda balcão</p>
                    <img alt="Tela inicial de venda" src="img/teladatasac/telas/venda_abertura.JPG" />
                    <img alt="Tela realizando venda" src="img/teladatasac/telas/venda_realizando.JPG" />
                    <img alt="" src="img/teladatasac/telas/venda_fechando.JPG" />
                    <br />
                    
                    <p>Tela de login</p>
                    <img alt="Tela de entrada" src="img/teladatasac/telas/login.JPG" />
                    <br />
                    
                </div>


                <div class="col-md-4">
                    <h2 id="det-enefe">Demonstrativo Sistema E-NFE</h2>
                    <p>Exemplo de algumas telas Cadastro</p>
                    <img alt="Clientes"                       src="img/telanfe/telas/tela_cliente.jpg" />
                    <img alt="Produtos"                       src="img/telanfe/telas/tela_produto.JPG" />
                    <br />
                    <p>Tela de emissão de nota</p>
                    <img alt="Notas em digitação ou emitidas" src="img/telanfe/telas/tela_nfe_digitadas.JPG" />
                    <img alt="Emissão de nota"                src="img/telanfe/telas/tela_emitir_nfe.JPG" />
                    <img alt="Notas emitidas"                 src="img/telanfe/telas/tela_notas_emitidas.JPG" />
                    <br />
                    
                    <p>Tela principal</p>
                    <img alt="Tela Principal"                    src="img/telanfe/telas/tela_principal.JPG" />
                </div>
                
                <div class="col-md-4">
                    <h2 id="det-systcom">Demonstrativo Systcom</h2>
                    <p>Exemplo de algumas telas de cadastro</p>
                    <img alt="Cadastro de clientes" src="img/telasystcom/telas/cadastro_clientes.JPG" />
                    <img alt="Cadastro de produto" src="img/telasystcom/telas/cadastro_produto.JPG" />
                    <br />
                    
                    <p>Exemplo de algumas telas Financeiras</p>
                    <img alt="Apuração caixa" src="img/telasystcom/telas/apuracao_caixa.JPG" />
                    <img alt="Contas a receber" src="img/telasystcom/telas/contas_receber.JPG" />
                    <br />
                    
                    <p>Exemplo de algumas telas pedido</p>
                    <img alt="Pedido" src="img/telasystcom/telas/pedido.JPG" />
                    <img alt="Abertura pedido"  src="img/telasystcom/telas/pedido_abertura.JPG" />
                    <img alt="Fechamento pedido" src="img/telasystcom/telas/pedido_fechamento.JPG" />
                    <br />
                    
                    <p>Tela de venda balcão</p>
                    <img alt="Abertura pedido balcão" src="img/telasystcom/telas/venda_balcao_abertura.JPG" />
                    <img alt="Realização de pedido balcão" src="img/telasystcom/telas/venda_balcao_realizacao.JPG" />
                    <img alt="Fechamento pedido balcão" src="img/telasystcom/telas/venda_balcao_fechamento.JPG" />
                    <br />
                    
                    
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
