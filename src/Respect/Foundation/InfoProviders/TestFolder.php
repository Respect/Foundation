<?php
namespace Respect\Foundation\InfoProviders;

class TestFolder extends AbstractFolderFinder
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return array_search('test', $ini['roles']);
    }
    public $searchFolders = array('test', 'tests');
}
