<?php
namespace Respect\Foundation\InfoProviders;

class PearChannel extends AbstractProvider
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return $ini['package']['channel'];
    }
    public function providerPackageXml()
    {
        $xmlPath = realpath($this->projectFolder.'/package.xml');

        if (!file_exists($xmlPath))
            return;

        $xml = simplexml_load_file($xmlPath);
        return (string) $xml->channel;
    }

    public function providerGitHubDefault()
    {
        $projectRepository = new ProjectRepository($this->projectFolder);

        if (false === stripos($projectRepository, 'git@github.com:'))
            return '';

        $repoParts = explode(':', $projectRepository);
        $pathParts = explode('/', $repoParts[1]);
        return strtolower($pathParts[0]).".github.com/pear";
    }
    public function providerDefault()
    {
        return "pear.php.net";
    }
}
