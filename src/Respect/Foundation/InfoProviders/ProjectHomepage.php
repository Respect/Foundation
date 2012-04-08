<?php

namespace Respect\Foundation\InfoProviders;

class ProjectHomepage extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return $ini['package']['homepage'];
	}

	public function providerPackageXml()
	{
		$xmlPath = realpath($this->projectFolder.'/package.xml');

		if (!file_exists($xmlPath))
			return;

		$xml = simplexml_load_file($xmlPath);
		return (string) $xml->homepage;
	}
}