<?php

if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    fwrite(STDERR, 'This file can not be called directly.' . PHP_EOL);
    exit(1);
}

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
        foreach ($message as $value) {
            writeln($value, $stream);
        }
    } else {
        write($message . PHP_EOL, $stream);
    }
}

/**
 * @param   string $message 
 * @param   int|string[optional] $exit 
 * @return  void
 */
function writeln_error($message, $exit = null)
{
    writeln($message, STDERR);
    if (null !== $exit) {
        exit($exit);
    }
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