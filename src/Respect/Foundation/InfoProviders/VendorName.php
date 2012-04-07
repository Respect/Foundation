<?php

namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class VendorName extends AbstractProvider
{
	public function providerFolderStructure()
	{
		$libraryFolder = new LibraryFolder($this->projectFolder);
		foreach (new DirectoryIterator((string) $libraryFolder) as $vendor)
			if (!$vendor->isDot() && $vendor->isDir())
				return $vendor->getFileName();
	}
}