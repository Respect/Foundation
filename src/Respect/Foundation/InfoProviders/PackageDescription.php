<?php

namespace Respect\Foundation\InfoProviders;

class PackageDescription extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return $ini['package']['desc'];
	}

	public function providerOneLineSummary()
	{
		return (string) new OneLineSummary($this->projectFolder);
	}
}