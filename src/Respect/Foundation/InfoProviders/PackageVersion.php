<?php

namespace Respect\Foundation\InfoProviders;

class PackageVersion extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return $ini['package']['version'];
	}

	public function providerDefault()
	{
		return '0.1.0';
	}
}