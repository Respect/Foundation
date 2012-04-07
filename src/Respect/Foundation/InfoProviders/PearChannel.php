<?php

namespace Respect\Foundation\InfoProviders;

class PearChannel extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return $ini['package']['channel'];
	}

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