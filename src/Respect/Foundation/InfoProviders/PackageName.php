<?php
namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class PackageName extends AbstractProvider
{
    public function providerPackageIni()
    {
        $iniPath = realpath($this->projectFolder.'/package.ini');

        if (!file_exists($iniPath))
            return '';

        $ini = parse_ini_file($iniPath, true);
        return $ini['package']['name'];
    }

    public function providerFolderStructure()
    {
        $vendorFolder  = new LibraryFolder($this->projectFolder);
        if (file_exists($vendorFolder .= DIRECTORY_SEPARATOR . new VendorName($this->projectFolder)))
            foreach (new DirectoryIterator((string) $vendorFolder) as $vendor)
                if (!$vendor->isDot() && $vendor->isDir())
                    return $vendor->getFileName();
    }

    public function providerDefault()
    {
        $s = DIRECTORY_SEPARATOR;
        return ucfirst(preg_replace("#^.*$s(?=\w+$s?$)#U", '', $this->projectFolder));
    }
}
