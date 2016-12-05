<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../biblioteca/read.data.php';
require_once '../../biblioteca/funcoes.php';


if (isset($_POST['login'])) {
    $login = $_POST['login'];
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
                "nome" => "$login",
                "senha" => "$senha",
                "chave" => "$chave",
                "situacao" => "1",
                "ativo" => "1",
                "mestre" => "S",
                "cpf" => "111111111",
                "telefone" => "111111-1111",
                "dataCadastro" => "$data",
                "nivel" => "1",
                "permissoes_id" => "1");


            $result = DBRead('usuarios', "Where email ='" . $mail."' and mestre = 'S'" );
            if (!$result) {
                $id = DBCreate('usuarios', $campos);
                if ($id == 0) {

                    echo '<p>Erro ao salvar registro!</p>';
                    
                } else {

                    echo '<p>Registro salvo com sucesso!</p>';
                }
            } else {

                echo '<p>Este email já encontra-se registrado em nossa base de dados</p>';
                echo '<p>Envie um email para marcosbras@hotmail.com e solicite nova senha de acesso,</p>';
                echo '<p>aguarde resposta de sua solicitação, caso não tenha mais acesso ao email observe a cláusula ____ </p>';
                echo '<p>do contrato de uso do software</p>';
                
            }
        } else {
            echo "Falha no captcha!";
        }
        ?>



    </body>
</html>


