<?php

// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOSTB', ''); // para uso sem porta
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');
define('DB_PORT', '3306');

// constantes de nome e versão do aplicativo
define('APPNAME', '&copy; DataWork 2011-2024');
define('APPVERSION', '0.348');
define('APPDATE', '27/11/2024');
define('APPCLIENTE', 'Reobote Filmes');

// constantes dos caminhos de templates de header e footer
define('HEADER_TEMPLATE', __DIR__ . '/include/header.php');
define('FOOTER_TEMPLATE', __DIR__ . '/include/footer.php');

// constantes de configurações do PHPMailer
define('MAILER_HOST', '');
define('MAILER_USERNAME', '');
define('MAILER_PASSWORD', '');
define('MAILER_FROMMAIL', '');
define('MAILER_FROMNAME', '');

// caminho absoluto para a pasta do sistema
if (!defined('ABSPATH') )
	define ('ABSPATH', dirname(__FILE__) . '/'); 

// caminho no server para o sistema
if (!defined('BASEURL') )
	define ('BASEURL', '/datawork7/'); 
  
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  
// inclui o arquivo de funções
require_once 'functions.php';
require_once 'config.php';
