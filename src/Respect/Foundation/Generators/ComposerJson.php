<?php

namespace Respect\Foundation\Generators;

use Respect\Foundation\InfoProviders as i;

class ComposerJson extends AbstractGenerator
{

	protected function parseDependencies($pear)
	{
		$deps = explode(', ', $pear);
		$require = array();

		foreach ($deps as $dep) {
			if (empty($dep))
				continue;

			$parts = explode(' ', $dep);
			list($channel, $package) = explode('/', $parts[0], 2);
			$parts[0] = shell_exec("pear channel-info {$channel} | grep Alias");
			$parts[0] = explode(' ', $parts[0]);
			$parts[0] = trim(end($parts[0])).'/'.$package;
			if (count($parts) > 1)
				$require["pear-".$parts[0]] = $parts[1];
			else
				$require["pear-".$parts[0]] = "*";
		}

		return $require;
	}
	protected function parseRepositories($pear)
	{
		$repos = array();

		foreach (explode(', ', $pear) as $possibleRepo) {
			if (empty($possibleRepo))
				continue;

			list($channel) = explode('/', $possibleRepo);
			$repos[] = array(
				'type' => 'pear',
				'url'  => 'http://'.$channel
			);
		}
		return $repos;
	}

	protected function parseAuthors($authorsString)
	{
		$authors = array();

		foreach (explode(', ', $authorsString) as $author) {
			list ($name, $email) = explode(' <', $author);
			$authors[] = array(
				'name'  => trim($name),
				'email' => trim($email, ' <>')
			);
		}
		return $authors;
	}
	protected function getInfo()
	{
		$root = $this->projectFolder;
		$contents = array(
			'name'         => new i\VendorName($root) . '/' . new i\PackageName($root),
			'description'  => (string) new i\OneLineSummary($root),
			'version'      => (string) new i\PackageVersion($root),
			'type'         => 'library',
			'time'         => (string) new i\PackageDateTime($root),
			'homepage'     => (string) new i\ProjectHomepage($root),
			'license'      => (string) new i\ProjectLicense($root),
			'authors'      => $this->parseAuthors((string) new i\PackageAuthors($root)),
			'require'      => $this->parseDependencies((string) new i\PearDependencies($root)),
			'repositories' => $this->parseRepositories((string) new i\PearDependencies($root)),
			'version'      => (string) new i\PackageVersion($root),
			'autoload'     => array(
				'psr-0'    => array(
					new i\VendorName($root).'\\'.new i\PackageName($root) => new i\LibraryFolder($root).'/'
					)
			)
		);

		if (empty($contents['repositories']))
			unset($contents['repositories']);

		if (empty($contents['require']))
			unset($contents['require']);

		return $contents;
	}

	public function __toString()
	{
		$root = $this->projectFolder;
		return json_encode_formatted($this->getInfo());
	}
}

if (!function_exists('json_encode_formatted')) {
	function json_encode_formatted($data)
	{
	    if (defined('JSON_PRETTY_PRINT')) {
	        return json_encode($data, JSON_PRETTY_PRINT);
	    }

	    $json       = json_encode($data);
	    $tab        = '    ';
	    $formated   = '';
	    $level      = 0;
	    $in_string  = false;
	    $length     = strlen($json);

	    for ($c = 0; $c < $length; $c++) {
	        $char = $json[$c];
	        switch ($char) {
	            case '{':
	            case '[':
	                if (!$in_string) {
	                    $formated .= $char . PHP_EOL . str_repeat($tab, $level + 1);
	                    $level++;
	                } else {
	                    $formated .= $char;
	                }
	                break;
	            case '}':
	            case ']':
	                if (!$in_string) {
	                    $level--;
	                    $formated .= PHP_EOL . str_repeat($tab, $level) . $char;
	                } else {
	                    $formated .= $char;
	                }
	                break;
	            case ',':
	                if (!$in_string) {
	                    $formated .= ',' . PHP_EOL . str_repeat($tab, $level);
	                } else {
	                    $formated .= $char;
	                }
	                break;
	            case ':':
	                if (!$in_string) {
	                    $formated .= ': ';
	                } else {
	                    $formated .= $char;
	                }
	                break;
	            case '"':
	                if ($c > 0 && $json[$c - 1] != '\\') {
	                    $in_string = !$in_string;
	                }
	            default:
	                $formated .= $char;
	                break;
	        }
	    }

	    return $formated;
	}
}