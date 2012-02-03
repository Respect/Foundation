<?php

/* Common */
require __DIR__ . '/common-inc.php';

$package_xml_file = '../package.xml';

if (!file_exists($package_xml_file)) {
    writeln_error('"package.xml" does not exists');
    exit(1);
}

$package_data = simplexml_load_file($package_xml_file);
$project_name = preg_replace('/[\/\\:.]/', '', $package_data->name);
$phar_name = "{$project_name}.phar";

$phar = new Phar("../{$phar_name}", 0, $phar_name);

foreach ($package_data->contents->dir->file as $file) {
    $phar->addFile(realpath("../{$file['name']}"), "{$file['baseinstalldir']}{$file['install-as']}");
}

$phar->addFromString("autoload.php", <<<'LOADER'
<?php
    set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());
    spl_autoload_register(function($className)
    {
        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $fileName = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';

        if (stream_resolve_include_path($fileName))
            require $fileName;
    });

LOADER
);

$phar->setStub("<?php Phar::mapPhar('$phar_name'); include 'phar://$phar_name/autoload.php'; __HALT_COMPILER();");

writeln(array(
    sprintf(
        'Phar file "%s" created with success.', 
        $phar_name
    ),
    $argv[0] . ': done!'
));