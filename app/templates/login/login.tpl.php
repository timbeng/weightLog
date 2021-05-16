<?php include_once TEMPLATE . "/includes/header.tpl.php"; ?>


<div class="main_content_wrapper">

    <div class="login_wrapper">
        <div class="container"> 
            <div id="login">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login_form" class="form" action="" method="post">
                                <h3 class="text-center">Logga in</h3>
                                <div class='login_message'></div>
                                <div class="form-group">
                                    <label for="username">Användarnamn:</label><br>
                                    <input type="text" name="username" id='username' class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Lösenord:</label><br>
                                    <input type="password" name="password" id='password' class="form-control">
                                </div>
                                <span class='google_policy'>
                                    Den här sidan skyddas av reCAPTCHA och Google
                                    <a href="https://policies.google.com/privacy" target='_blank'>Privacy Policy</a> och
                                    <a href="https://policies.google.com/terms" target='_blank'>Terms of Service</a> gäller.
                                </span>

                                <div class="form-group">
                                    <input type="submit" name="submit" class="my_btn pull-right login-button" value="Logga in">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php include_once TEMPLATE . "/includes/js.tpl.php"; ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= SITE_KEY ?>"></script>


<script>
    // Focus user
    document.getElementById('username').focus();

    $(document).ready(function() {

        $('#login_form').on('submit', function(e) {
            e.preventDefault();

            if ($('#username').val().length < 3) {
                $('.login_message').html("<pan style='color:red;'><i class='fa fa-exclamation' aria-hidden='true'></i> Du behöver fylla i en epostadress.</span>");
                return false;
            }
            if ($('#password').val().length < 3) {
                $('.login_message').html("<pan style='color:red;'><i class='fa fa-exclamation' aria-hidden='true'></i> Du behöver fylla i ett lösenord.</span>");
                return false;
            }

            $('.login-button').html("<i class='fa fa-spinner fa-pulse' aria-hidden='true'></i> Försöker logga in").prop('disabled', true);

            grecaptcha.ready(function() {
                grecaptcha.execute('<?= SITE_KEY; ?>', {
                    action: 'login'
                }).then(function(token) {

                    $('#login_form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');

                    var regnore_hash = null;
                    if ($('.regnore_hash').length) {
                        regnore_hash = $('.regnore_hash').val()
                    }

                    $.ajax({
                        url: "/login",
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            username: $('[name="username"]').val(),
                            password: $('[name="password"]').val(),
                            token: token,
                            regnore_hash: regnore_hash,
                            uri: $('.get_uri').data('uri')
                        },
                        success: function(data) {

                            $('.login_message').html("<div class='alert alert-success'>" + data.message + " </div>");
                            $('.login-button').html('Logga in').prop('disabled', false);

                            setTimeout(() => {
                                window.location.href = '<?= SITE_URL ?>' + (data.uri != null) ? '/' + data.uri : '/';
                            }, 2000);

                        },
                        error: function(data) {
                            $('.login_message').html("<div class='alert alert-danger'>" + data.responseJSON.message + " </div>");
                            $('.login-button').html('Logga in').prop('disabled', false);
                        }
                    });
                });
            });
        });
    });
</script>

</body>

</html>