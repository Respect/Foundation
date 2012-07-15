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

    public function __toString()
    {
        return $this->runProviders(get_class_methods($this));
    }
}
