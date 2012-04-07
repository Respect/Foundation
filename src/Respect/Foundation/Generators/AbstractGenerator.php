<?php

namespace Respect\Foundation\Generators;

abstract class AbstractGenerator
{
	public $projectFolder;

	public function __construct($projectFolder)
	{
		$this->projectFolder = $projectFolder;
	}
}