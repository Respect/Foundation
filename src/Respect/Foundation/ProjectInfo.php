<?php

namespace Respect\Foundation;

class ProjectInfo
{
    public $projectFolder = null;

    public function __construct($projectFolder = null)
    {
        $this->projectFolder = $projectFolder ?: realpath('.');
    }
    public function __get($infoName)
    {
        $providerName = 'Respect\\Foundation\\InfoProviders\\'.ucfirst($infoName);
        return new $providerName($this->projectFolder);
    }
}