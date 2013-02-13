<?php
namespace Respect\Foundation\InfoProviders;

class ExecutablesFolder extends AbstractFolderFinder
{
    public $searchFolders = array('bin', 'scripts', 'script');

    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return array_search('bin', $ini['roles']);
    }
}
