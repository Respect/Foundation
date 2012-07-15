<?php
namespace Respect\Foundation\InfoProviders;

class ExtensionDependencies extends AbstractProvider
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        $deps = array();

        if (isset($ini['require']))
            foreach ($ini['require'] as $req => $version)
                if (0 === stripos($req, 'extension/'))
                    $deps[] = substr($req, 10) . ' ' .$version;

        return implode(', ', $deps);
    }
}
