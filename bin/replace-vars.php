<?php

chdir(__DIR__);
date_default_timezone_set('UTC');


fwrite(STDOUT, 'Replacing file variables.' . PHP_EOL . PHP_EOL);

$data   = array();
$keys   = array(
    array(
        'key' => '{{Project Name}}',
        'ask' => 'Type the name of the project'
    ),
    array(
        'key' => '{{Project Version}}',
        'ask' => 'Type the version of the project',
        'default' => '0.1.0'
    ),
    array(
        'key' => '{{Project Description}}',
        'ask' => 'Type a description for the project'
    ),
    array(
        'key' => '{{Project Summary}}',
        'ask' => 'Type a summary for the project',
        'default' => function () use (&$data) {
            if (isset($data['{{Project Description}}'])) {
                return $data['{{Project Description}}'];
            }
        },
    ),
    array(
        'key' => '{{Project Homepage}}',
        'ask' => 'Type the project\'s homepage URL'
    ),
    array(
        'key' => '{{Project Path}}',
        'ask' => 'Type the path of the project. Considering library/{{Project Path}}'
    ),
    array(
        'key' => '{{Project Namespace}}',
        'ask' => 'Type the project namespace',
        'default' => function () use (&$data) {
            if (isset($data['{{Project Path}}'])) {
                return strtr($data['{{Project Path}}'], '/', '\\');
            }
        },
    ),
    array(
        'key' => '{{Project Repo}}',
        'ask' => 'Type the project repository URL'
    ),
    array(
        'key' => '{{Lead Developer Name}}',
        'ask' => 'Type your name'
    ),
    array(
        'key' => '{{Lead Developer Email}}',
        'ask' => 'Type your email'
    ),
    array(
        'key' => '{{Lead Developer Username}}',
        'ask' => 'Type your username (of the project\'s repository)'
    ),
);

$count = count($keys);
for ($i=0; $i<$count; $i++) {
    $options = $keys[$i];
    
    /** Defaut va.ues **/
    if (!isset($options['default'])) {
        $default = null;
    } elseif (is_callable($options['default'])) {
        $default = call_user_func($options['default']);
    } else {
        $default = $options['default'];
    }

    /* Displays the ask */
    $message = $options['ask'];
    if (null !== $default) {
        $message .= sprintf(' (Optional, default is: "%s" )', $default);
    } else {
        $message .= ' (Required)';
    }
    $message .= PHP_EOL . '> ';
    fwrite(STDOUT, $message);
    
    /* Read the user's input */
    $value = fread(STDIN, 1204);
    $value = trim($value);
    
    /* Checks the user's input */
    if (empty($value) && null === $default) {
        $i--;
        continue;
    }

    $data[$options['key']] = $value ?: $default;
}
echo PHP_EOL;

$files = array(
    'composer.json',
    'LICENCE',
    'package.xml',
    'README.md'
);
foreach ($files as $file) {
    $filename = '../' . $file;
    if (!file_exists($filename)) {
        fwrite(STDERR, $file . ' does not exists' . PHP_EOL);
        continue;
    }
    $content    = file_get_contents($filename);
    $search     = array_keys($data);
    $replace    = array_values($data);
    
    if ('composer.json' == $file) {
        $replace = array_map(
            function ($string) {
                $string = json_encode($string);
                $string = substr($string, 1, -1);
                $string = str_replace('\/', '/', $string);
                return $string;
            }, 
            $replace
        );
    }
    $content = str_replace($search, $replace, $content);
    file_put_contents($filename, $content, LOCK_EX);
}
echo PHP_EOL;