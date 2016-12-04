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


