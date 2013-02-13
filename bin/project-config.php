#!/usr/bin/env php
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

debug('Config start with args: '. implode(', ', $argv));

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
debug("config for {$argv[1]} with project folder :". getcwd());
echo (string) $pi->{$argv[1]};
