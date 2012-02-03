<?php

/* Common */
require 'common-inc.php';

$version_type     = isset($argv[1]) ? "{$argv[1]}_version" : "patch_version";
$stability        = isset($argv[2]) ? $argv[2] : null;
$package_xml_file = '../package.xml';

if (!file_exists($package_xml_file)) {
    writeln_error('"package.xml" does not exists');
    exit(1);
}

$package_data               = simplexml_load_file($package_xml_file);
$dir_name                   = (string) $package_data->contents->dir['name'];
$target                     = realpath("../$dir_name");
$base_install_dir           = (string) $package_data->contents->dir['baseinstalldir'];
unset($package_data->contents->dir);
$main_dir                   = $package_data->contents->addChild('dir');
$main_dir['name']           = $dir_name;
$main_dir['baseinstalldir'] = $base_install_dir;

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($target), RecursiveIteratorIterator::LEAVES_ONLY) as $php_file) {
    if (!$php_file->isFile())
        continue;
    $file                   = $main_dir->addChild('file');
    $file['role']           = 'php';
    $file['baseinstalldir'] = $base_install_dir;
    $file['install-as']     = str_replace($target, '', $php_file);
    $file['name']           = $dir_name . $file['install-as'];
}

$package_data->date = date('Y-m-d');
$package_data->time = date('H:i:s');
$changelog          = $package_data->changelog->addChild('release');
$current_version    = (string) $package_data->version->release;
$package_version    = increase_version($current_version, $version_type);
$stability          = $stability ? : $package_data->stability->release;

$changelog->version->api
        = (string) $changelog->version->release
        = (string) $package_data->version->api
        = (string) $package_data->version->release
        = (string) $package_version;
$changelog->stability->api
        = (string) $changelog->stability->release
        = (string) $package_data->stability->api
        = (string) $package_data->stability->release
        = (string) $stability;
$changelog->license = $package_data->license;
$changelog->license['uri'] = $package_data->license['uri'];

$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($package_data->asXML());
$dom->save($package_xml_file);

writeln(array(
    sprintf(
        'Updated version "%s" to "%s" in the "package.xml" file.', 
        $current_version, 
        $package_version
    ),
    $argv[0] . ': done!'
));