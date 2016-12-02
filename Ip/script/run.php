<?php

if ((PHP_MAJOR_VERSION < 5) || (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION < 5)) {
    echo 'Your PHP version is: '.PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.'. To run ImpressPages you need PHP >= 5.5';
    exit;
}

require_once dirname(__DIR__) . '/Application.php';

try {
    $application = new \Ip\Application($configFilename);
    $application->init();
    $application->run();
} catch (\Exception $e) {
    if (isset($log)) {
        $log->log('System', 'Exception caught', $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    }
    throw $e;
}

