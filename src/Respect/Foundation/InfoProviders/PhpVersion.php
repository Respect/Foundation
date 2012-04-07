<?php

namespace Respect\Foundation\InfoProviders;

class PhpVersion extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return $ini['require']['php'];
	}

	public function providerPhpFunction()
	{
		return implode('.', array_slice(explode('.', phpversion()), 0, 2));
	}
}