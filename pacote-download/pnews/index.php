<?php
require './core/Config.php';
require './vendor/autoload.php';

$url = new Core\ConfigController;
$url->loadPage();
