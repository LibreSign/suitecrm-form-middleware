$("#form_request").submit(function(e){
    e.preventDefault();

    let name = $('#last_name').val();
    let email = $('#email1').val();
    let phone = $('#phone_mobile').val();
    let longText = $('#description').val();
    let codeImg = $('#codeImg').val();

    $.ajax({
        url: '/validate_fields.php',
        method: 'POST',
        data: {
            name: name,
            email: email,
            phone: phone,
            longText: longText,
            codeImg: codeImg,
        },
        dataType: 'json',
        success: function(data){
            if(data.error){
                $('#message').show().text(data.message);
                return
            }
            window.top.location.href = "https://libresign.coop/thank-you-contact"
        },
    })
});

//reload captcha
$(document).ready(function(){
    showCaptcha();
    $("#btnReload").click(function(){
        showCaptcha();
    });
    
    function showCaptcha(){
        $.ajax({
            type:'POST',
            url:'/reload_captcha.php',
            success:function(data){
                $('#captcha').html(data)
            }
        });
    }
});