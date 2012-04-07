<?php

namespace Respect\Foundation\InfoProviders;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PackageAuthors extends AbstractProvider
{
	public function providerGitBlame()
	{
		$authors = array_filter(explode("\n", shell_exec('git log --format="%aN <%aE>" | sort -u')));
		return implode(', ', $authors);
	}
}