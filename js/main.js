jQuery(document).on('submit', '#formlg', function(event) {
    event.preventDefault();

    jQuery.ajax({
            url: 'login.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {
                $('.login-form__submit').val('Validando...');
            }
        })
        .done(function(respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                if (respuesta.tipo == 'U') {
                    location.href = 'indicador.html';
                } else if (respuesta.tipo == 'A') {
                    location.href = 'dash.html';
                }
            } else {
                $('.error').slideDown('slow');
                setTimeout(function() {
                    $('.error').slideUp('slow');
                }, 3000);
                $('.login-form__submit').val('login');

            }
        })
        .fail(function(resp) {
            console.log(resp.responseText);
        })
        .always(function() {
            console.log("complete");
        });
});