<?php
namespace Respect\Foundation\InfoProviders;

class OneLineSummary extends AbstractProvider
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return $ini['package']['summary'];
    }

    public function providerPackageXml()
    {
        $xmlPath = realpath($this->projectFolder.'/package.xml');

        if (!file_exists($xmlPath))
            return;

        $xml = simplexml_load_file($xmlPath);
        return (string) $xml->summary;
    }

    public function providerReadme()
    {
        $readme      = file_get_contents($this->projectFolder.'/'.new ReadmeFile($this->projectFolder));
        $readmeParts = explode("\n\n", $readme);

        if (isset($readmeParts[1]))
            return $readmeParts[1];

        return '';
    }
}
