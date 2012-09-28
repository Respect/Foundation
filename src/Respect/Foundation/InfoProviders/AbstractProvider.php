<?php

namespace Respect\Foundation\InfoProviders;

abstract class AbstractProvider
{
    public $projectFolder = null;

    public function __construct($projectFolder = null)
    {
        $this->projectFolder = $projectFolder ?: realpath('.');
    }

    protected function runProviders($providers)
    {
        $providers = array_filter($providers, function($methodName) {
            return 0 === stripos($methodName, 'provider');
        });

        foreach ($providers as $methodName)
            if ($data = $this->{$methodName}())
                return $data;

        return '';
    }

    protected function gitBlame()
    {
        $authors = array_filter(explode("\n", shell_exec('git log --format="%aN <%aE>" | sort -u')));
        $contributors = array();
        array_walk(array_reverse($authors, true), function($author) use (&$contributors) {
            $email = preg_replace('/^.+[^<]<([^>]+)>$/', '$1', $author);
            $contributors[$email] = $author;
        });
        return implode(', ', $contributors);
    }

    public function __toString()
    {
        return $this->runProviders(get_class_methods($this));
    }
}