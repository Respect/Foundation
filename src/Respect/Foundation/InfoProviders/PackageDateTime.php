<?php

namespace Respect\Foundation\InfoProviders;


class PackageDateTime extends AbstractProvider
{
	public function providerPackageXml()
	{
		$xmlPath = realpath($this->projectFolder.'/package.xml');

		if (!file_exists($xmlPath))
			return;

		$xml = simplexml_load_file($xmlPath);
		return $xml->date . ' ' . $xml->time;
	}
}