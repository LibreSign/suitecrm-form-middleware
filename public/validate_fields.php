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

$response = [
    'message' => '',
    'error' => false
];

if( $builder->testPhrase($codeImg)){
    
    $url = $_ENV['URL_SUITECRM'];

    $formulario_data = array(
        'moduleDir' => 'Contacts',
        'assigned_user_id' => $_ENV['ASSIGNED_USER_ID'],
        'campaign_id' => $_ENV['CAMPAIGN_ID'],
        'last_name' => $name,
        'email1' => $email,
        'phone_mobile' => $phone,
        'description' => $longText
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $formulario_data);

    $resposta = curl_exec($ch);

    if (curl_errno($ch)) {
        $response = [
            'message' => 'Sending Error',
            'error' => true
        ];
    }

    curl_close($ch);

}else{
    $response = [
        'message' => 'Divergent Captcha',
        'error' => true
    ];
}

echo json_encode($response);