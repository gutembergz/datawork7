<?php
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/emailsTemplates.class.php';
$et = new EmailsTemplates();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$et->excluirTemplateEmail($_GET['id']);
}

header("Location: index.php");
