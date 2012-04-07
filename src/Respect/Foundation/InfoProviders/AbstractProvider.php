<?php

namespace Respect\Foundation\InfoProviders;

abstract class AbstractProvider
{
    public $projectFolder = null;

    public function __construct($projectFolder = null)
    {
        $this->projectFolder = $projectFolder ?: realpath('.');
    }
}