<?php

namespace Respect\Foundation\InfoProviders;

class ProjectName extends AbstractProvider
{
	public function providerFolderStructure()
	{
		return new VendorName($this->projectFolder) . '/' . new PackageName($this->projectFolder);
	}
}