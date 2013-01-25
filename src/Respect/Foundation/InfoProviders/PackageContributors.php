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
        $uniques  = array();
        foreach (array_reverse($authors, true) as $key => $author) {
            $unique = explode('|||', preg_replace('/^(.+[^<])<([^>]+)>$/', '$1|||$2', $author));
            if (!array_key_exists($unique[1], $uniques)) {
                $found_name = count(array_filter($uniques, function($v) use ($unique) {
                    return  $v[1] == $unique[0];
                }));
                if($found_name) // same name different e-mail
                    unset($authors[$key]);
                $uniques[$unique[1]] = array($key, $unique[0]);
                continue;
            }
            if (strlen($unique[0]) <=  strlen($uniques[$unique[1]][1]))
                unset($authors[$key]);
            else // longer name
                unset($authors[$uniques[$unique[1]][0]]);
        }
        return implode(', ', $authors);
    }
}
