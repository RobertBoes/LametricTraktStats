<?php

require __DIR__ . '/vendor/autoload.php';

$trakt = new \RobertBoes\LaMetricTrakt\Trakt();

try {
    $trakt->parseRequest($_GET);
    echo $trakt->getResult();
}
catch (Exception $e) {
    echo $trakt->error($e->getMessage());
}
