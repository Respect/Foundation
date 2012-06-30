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
        $providerName = 'Respect\\Foundation\\InfoProviders\\'.preg_replace('/(?:^|-|_| )(.?)/e', "strtoupper('$1')", $infoName);
        return new $providerName($this->projectFolder);
    }
    public function generate($generatorName)
    {
        $generatorClass = 'Respect\\Foundation\\Generators\\'.preg_replace('/(?:^|-|_| )(.?)/e', "strtoupper('$1')", $generatorName);
        return new $generatorClass($this->projectFolder);
    }
}