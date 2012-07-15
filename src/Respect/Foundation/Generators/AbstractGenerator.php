<?php
namespace Respect\Foundation\Generators;

abstract class AbstractGenerator
{
    public $projectFolder;

    public function __construct($projectFolder)
    {
        $this->projectFolder = preg_replace('#'.DIRECTORY_SEPARATOR.'$#', '', $projectFolder);
    }
}
