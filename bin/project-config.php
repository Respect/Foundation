<?php

error_reporting(0);

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

$pi = new Respect\Foundation\ProjectInfo('.');
$command = str_replace('-', ' ', $argv[1]);
$command = ucwords($command);
$command = ucfirst($command);
$command = str_replace(' ', '', $command);
echo (string) $pi->{$command};