<?php

require_once 'init.php';

$urlSite = BASEURL;
 
if (!isLoggedIn()) {
    header('Location:  ' . BASEURL . 'form-login.php');
}