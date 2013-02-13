<?php
namespace Respect\Foundation\InfoProviders;

class DocumentationFolder extends AbstractFolderFinder
{
    public $searchFolders = array('doc', 'docu', 'documents', 'Documentation', 'docs');

    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return array_search('doc', $ini['roles']);
    }
}
