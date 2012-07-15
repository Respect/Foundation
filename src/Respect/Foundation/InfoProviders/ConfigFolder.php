<?php
namespace Respect\Foundation\InfoProviders;

class ConfigFolder extends AbstractFolderFinder
{
    public $searchFolders = array('config', 'conf', 'etc');

    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return array_search('cfg', $ini['roles']);
    }
}
