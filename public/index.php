<?php
include "../vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder();
$builder->build();
session_start();
$_SESSION['code'] = $builder->getPhrase(); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Libresign</title>
</head>
<body>
    <div class="container">
        <h2 class="mb-5">Contact Us</h2>
        <form id="form_request" name="WebToLeadForm">
            <div class="form-group">
                <label for="name">Full Name*</label>
                <input type="text" class="form-control" id="last_name" name="last_name" 
                placeholder="Type your name" autocomplete="on" required/>
            </div>
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" class="form-control" id="email1"
                name="email1" placeholder="example@youremail.com" 
                autocomplete="on" required />
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone_mobile" 
                name="phone_mobile" placeholder="+885 1254 5211 552" 
                autocomplete="on" />
            </div>
            <div class="form-group mb-5">
                <label for="longText">Message*</label>
                <textarea class="form-control" id="description"
                name="description" rows="3" required></textarea>
            </div>
            
            <div class="row mb-3">
                <div class="col-6">
                    <input type="text" class="form-control" name="codeImg" id="codeImg"
                    placeholder="type the code in the side" required/>
                </div>
                <div class="col-4" id="codeRecaptcha">
                    <?php 
                        $builder = new CaptchaBuilder();
                        $builder->build(); 
                    ?>
                    <img class="mr-3 mb-2" src="<?php echo $builder->inline(); ?>">
                    <a href="#" type="button" class="text-body">
                        <i data-feather="refresh-ccw"></i>
                    </a>
                </div>
            </div>            
            
            <input type='submit' form="form_request" class='btn btn-success mb-5' value="Send Message" />

            <input name="campaign_id" id="campaign_id" type="hidden" 
                       value="91c4e277-95b8-ce28-91fd-658d9aa871ac" />
            <input name="assigned_user_id" id="assigned_user_id" type="hidden" 
                       value="89cce704-603d-79d7-b069-65660c3a0b7d" />
            <input name="moduleDir" id="moduleDir" type="hidden" 
                   value="Contacts" />            

        </form>
    </div>

    <script src="./js/jquery/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
