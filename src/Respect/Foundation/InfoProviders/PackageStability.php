<?php

namespace Respect\Foundation\InfoProviders;

class PackageStability extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return $ini['package']['stability'];
	}

	public function providerDefault()
	{
		return 'alpha';
	}
}