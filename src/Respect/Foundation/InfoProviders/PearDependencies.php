<?php
namespace Respect\Foundation\InfoProviders;

class PearDependencies extends AbstractProvider
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        $deps = array();

        foreach ($ini['require'] as $dep => $version)
            if ($dep != 'php' && 0 !== stripos($dep, 'extension/') && $dep != 'pearinstaller')
                $deps[] = trim("$dep $version");

        return implode(', ', $deps);
    }
}
