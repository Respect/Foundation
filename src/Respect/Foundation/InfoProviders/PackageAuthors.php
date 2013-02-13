<?php
namespace Respect\Foundation\InfoProviders;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PackageAuthors extends PackageContributors
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

<<<<<<< HEAD
	public function providerGitBlame()
    {
        return $this->gitBlame();
    }
}
=======
        return implode(', ', $ini['package']['authors']);
    }
}
>>>>>>> ff38f5a73ca5c2e097f88f1c72e954d7152ef51a
