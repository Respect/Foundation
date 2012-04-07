<?php

namespace Respect\Foundation\InfoProviders;

class PearChannel extends AbstractProvider
{
	public function providerGitHubDefault()
	{
		$projectRepository = new ProjectRepository($this->projectFolder);

		if (false === stripos($projectRepository, 'git@github.com:'))
			return '';

		$repoParts = explode(':', $projectRepository);
		$pathParts = explode('/', $repoParts[1]);
		return strtolower($pathParts[0]).".github.com/pear";
	}
}