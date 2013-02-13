<?php /** a Courtesy of Respect/Foundation */

// APC Cache enhanced bootstrap autoloader
if (!extension_loaded('apc') || !function_exists('apc_store'))
    throw new Exception('APC is required for the enhanced bootstrap autoloader.');

define('BOOTSTRAP_APC_PREFIX', 'BOOTSTRAP:');

date_default_timezone_set('UTC');

$paths = apc_fetch(BOOTSTRAP_APC_PREFIX.'__custom_include_path');
if (false === $paths) {
    $cache = array();
    $paths = explode(PATH_SEPARATOR, get_include_path());
    if (file_exists('/usr/lib/php/pear'))
        $paths[] = '/usr/lib/php/pear';

    if (file_exists(dirname(__DIR__).'/vendor/composer')) {
        $classMap = require dirname(__DIR__).'/vendor/composer/autoload_classmap.php';
        foreach ($classMap as $class => $path)
            $cache[BOOTSTRAP_APC_PREFIX.$class] = $path;
        $map = require dirname(__DIR__).'/vendor/composer/autoload_namespaces.php';
        foreach ($map as $path)
            $paths[] = $path;
    }

    natsort($paths);
    array_unshift($paths, dirname(__DIR__) .'/src');
    $paths = implode(PATH_SEPARATOR, array_unique($paths));

    $cache[BOOTSTRAP_APC_PREFIX.'__custom_include_path'] = $paths;
    apc_store($cache);
}
set_include_path($paths);


/** Autoloader that implements the PSR-0 spec for interoperability between PHP software. */
spl_autoload_register(
    function($className) {
        if (false !== $path = apc_fetch(BOOTSTRAP_APC_PREFIX.$className))
            return require $path;

        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $file = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';

        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path)
            if (file_exists($path = $path . DIRECTORY_SEPARATOR . $file)) {
                apc_store(BOOTSTRAP_APC_PREFIX.$className, $path);
                return require $path;
            }
    }
);

