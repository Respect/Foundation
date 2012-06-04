<?php

namespace Respect\Foundation\InfoProviders;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PackageContributors extends AbstractProvider
{
	public function providerPackageIni()
	{
		$iniPath = realpath($this->projectFolder.'/package.ini');

		if (!file_exists($iniPath))
			return;

		$ini = parse_ini_file($iniPath, true);

		if (!isset($ini['package']['contributors']))
			return;

		implode(', ', $ini['package']['contributors']);
	}

	public function providerGitBlame()
	{
		$authors = array_filter(explode("\n", shell_exec('git log --format="%aN <%aE>" | sort -u')));
		$emails	 = array();
		foreach (array_reverse($authors, true) as $key => $author) {
			$email = preg_replace('/^.+[^<]<([^>]+)>$/', '$1', $author);
			if (!in_array($email, $emails)) {
				$emails[] = $email;
				continue;
			}
			unset($authors[$key]);
		}
		return implode(', ', $authors);
	}
}