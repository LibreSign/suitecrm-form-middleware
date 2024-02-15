<?php

include "../vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder();
$builder->build();

session_start();
$_SESSION['code'] = $builder->getPhrase(); 
?>


<img class="mr-3 mb-2" src="<?php echo $builder->inline(); ?>">