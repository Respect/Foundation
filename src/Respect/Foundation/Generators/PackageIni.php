<?php

namespace Respect\Foundation\Generators;

use Respect\Foundation\InfoProviders as i;

class PackageIni extends AbstractGenerator
{
	public function getIniString(array $contents)
	{
		$ini = '';
		foreach ($contents as $sectionName => $section) {
			$ini .= "[{$sectionName}]".PHP_EOL;	
			foreach ($section as $property => $value) {
				if (!is_array($value))
					$ini.= "{$property} = {$value}".PHP_EOL;
				else
					foreach ($value as $string)
						$ini .= "{$property}[] = {$string}" . PHP_EOL;
			}
			$ini .= PHP_EOL;
		}
		return $ini;
	}

	public function __toString()
	{
		$root = $this->projectFolder;
		return $this->getIniString(array(
			'package' => array(
				'name'      => new i\PackageName($root),
				'summary'   => new i\OneLineSummary($root),
				'desc'      => new i\PackageDescription($root),
				'version'   => new i\PackageVersion($root),
				'stability' => new i\PackageStability($root),
				'channel'   => new i\PearChannel($root),
				'authors'   => explode(', ', new i\PackageAuthors($root))
			),
			'require' => array(
				'php'       => new i\PhpVersion($root)
			),
			'roles' => array(
				(string) new i\LibraryFolder($root)     => 'src',
				(string) new i\TestFolder($root)        => 'test',
				(string) new i\ExecutablesFolder($root) => 'bin',
				(string) new i\PublicFolder($root)      => 'www',
			)
		));
	}
}