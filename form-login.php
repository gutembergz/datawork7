<?php
session_start();
require 'init.php';

// se já estiver logado, redireciona
if (isLoggedIn()) {
    header('Location:  ' . BASEURL . 'index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL?>lib/fontawesome/css/all.css">
        <link rel="stylesheet" href="lib/css/signin.css">
        <link rel="icon" href="<?php echo BASEURL; ?>images/brand/logo_reobote.png">
        <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
        <title>DataWork <?php echo APPVERSION;?> &middot; Login</title>
    </head>
            
    <body class="text-center">

        <form class="form-signin" method="POST" autocomplete="off">
            <img class="mb-4" src="images/brand/logo_reobote.png" alt="" width="90" height="90">

            <h1 class="h3 mb-3 font-weight-normal">Efetuar Login</h1>

            <?php 
                require 'classes/usuarios.class.php';
                require_once "classes/recaptcha.class.php";
                $u = new Usuarios();

                // definir a chave secreta
                $secret = "6LcNeIcqAAAAAN6cGiMfekuCdpSCZvZRjDVIWczq";
                // verificar a chave secreta
                $response = null;
                $reCaptcha = new ReCaptcha($secret);

                if (isset($_POST['g-recaptcha-response'])) {
                    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
                }

                // deu tudo certo?
                if ($response != null && $response->success) {
                    // processar o formulário

                    if (isset($_POST['email']) && !empty($_POST['email'])) {    
                        $email = addslashes($_POST['email']);
                        $password = addslashes($_POST['password']);

                        if ($u->login($email, $password)) {
                            ?>
                            <script type="text/javascript">window.location.href="index.php";</script>
                            <?php 
                                    
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                E-mail e/ou senha incorretos.                  
                            </div>
                            <?php 
                        }   
                    }
                }   
            ?>

            <label for="email" class="sr-only">Endereço de E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Endereço de E-mail" required autofocus autocomplete="username">

            <label for="password" class="sr-only">Senha</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required autocomplete="current-password">

            <div class="g-recaptcha" data-sitekey="6LcNeIcqAAAAAFZ-1qiXSl0Bza4lgNwPNRLQ1hPl"></div>

            <button class="btn btn-lg btn-primary btn-block mt-1" type="submit">Entrar</button>
            <p class="mt-5 mb-3  text-muted"><?php echo APPNAME . " | v" . APPVERSION;?></p>
        </form>
    </body>
</html>






