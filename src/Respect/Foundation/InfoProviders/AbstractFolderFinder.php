<?php

namespace Respect\Foundation\InfoProviders;

abstract class AbstractFolderFinder extends AbstractProvider
{
	public $searchFolders = array();

	public function providerFoundFolder()
	{
		foreach ($this->searchFolders as $folder) 
			if (is_dir($this->projectFolder."/".$folder))
				return $folder;

		return reset($this->searchFolders) ?: '';
	}
}