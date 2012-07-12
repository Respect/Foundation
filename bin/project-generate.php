#!/usr/bin/php
<?php

error_reporting(0);

if (!function_exists('debug')) {
    function debug($message) {
        global $argv;
        static $debug;

        if (end($argv) == 'debug') {
            $debug = true;
            array_pop($argv);
            error_reporting(-1);
        }

        if ($debug) {
            echo $message, PHP_EOL;
        }
    }
}

debug('Generate start with args: '. implode(',', $argv));

date_default_timezone_set('UTC');

chdir('.');

set_include_path(realpath(__DIR__.'/../src') . PATH_SEPARATOR . get_include_path());

/**
 * Autoloader that implements the PSR-0 spec for interoperability between
 * PHP software.
 */
spl_autoload_register(
    function($className) {
        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $file = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';

        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            if (file_exists($path = $path . DIRECTORY_SEPARATOR . $file))
                return require $path;
        }
    }
);

$pi = new Respect\Foundation\ProjectInfo(getcwd());
$command = $argv[1];
debug("generate $command");
$generator = $pi->generate($command);
debug("done gen");
foreach (array_slice($argv, 2) as $method) {
debug("calling method $method");
    $generator->$method();
debug("done method $method");
}
debug("Result:");
echo $generator;

