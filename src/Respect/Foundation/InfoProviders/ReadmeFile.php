<?php
namespace Respect\Foundation\InfoProviders;

use GlobIterator;

class ReadmeFile extends AbstractProvider
{
    public function providerFolderStructure()
    {
        foreach (new GlobIterator($this->projectFolder.'/README*') as $possibleReadme)
            return $possibleReadme->getFileName();
    }
}
