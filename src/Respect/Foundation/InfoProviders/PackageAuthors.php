<?php

namespace Respect\Foundation\InfoProviders;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PackageAuthors extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);

		if (!isset($ini['package']['authors']))
			return;

		if (isset($ini['package']['author']))
			array_unshift($ini['package']['authors'], $ini['package']['author']);

		return implode(', ', $ini['package']['authors']);
	}
}