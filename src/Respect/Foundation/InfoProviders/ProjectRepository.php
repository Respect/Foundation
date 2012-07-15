<?php
namespace Respect\Foundation\InfoProviders;

class ProjectRepository extends AbstractProvider
{
    public function providerGitConfig()
    {
        $configfile = $this->projectFolder.'/.git/config';
        if (file_exists($configfile))
            if (false !== $gitConfig = parse_ini_file($configfile, true))
                if (isset($gitConfig['remote origin']['url']))
                    return $gitConfig['remote origin']['url'];
                else
                    foreach(array_filter(
                        array_keys($gitConfig), function ($k) {
                            return false !== strpos($k, 'remote');
                        })
                    as $key)
                        return $gitConfig[$key]['url'];
        return '';
    }
}
