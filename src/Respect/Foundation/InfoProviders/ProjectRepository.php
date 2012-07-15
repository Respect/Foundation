<?php
namespace Respect\Foundation\InfoProviders;

class ProjectRepository extends AbstractProvider
{
    public function providerGitConfig()
    {
        $configfile = $this->projectFolder.'/.git/config';
        if (file_exists($configfile)) {
            $gitConfig = parse_ini_file($configfile, true);
            return $gitConfig['remote origin']['url'];
        }
        return '';
    }
}
