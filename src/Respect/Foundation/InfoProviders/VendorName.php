<?php

namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class VendorName extends AbstractProvider
{
    public function providerFolderStructure()
    {
        if (file_exists($libraryFolder = new LibraryFolder($this->projectFolder)))
            foreach (new DirectoryIterator($libraryFolder) as $vendor)
                    if (!$vendor->isDot() && $vendor->isDir()
                            && preg_match('/[A-Z].*/', $vendor->getFileName()))
                            return $vendor->getFileName();
    }

    public function providerDefault()
    {
        return ucfirst(preg_replace('/\W+/', '', new UserName($this->projectFolder)));
    }
}