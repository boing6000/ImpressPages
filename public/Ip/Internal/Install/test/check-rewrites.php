<?php

$config = require_once dirname(dirname(dirname(__DIR__))) . '/config.php';

session_name('impresspages');
session_start();

$_SESSION['rewritesEnabled'] = false;

echo json_encode(array('result' => false));