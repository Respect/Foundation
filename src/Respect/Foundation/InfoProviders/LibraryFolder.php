<?php

namespace Respect\Foundation\InfoProviders;

class LibraryFolder extends AbstractFolderFinder
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);
		return array_search('src', $ini['roles']);
	}

	public $searchFolders = array('src', 'library', 'lib');
}