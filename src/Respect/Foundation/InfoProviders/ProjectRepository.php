<?php

namespace Respect\Foundation\InfoProviders;

class ProjectRepository extends AbstractProvider
{
	public function providerGitConfig()
	{
		$gitConfig = parse_ini_file($this->projectFolder.'/.git/config', true);
		$repo = $gitConfig['remote origin']['url'];
		return $repo;
	}
}