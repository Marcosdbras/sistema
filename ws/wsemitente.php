<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 17JBJpoO2tCCCsMwbqmEGVqcZEO3FL159387225000195
 */



require_once '../biblioteca/funcoes.php';
require_once '../geral/config.php';
require_once '../geral/conectar.php';
require_once '../geral/database.php';
require_once '../geral/xmlClass.php';

clearCache();

$erro = 0;
$ativo = -1;

$chave = $_POST['chave'];
if (empty($chave)) {
    $chave = $_GET['chave'];
}

$modo = $_POST['modo'];
if (empty($modo)) {
    $modo = $_GET['modo'];
}

$campo = $_POST['campo'];
if (empty($campo)) {
    $campo = $_GET['campo'];
}

$valor = $_POST['valor'];
if (empty($valor)) {
    $valor = $_GET['valor'];
}

$id = $_POST['id'];
if (empty($id)) {
    $id = $_GET['id'];
}

$cnpj = $_POST['cnpj'];
if (empty($cnpj)) {
    $cnpj = $_GET['cnpj'];
}

$result = DBRead('acesso', "Where chave='" . $chave . "'");
foreach ($result as $res) {
    //echo $res['id'];
    $result_emitente = DBRead('emitentes', "Where id_cadastro='" . $res['cemi'] . "'");
    foreach ($result_emitente as $res_emitente) {
        $ativo = $res_emitente['ativo'];
        $valor = $res_emitente['id_cadastro'];
        $campo = 'id_cadastro';
    }
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$fantasia = $_POST['fantasia'];
$telefones = $_POST['telefones'];
$ie = $_POST['ie'];
$site = $_POST['site'];
$contato = $_POST['contato'];
$endereco = $_POST['endereco'];
$nro = $_POST['nro'];
$compl = $_POST['compl'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$im = $_POST['im'];
$obs = $_POST['obs'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$regtrib = $_POST['regtrib'];
$bloqueado = $_POST['bloqueado'];
$suporte = $_POST['suporte'];

if (empty($modo)) {
    echo 'Modo da operação não informado!';
    Exit();
}

$campos = array("cnpj" => "$cnpj", //ok
                "nome" => "$nome", //ok
                "email" => "$email",//ok                 
                "telefone" => "$telefones", //ok
                "ie" => "$ie", //ok 
                "rua" => "$endereco", //ok
                "numero" => "$nro", //ok              
                "bairro" => "$bairro", //ok 
                "cep" => "$cep", //ok
                "cidade" => "$cidade", //ok   
                "uf" => "$uf", //ok 
                "idusumestre" => "$idusumestre", //ok 
                "ibge" => "$ibge", //ok
                "venda" => "$venda", 
                "os" => "$os",//ok 
                "comanda" => "$comanda"//ok     
                );
//""=>""

switch ($modo) {
    case E:


        if (empty($campo) || empty($valor)) {
            echo "campo ou valor não informado para alteração, operação abortada!";
            break;
        }

        $result = DBRead('emitentes', "Where $campo = $valor");
        if ($result) {

            DBDelete('emitentes', "Where $campo = $valor");
        } else {

            echo "$campo $valor não existe, exclusão abortada!";
        }


        break;
    case A:


        if (empty($campo) || empty($valor)) {
            echo "campo ou valor não informado para alteração, operação abortada!";
            break;
        }

        $result = DBRead('emitentes', "Where $campo = $valor");
        if ($result) {

            DBUpDate('emitentes', $campos, "Where $campo = $valor");
        } else {

            echo "$campo $valor não existe, atualização abortada!";
        }


        break;
    case I:
        if (empty($cnpj) || empty($nome)) {
            echo 'cnpj ou nome não informado para inclusão, operação abortada!';
            break;
        }

        $result = DBRead('emitentes', "Where cnpj = $cnpj");
        foreach ($result as $res) {

            echo "CNPJ $cnpj já existe";
        }if (!$result) {

            DBCreate('emitentes', $campos, false);
            echo "Salvo com sucesso " . $cnpj;
        }

        echo "Fim do processamento";

        break;

    case C:


        $result = DBRead('emitentes', "Where $campo = $valor");

        #versao do encoding xml

        $dom = new DOMDocument("1.0", "UTF-8");

        #retirar os espacos em branco

        $dom->preserveWhiteSpace = false;

        #gerar o codigo

        $dom->formatOutput = true;

        #criando o nó principal (root)

        $root = $dom->createElement("wsemitente");


        #nó filho (response)

        $response = $dom->createElement("response");

        foreach ($result as $res) {

            $cnpj = $res['cnpj'];
            $nome = $res['nome'];
            $email = $res['email'];
            $fantasia = $res['fantasia'];
            $telefones = $res['telefones'];
            $ie = $res['ie'];
            $erro = '0';
            $msgerro = 'Informação encontrada com sucesso';
            $site = $res['site'];
            $contato = $res['contato'];
            $endereco = $res['endereco'];
            $nro = $res['nro'];
            $compl = $res['compl'];
            $bairro = $res['bairro'];
            $cep = $res['cep'];
            $im = $res['im'];
            $obs = $res['obs'];

            $cidade = $res['cmun'];
            $estado = $res['cest'];
            $regtrib = $res['cregtrib'];

            $ativo = $res['ativo'];
            $bloqueado = $res['bloqueado'];
            $csegmento = $res['csegmento'];


            $dadosEmitente = $dom->createElement("dadosEmitente");

            #setanto ceps e atributos dos elementos xml (nós)

            $cnpj = $dom->createElement("cnpj", "$cnpj");

            $nome = $dom->createElement("nome", "$nome");

            $email = $dom->createElement("email", "$email");

            $fantasia = $dom->createElement("fantasia", "$fantasia");

            $telefones = $dom->createElement("telefones", "$telefones");

            $ie = $dom->createElement("ie", "$ie");

            $resultado = $dom->createElement("resultado", "$erro");

            $resultadotxt = $dom->createElement("resultadotxt", "$msgerro");

            $site = $dom->createElement("site", "$site");

            $contato = $dom->createElement("contato", "$contato");

            $endereco = $dom->createElement("endereco", "$endereco");

            $nro = $dom->createElement("nro", "$nro");

            $compl = $dom->createElement("compl", "$compl");

            $bairro = $dom->createElement("bairro", "$bairro");

            $cep = $dom->createElement("cep", "$cep");

            $im = $dom->createElement("im", "$im");

            $obs = $dom->createElement("obs", "$obs");

            $cidade = $dom->createElement("cidade", "$cidade");

            $estado = $dom->createElement("estado", "$estado");

            $regtrib = $dom->createElement("regtrib", "$regtrib");

            $ativo = $dom->createElement("ativo", "$ativo");

            $bloqueado = $dom->createElement("bloqueado", "$bloqueado");

            $csegmento = $dom->createElement("segmento_cest", "$csegmento");


            #adiciona os nós (informacaoes do response) em response

            $dadosEmitente->appendChild($cnpj);

            $dadosEmitente->appendChild($nome);

            $dadosEmitente->appendChild($email);

            $dadosEmitente->appendChild($fantasia);

            $dadosEmitente->appendChild($telefones);

            $dadosEmitente->appendChild($ie);

            $dadosEmitente->appendChild($resultado);

            $dadosEmitente->appendChild($resultadotxt);

            $dadosEmitente->appendChild($site);

            $dadosEmitente->appendChild($contato);

            $dadosEmitente->appendChild($endereco);

            $dadosEmitente->appendChild($nro);

            $dadosEmitente->appendChild($compl);

            $dadosEmitente->appendChild($bairro);

            $dadosEmitente->appendChild($cep);

            $dadosEmitente->appendChild($im);

            $dadosEmitente->appendChild($obs);

            $dadosEmitente->appendChild($cidade);

            $dadosEmitente->appendChild($estado);

            $dadosEmitente->appendChild($regtrib);

            $dadosEmitente->appendChild($ativo);

            $dadosEmitente->appendChild($bloqueado);

            $dadosEmitente->appendChild($csegmento);

            $response->appendChild($dadosEmitente);
        }if (!$result) {

            $erro = 2;

            $msgerro = "$campo $valor informação não localizada!";

            $resultado = $dom->createElement("resultado", "$erro");

            $resultadotxt = $dom->createElement("resultadotxt", "$msgerro");

            $response->appendChild($resultado);

            $response->appendChild($resultadotxt);
        }


        #adiciona o nó response em (root) wscep

        $root->appendChild($response);

        $dom->appendChild($root);



        # Para salvar o arquivo, descomente a linha
        //$dom->save("responses.xml");
        #cabeçalho da página

        header("Content-Type: text/xml");

        # imprime o xml na tela

        echo $dom->saveXML();


        break;
}