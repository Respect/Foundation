<?php

if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    fwrite(STDERR, 'This file can not be called directly.' . PHP_EOL);
    exit(1);
}

chdir(__DIR__);
date_default_timezone_set('UTC');

/**
 * @param   string $message 
 * @param   resource $stream 
 * @return  void
 */
function write($message, $stream = STDOUT)
{
    fwrite($stream, $message);
}

/**
 * @param   string|array[optional] $message 
 * @param   resource $stream 
 * @return  void
 */
function writeln($message = '', $stream = STDOUT)
{
    if (is_array($message)) {
        foreach ($message as $key => $value) {
            if (is_string($key)) {
                $value = vsprintf($key, (array) $value);
            }
            writeln($value, $stream);
        }
    } else {
        write($message . PHP_EOL, $stream);
    }
}

/**
 * @param   string $message
 * @return  void
 */
function writeln_error($message)
{
    writeln($message, STDERR);
}

/**
 * @param   string $question 
 * @param   bool[optional] $trim 
 * @return  string
 */
function ask($question, $trim = true)
{
    writeln($question);
    write('> ');
    $reply = fread(STDIN, 8192);
    if (true === $trim) {
        $reply = trim($reply);
    }
    return $reply;
}

/**
 * @param   string $version 
 * @param   string $type 
 * @return  string
 */
function increase_version($version, $type = 'patch')
{
    $pieces = explode('.', $version);
    $pieces = array_map('intval', $pieces);
    $pieces = array_pad($pieces, 3, 0);

    list($major_version, $minor_version, $patch_version) = $pieces;

    if (isset($$type)) {
        $$type++;
    } else {
        $patch_version++;
    }
    switch ($type) {
        case 'major_version':
            $minor_version = 0;
        case 'minor_version':
            $patch_version = 0;
    }
    return "{$major_version}.{$minor_version}.{$patch_version}";
}

/**
 * @author  umbrae@gmail.com
 * @link    http://www.php.net/manual/en/function.json-encode.php#80339
 * @param   mixed $data
 * @return  string
 */
function json_encode_formatted($data)
{
    if (defined('JSON_PRETTY_PRINT')) {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    $json       = json_encode($data);
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

