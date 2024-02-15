$("#form_request").submit(function(e){
    e.preventDefault();

    let name = $('#last_name').val();
    let email = $('#email1').val();
    let phone = $('#phone_mobile').val();
    let longText = $('#description').val();
    let codeImg = $('#codeImg').val();
    let codeType = $('#codeType').val();

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
            window.top.location.href = "https://libresign.coop/thank-you-contact"
        },
    })
});