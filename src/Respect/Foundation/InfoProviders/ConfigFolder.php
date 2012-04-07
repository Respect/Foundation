<?php

namespace Respect\Foundation\InfoProviders;

class ConfigFolder extends AbstractFolderFinder
{
	public $searchFolders = array('config', 'conf', 'etc');
}