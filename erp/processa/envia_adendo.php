<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../biblioteca/read.data.php';
require_once '../../biblioteca/funcoes.php';

if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
}

if (isset($_POST['rg'])) {
    $rg = $_POST['rg'];
}

if (isset($_POST['telefone'])) {
    $telefone = $_POST['telefone'];
}

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
}

if (isset($_POST['senha'])) {
    $senha = $_POST['senha'];
}

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>

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

    </head>

    <body>

        <?php
        // Se nenhum valor foi recebido, o usuário não realizou o captcha
        if (!$captcha_data) {
            echo "Por favor, confirme o captcha.";
            exit;
        }

        $resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf8yA0UAAAAAJvkdiZy7HIq5UspdTuXnjWhHuGB&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($resposta . success) {



            $chave = md5(time());
            $senha = sha1($senha);
            $data = date('Y-m-d', time());


            $campos = array("email" => "$email",
                "nome" => "$nome",
                "senha" => "$senha",
                "chave" => "$chave",
                "situacao" => "1",
                "ativo" => "1",
                "mestre" => "S",
                "cpf" => "$cpf",
                "telefone" => "$telefone",
                "dataCadastro" => "$data",
                "nivel" => "1",
                "permissoes_id" => "1");


            $result = DBRead('usuarios',"where email ='" . $email."' and mestre = 'S' limit 1" );
            if (!$result) {
                $id = DBCreate('usuarios', $campos, true);                
                
                if ($id == 0) {                    
                    
                    echo '<script type="text/javascript">';
                    echo 'alert("Erro ao salvar registro!");';
                    echo "$(location).attr('href','../empresa/registrar.php');";
                    echo '</script>';                    
                    
                } else {
                    
                    $campos = array("idusumestre"=>"$id", 
                                    "nome"=>"Admin",
                                    "permissoes"=>'a:38:{s:8:"aCliente";s:1:"1";s:8:"eCliente";s:1:"1";s:8:"dCliente";s:1:"1";s:8:"vCliente";s:1:"1";s:8:"aProduto";s:1:"1";s:8:"eProduto";s:1:"1";s:8:"dProduto";s:1:"1";s:8:"vProduto";s:1:"1";s:8:"aServico";s:1:"1";s:8:"eServico";s:1:"1";s:8:"dServico";s:1:"1";s:8:"vServico";s:1:"1";s:3:"aOs";s:1:"1";s:3:"eOs";s:1:"1";s:3:"dOs";s:1:"1";s:3:"vOs";s:1:"1";s:6:"aVenda";s:1:"1";s:6:"eVenda";s:1:"1";s:6:"dVenda";s:1:"1";s:6:"vVenda";s:1:"1";s:8:"aArquivo";b:0;s:8:"eArquivo";b:0;s:8:"dArquivo";b:0;s:8:"vArquivo";b:0;s:11:"aLancamento";s:1:"1";s:11:"eLancamento";s:1:"1";s:11:"dLancamento";s:1:"1";s:11:"vLancamento";s:1:"1";s:8:"cUsuario";s:1:"1";s:9:"cEmitente";s:1:"1";s:10:"cPermissao";s:1:"1";s:7:"cBackup";b:0;s:8:"rCliente";s:1:"1";s:8:"rProduto";s:1:"1";s:8:"rServico";s:1:"1";s:3:"rOs";s:1:"1";s:6:"rVenda";s:1:"1";s:11:"rFinanceiro";s:1:"1";}',
                                    "situacao"=>'1',
                                    "data"=>date('Y-m-d'),
                                    "iddetalhe"=>'1');
                    
                    $idPermissao = DBCreate('permissoes', $campos, true);
                    
                    $campos = array("idusumestre"=>"$id","permissoes_id"=>$idPermissao);
                    
                    DBUpDate('usuarios', $campos, "idUsuarios=$id");                    
                    
                    echo "Registro criado $id";
                    echo '<script type="text/javascript">';
                    echo 'alert("Registro salvo com sucesso!");';
                    echo "$(location).attr('href','../index.php');";
                    echo '</script>';               
               }
            } else {
                
                    echo '<script type="text/javascript">';
                    echo 'alert("Este email já existe!\\nEmail já encontra-se registrado em nossa base de dados\\nEnvie um email para marcosbras@hotmail.com e solicite nova senha de acesso,\\naguarde resposta de sua solicitação, caso não tenha mais acesso ao email envie cópia do cpf e RG para o mesmo email");';
                    echo "$(location).attr('href','../empresa/registrar.php');";
                    echo '</script>';                
                
            }
        } else {           
            
             echo '<script type="text/javascript">';
             echo 'alert("Falha no captcha!");';
             echo "$(location).attr('href','../index.php');";
             echo '</script>';            
        }
        ?>

    </body>
</html>


