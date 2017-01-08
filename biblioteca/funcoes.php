<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function js_aoEntrarNoCampo(){
    echo'<script type="text/javascript">';
    echo'  function aoEntrarNoCampoPreco(valor) {';
    echo  "  document.getElementById('preco').value = valor;";
    echo' };';    
    echo'</script>';
    
    echo'<script type="text/javascript">';
    echo'  function aoEntrarNoCampoPrecoServico(valor) {';
    echo  "  document.getElementById('precoServico').value = valor;";
    echo' };';    
    echo'</script>';
    
    
}


function js_aoSairDoCampo(){
    echo'<script type="text/javascript">';

    echo'  function aoSairDoCampoQtde(valor) {';
    //echo'    var regra = /^[0-9]+$,/;';
    //echo'    if (!valor.match(regra)) {';
    //echo'        alert("Valor não permitido no campo "+campo+"!");';
    //echo'    }';
    echo' };'; 
    
    echo'  function aoSairDoCampoPreco(valor) {';
    //echo'    var regra = /^[0-9]+$,/;';
    //echo'    if (!valor.match(regra)) {';
    //echo'        alert("Valor não permitido no campo "+campo+"!");';
    //echo'    }';
    echo' };'; 
    
    echo'  function aoSairDoCampoPrecoServico(valor) {';


    echo' };'; 




    echo'</script>';
}

function clearCache(){
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, cachehack=".time());
header("Cache-Control: no-store, must-revalidate");
header("Cache-Control: post-check=-1, pre-check=-1", false); 

    
}


function fileCreatetxt($contents, $file, $overWrite = 'n', $lineBreak = 'y', $folder = NULL) {
    $fileFolder = $folder . $file;
    if ($overWrite == 'n') {
        $overWrite = FILE_APPEND;
    } else {
        $overWrite = null;
    }

   $contents = "$contents";


    file_put_contents($fileFolder, $contents, $overWrite);
}

function downloadFile($file, $folder = null) {
    $fileFolder = $folder . $file;

    // Define o tempo máximo de execução em 0 para as conexões lentas
    set_time_limit(0);
    // Arqui você faz as validações e/ou pega os dados do banco de dados
    $aquivoNome = 'texto.txt'; // nome do arquivo que será enviado p/ download
    $arquivoLocal = 'downloads/' . $aquivoNome; // caminho absoluto do arquivo
    // Verifica se o arquivo não existe
    if (!file_exists($arquivoLocal)) {
    // Exiba uma mensagem de erro caso ele não exista
        exit;
    }
    // Aqui você pode aumentar o contador de downloads
    // Definimos o novo nome do arquivo
    $novoNome = 'texto.txt';
    // Configuramos os headers que serão enviados para o browser
    $type = filetype($arquivoLocal);
    $size = filesize($arquivoLocal);
    
    header("Content-Description: File Transfer");
    header("Content-Type:{$type}");
    header("Content-Length: {$size}");
    header("Content-Disposition: attachment; filename={$aquivoNome}");
    
    
    // Envia o arquivo para o cliente
    readfile($arquivoLocal);
    
     download($novoNome); 
    
}
