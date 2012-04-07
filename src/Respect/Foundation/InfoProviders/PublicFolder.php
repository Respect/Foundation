<?php

namespace Respect\Foundation\InfoProviders;

class PublicFolder extends AbstractFolderFinder
{
	public $searchFolders = array('public', 'www', 'htdocs');
}