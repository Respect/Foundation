<?php

namespace Respect\Foundation\InfoProviders;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PackageContributors extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);

		if (!isset($ini['package']['contributors']))
			return;

		implode(', ', $ini['package']['contributors']);
	}

	public function providerGitBlame()
    {
        return $this->gitBlame();
    }
}