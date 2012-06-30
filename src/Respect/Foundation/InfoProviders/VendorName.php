<?php

namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class VendorName extends AbstractProvider
{
    public function providerFolderStructure()
    {
        if (file_exists($libraryFolder = new LibraryFolder($this->projectFolder)))
            foreach (new DirectoryIterator($libraryFolder) as $vendor)
                    if (!$vendor->isDot() && $vendor->isDir())
                            return $vendor->getFileName();
    }
}