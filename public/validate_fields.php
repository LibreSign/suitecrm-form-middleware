<?php

include "../vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;

session_start();

$builder = new CaptchaBuilder($_SESSION['code']);


header('Content-Type: application/json');

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone');
$longText = filter_input(INPUT_POST, 'longText');
$codeImg = filter_input(INPUT_POST, 'codeImg');

if( $builder->testPhrase($codeImg)){
    
   // URL do destino
    $url = $_ENV['URL_SUITECRM'];

    // Dados do formulário a serem enviados
    $formulario_data = array(
        'moduleDir' => 'Contacts',
        'assigned_user_id' => $_ENV['ASSIGNED_USER_ID'],
        'campaign_id' => $_ENV['CAMPAIGN_ID'],
        'last_name' => $name,
        'email1' => $email,
        'phone_mobile' => $phone,
        'description' => $longText
        // Adicione outros campos conforme necessário
    );

    // Inicializa a sessão cURL
    $ch = curl_init($url);

    // Configuração das opções da requisição
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Retorna o resultado da requisição como string
    curl_setopt($ch, CURLOPT_POST, 1); // Define o método da requisição como POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $formulario_data); // Adiciona os dados do formulário à requisição

    // Executa a requisição
    $resposta = curl_exec($ch);

    // Verifica por erros
    if (curl_errno($ch)) {
        echo 'Erro cURL: ' . curl_error($ch);
    }

    // Fecha a sessão cURL
    curl_close($ch);

    // Exibe a resposta do servidor
    // var_dump($resposta);
    echo "{}";
}else{
    echo "divergentes";
}