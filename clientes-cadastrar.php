<?php

use App\Controller\ClienteController;

require './config.php';

$controller = new ClienteController();
$controller->cadastrarAction();