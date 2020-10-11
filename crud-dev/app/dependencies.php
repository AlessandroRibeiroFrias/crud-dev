<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\PDO\Database;


return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
    ]);
    $container['pdo'] = function ($c) {
        $pdo = $c->get('settings')['pdo'];
        $dsn = "{$pdo['engine']}:host={$pdo['host']};dbname={$pdo['database']}";
        $slimPdo = new \Slim\PDO\Database($dsn, $pdo['username'], $pdo['password'], $pdo['options']);
        return $slimPdo;
    };
};
