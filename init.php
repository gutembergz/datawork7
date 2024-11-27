<?php

// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOSTB', 'sh-pro40.hostgator.com.br'); // para uso sem porta
define('DB_HOST', 'sh-pro40.hostgator.com.br');
define('DB_USER', 'pote7495_datawork_add1');
define('DB_PASS', 'iLEz2uYHKPk7Ghc');
define('DB_NAME', 'pote7495_datawork');
define('DB_PORT', '3306');

// constantes de nome e versão do aplicativo
define('APPNAME', '&copy; DataWork 2011-2021');
define('APPVERSION', '0.346');
define('APPDATE', '25/03/2021');
define('APPCLIENTE', 'EDKE Marketing Digital');

// constantes dos caminhos de templates de header e footer
define('HEADER_TEMPLATE', __DIR__ . '/include/header.php');
define('FOOTER_TEMPLATE', __DIR__ . '/include/footer.php');

// constantes de configurações do PHPMailer
define('MAILER_HOST', 'smtp.kinghost.net');
define('MAILER_USERNAME', 'editorial@portaldenegocios.com');
define('MAILER_PASSWORD', 'EbgeEbge12');
define('MAILER_FROMMAIL', 'editorial@portaldenegocios.com');
define('MAILER_FROMNAME', 'Portal de Negócios');

// caminho absoluto para a pasta do sistema
if (!defined('ABSPATH') )
	define ('ABSPATH', dirname(__FILE__) . '/'); 

// caminho no server para o sistema
if (!defined('BASEURL') )
	define ('BASEURL', '/datawork/portaldenegocios/manager/'); 
  
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  
// inclui o arquivo de funções
require_once 'functions.php';
require_once 'config.php';