<?php

namespace Respect\Foundation\InfoProviders;

abstract class AbstractProvider
{
    public $projectFolder = null;

    public function __construct($projectFolder = null)
    {
        $this->projectFolder = $projectFolder ?: realpath('.');
    }

    public function __toString()
    {
    	$providers = array_filter(get_class_methods($this), function($methodName) {
    		return 0 === stripos($methodName, 'provider');
    	});

    	foreach ($providers as $methodName)
    		if ($data = $this->{$methodName}())
    			return $data;

        return '';
    }
}