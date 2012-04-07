<?php

namespace Respect\Foundation\InfoProviders;

class PublicFolder extends AbstractFolderFinder
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return array_search('www', $ini['roles']);
	}
	public $searchFolders = array('public', 'www', 'htdocs');
}