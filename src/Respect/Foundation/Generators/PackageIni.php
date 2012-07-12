<?php

namespace Respect\Foundation\Generators;

use Respect\Foundation\InfoProviders as i;

class PackageIni extends AbstractGenerator
{
	public $packageVersion;
	public $packageStability;

	public static function getIniString(array $contents)
	{
		$ini = '';
		foreach ($contents as $sectionName => $section) {
			$ini .= "[{$sectionName}]".PHP_EOL;	
			foreach ($section as $property => $value) {
				if (!is_array($value))
					$ini.= "{$property} = \"{$value}\"".PHP_EOL;
				else
					foreach ($value as $string)
						$ini .= "{$property}[] = \"{$string}\"" . PHP_EOL;
			}
			$ini .= PHP_EOL;
		}
		return $ini;
	}

	public function patch()
	{
		$currentVersion = explode('.', new i\PackageVersion($this->projectFolder));
		$currentVersion[2]++;
		$newVersion = implode('.', $currentVersion);
		$this->packageVersion = $newVersion;
	}

	public function minor()
	{
		$currentVersion = explode('.', new i\PackageVersion($this->projectFolder));
		$currentVersion[1]++;
		$currentVersion[2] = 0;
		$newVersion = implode('.', $currentVersion);
		$this->packageVersion = $newVersion;
	}

	public function major()
	{
		$currentVersion = explode('.', new i\PackageVersion($this->projectFolder));
		$currentVersion[0]++;
		$currentVersion[2] = 0;
		$currentVersion[1] = 0;
		$newVersion = implode('.', $currentVersion);
		$this->packageVersion = $newVersion;
	}

	public function alpha()
	{
		$this->packageStability = 'alpha';
	}

	public function beta()
	{
		$this->packageStability = 'beta';
	}

	public function stable()
	{
		$this->packageStability = 'stable';
	}

	protected function parseDependencies($pear, $extension)
	{
		$deps = explode(', ', trim($pear, ', '));
		$require = array();

		foreach ($deps as $dep) {
			if (empty($dep))
				continue;
			
			$parts = explode(' ', $dep);
			if (count($parts) > 1)
				$require[$parts[0]] = $parts[1];
			else
				$require[$parts[0]] = "";
		}

		foreach(explode(', ', $extension) as $ext) {
			if (empty($ext))
				continue;

			$parts = explode(' ', $ext);
			if (count($parts) > 1)
				$require["extension/".$parts[0]] = $parts[1];
			else
				$require["extension/".$parts[0]] = "";

		}		

		return $require;
	}

	protected function getInfo()
	{
		$root         = $this->projectFolder;
		$authors      = explode(', ', new i\PackageAuthors($root));
		$contributors = explode(', ', new i\PackageContributors($root));

		$contents = array(
			'package' => array(
				'name'          => new i\PackageName($root),
				'summary'       => new i\OneLineSummary($root),
				'desc'          => new i\PackageDescription($root),
				'version'       => $this->packageVersion ?: new i\PackageVersion($root),
				'stability'     => $this->packageStability ?: new i\PackageStability($root),
				'channel'       => new i\PearChannel($root),
				'homepage'      => new i\ProjectHomepage($root),
				'license'       => new i\ProjectLicense($root),
				'author'        => array_shift($authors), //Onion Bug
				'authors'       => $authors,
				'contributors'  => $contributors
			),
			'require' => array(
				'php'           => new i\PhpVersion($root),
				'pearinstaller' => '1.4.1'
			) + $this->parseDependencies(
				(string) new i\PearDependencies($root), (string) new i\ExtensionDependencies($root)
			),
			'roles' => array(
				(string) new i\LibraryFolder($root)     => 'php',
				(string) new i\TestFolder($root)        => 'test',
				(string) new i\ConfigFolder($root)      => 'cfg',
				(string) new i\ExecutablesFolder($root) => 'script',
				(string) new i\PublicFolder($root)      => 'www',
			)
		);

		if (isset($contents['roles']['src'])) //Onion Bug
			unset($contents['roles']['src']);

		if (isset($contents['roles']['tests'])) //Onion Bug
			unset($contents['roles']['tests']);

		if (isset($contents['roles']['docs'])) //Onion Bug
			unset($contents['roles']['docs']);

		return $contents;
	}

	public function __toString()
	{
		return static::getIniString($this->getInfo());
	}
}