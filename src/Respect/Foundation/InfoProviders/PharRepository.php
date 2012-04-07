<?php

namespace Respect\Foundation\InfoProviders;

class PharRepository extends AbstractProvider
{
	public function providerGitHubDefault()
	{
		$projectRepository = new ProjectRepository($this->projectFolder);

		if (false === stripos($projectRepository, 'git@github.com:'))
			return '';

		$repoParts = explode(':', $projectRepository);
		$pathParts = explode('/', $repoParts[1]);
		return "{$repoParts[0]}:{$pathParts[0]}/phar";
	}
}