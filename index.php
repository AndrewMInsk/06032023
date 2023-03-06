<?php

    require_once __DIR__ . '/vendor/autoload.php';
    $controller = new \src\Controller();
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $controller->{$_GET['action']}();
    }