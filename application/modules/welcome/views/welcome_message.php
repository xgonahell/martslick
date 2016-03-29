<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="img/ico/favicon.png">
    <title>Login</title>

    <!-- Base Styles -->
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/css/style-responsive.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


</head>

  <body class="login-body">

      <div class="login-logo">
          <img src="<?php echo base_url() ?>/assets/img/login_logo.png" alt=""/>
      </div>

      <h2 class="form-heading">login</h2>
      <div class="container log-row">
          <form class="form-signin">
              <div class="login-wrap">
                  <input type="text" id="username" type="username" class="form-control" placeholder="User ID" autofocus>
                  <input type="password" id="password" class="form-control" placeholder="Password">
                  <button id="submit" type="submit" class="btn btn-lg btn-success btn-block">LOGIN</button>
                  <label class="checkbox-custom check-success">
                      <input type="checkbox" value="remember-me" id="checkbox1"> <label for="checkbox1">Remember me</label>
                  </label>
              </div>
          </form>
      </div>


      <!--jquery-1.10.2.min-->
      <script src="<?php echo base_url() ?>/assets/js/jquery-1.11.1.min.js"></script>
      <!--Bootstrap Js-->
      <script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>

  </body>
</html>
        <script type="text/javascript">
                $(document).ready(function ()
                {

                    $('#loader-gif').hide();
                    $('#loader-message').hide();

                    $('#username').keyup(function (e) {
                        if (e.keyCode == 13)
                        {
                            $('#submit').click();
                        }
                    });

                    $('#password').keyup(function (e) {
                        if (e.keyCode == 13)
                        {
                            $('#submit').click();
                        }
                    });

                    $('#submit').click(function ()
                    {

                        $('#loader-message').show();
                        $('#loader-message').html("Authenticating...");

                        if ($('#username').val() == "" || $('#password').val() == "")
                        {

                            $('#loader-message').html("<font color=\"#ff0000\">Please fill username and password</font>");
                        } else
                        {
                            $('#loader-gif').show();
                            $.ajax({
                                method: "POST",
                                url: "<?php echo base_url() ?>user_control/login",
                                data: {username: $('#username').val(), password: $('#password').val()},
                                dataType: 'json',
                                success: function (m)
                                {
                                    if (m.success == true)
                                    {
                                        $('#loader-gif').hide();
                                        $('#loader-message').html("<font color=\"#00ff00\">" + m.message + "</font>");
                                        window.location = "<?php echo base_url() ?>dashboard"
                                    } else
                                    {
                                        $('#loader-gif').hide();
                                        $('#loader-message').html("<font color=\"#ff0000\">" + m.message + "-</font>");
                                    }
                                },
                                error: function (e) {
                                    console.log(e.statusText);
                                }
                            });
                        }
                    });
                });
        </script>
        <!-- common templates -->