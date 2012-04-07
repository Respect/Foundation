<?php

namespace Respect\Foundation\InfoProviders;

class ProjectRepository extends AbstractProvider
{
	public function __toString()
	{
		$gitConfig = parse_ini_file($this->projectFolder.'/.git/config', true);
		$repo = $gitConfig['remote origin']['url'];
		$repo = str_replace('git@github.com:', '', $repo);
		return $repo;
	}
}