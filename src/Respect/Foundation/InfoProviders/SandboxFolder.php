<?php
namespace Respect\Foundation\InfoProviders;

class SandboxFolder extends AbstractFolderFinder
{
    public $searchFolders = array('scratch', 'scratchpad', 'sandbox', 'tmp');

    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return array_search('tmp', $ini['roles']);
    }
}

