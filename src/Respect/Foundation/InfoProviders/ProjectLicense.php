<?php
namespace Respect\Foundation\InfoProviders;

class ProjectLicense extends AbstractProvider
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return;

        $ini = parse_ini_file($iniPath, true);
        return $ini['package']['license'];
    }

    public function providerPackageXml()
    {
        $xmlPath = realpath($this->projectFolder.'/package.xml');

        if (!file_exists($xmlPath))
            return;

        $xml = simplexml_load_file($xmlPath);
        return (string) $xml->license;
    }

    public function providerDefaultValue() {
        $licenseIdx = "\n";
        // this is a long shot, works for now but will need refinement
        if (file_exists($license = $this->projectFolder.'/LICENSE')) {
            //get first line of license file
            $firstline = preg_replace(array("/\n.*/", "/The /i"), '', file_get_contents($license));
            //find first license first line at http://www.spdx.org/licenses/ and grab first licenseId
            $licenseIdx =  trim(preg_replace("/[\s\S]*{$firstline}[\s\S]*spdx:licenseId\"\>(.*)\<[\s\S]*$/iU" , '$1',
                file_get_contents('http://www.spdx.org/licenses/')));
        }
        if (false === strpos($licenseIdx, "\n"))
            return $licenseIdx;
        return 'BSD-4-Clause';
    }
}
