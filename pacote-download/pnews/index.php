<?php
session_start();
ob_start();

require './vendor/autoload.php';

$url = new Core\ConfigController;
$url->loadPage();
