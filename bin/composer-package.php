<?php

chdir(__DIR__);
date_default_timezone_set('UTC');

/**
 * @author  umbrae@gmail.com
 * @link    http://www.php.net/manual/en/function.json-encode.php#80339
 * @param   string $json
 * @return  string
 */
function json_format($json)
{
    $tab        = '    ';
    $formated   = '';
    $level      = 0;
    $in_string  = false;
    $length     = strlen($json);

    for ($c = 0; $c < $length; $c++) {
        $char = $json[$c];
        switch ($char) {
            case '{':
            case '[':
                if (!$in_string) {
                    $formated .= $char . "\n" . str_repeat($tab, $level + 1);
                    $level++;
                } else {
                    $formated .= $char;
                }
                break;
            case '}':
            case ']':
                if (!$in_string) {
                    $level--;
                    $formated .= "\n" . str_repeat($tab, $level) . $char;
                } else {
                    $formated .= $char;
                }
                break;
            case ',':
                if (!$in_string) {
                    $formated .= ",\n" . str_repeat($tab, $level);
                } else {
                    $formated .= $char;
                }
                break;
            case ':':
                if (!$in_string) {
                    $formated .= ": ";
                } else {
                    $formated .= $char;
                }
                break;
            case '"':
                if ($c > 0 && $json[$c - 1] != '\\') {
                    $in_string = !$in_string;
                }
            default:
                $formated .= $char;
                break;
        }
    }

    return $formated;
}

$version_type   = isset($argv[1]) ? "{$argv[1]}_version" : "patch_version";
$filename       = '../composer.json';

if (!file_exists($filename)) {
    fwrite(STDERR, "The file \"composer.json\" does not exists" . PHP_EOL);
    exit(1);
}

$parsed_json    = json_decode(file_get_contents($filename), true);

if (!isset($parsed_json['version'])) {
    fwrite(STDERR, "There is no defined version in the \"composer.json\" file" . PHP_EOL);
    exit(2);
}

$matches    = array();
$pattern    = '^(v)?([0-9]+\.[0-9]+(\.[0-9]+)?)(.+)?$';
if (!preg_match("/{$pattern}/", $parsed_json['version'], $matches)) {
    fwrite(
        STDERR,
        "\"{$parsed_json['version']}\" has not a valid \"Respect\Foundation\" version format." . PHP_EOL .
        "Versions must match with \"{$pattern}\"." . PHP_EOL
    );
    exit(3);
}

$version_pieces = explode('.', $matches[2]);
$version_pieces = array_pad($version_pieces, 3, 0);
list($major_version, $minor_version, $patch_version) = $version_pieces;

if (isset($$version_type)) {
    $$version_type++;
} else {
    $patch_version++;
}
switch ($version_type) {
    case 'major_version':
        $minor_version = 0;
    case 'minor_version':
        $patch_version = 0;
}

if (array_key_exists(2, $argv)) {
    $stability = $argv[2];
} elseif (isset($matches[4])) {
    $stability = $matches[4];
} else {
    $stability = '';
}

$new_version = "{$matches[1]}{$major_version}.{$minor_version}.{$patch_version}{$stability}";

$parsed_json['version'] = $new_version;

$json = json_encode($parsed_json);
$formated_json = json_format($json);

file_put_contents($filename, $formated_json, LOCK_EX);

