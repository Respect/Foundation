<?php

/* Common */
require __DIR__ . '/common-inc.php';

$version_type   = isset($argv[1]) ? "{$argv[1]}_version" : "patch_version";
$filename       = '../composer.json';

if (!file_exists($filename)) {
    writeln_error('The file "composer.json" does not exists');
    exit(1);
}

$parsed_json    = json_decode(file_get_contents($filename), true);

if (!isset($parsed_json['version'])) {
    writeln_error('There is no defined version in the "composer.json" file');
    exit(2);
}

$matches    = array();
$pattern    = '^([0-9]+\.[0-9]+\.[0-9]+)-?(.+)?$';
if (!preg_match("/{$pattern}/", $parsed_json['version'], $matches)) {
    writeln_error(array(
        sprintf('"%s" has not a valid "Respect\Foundation" version format', $parsed_json['version']),
        sprintf('Versions must match with "%s"', $pattern)
    ));
    exit(3);
}

$version_number = increase_version($matches[1], $version_type);

if (array_key_exists(2, $argv)) {
    $stability = $argv[2];
} elseif (isset($matches[2]) && $version_type == 'patch_version') {
    $stability = $matches[2];
} else {
    $stability = '';
}


$current_version        = $parsed_json['version'];
$parsed_json['version'] = $version_number . ($stability ? '-' . $stability : '');

$json = json_encode_formatted($parsed_json);
file_put_contents($filename, $json, LOCK_EX);

writeln(array(
    sprintf('Updated version "%s" to "%s" in the "composer.json" file.', $current_version, $parsed_json['version']),
    $argv[0] . ': done!'
));