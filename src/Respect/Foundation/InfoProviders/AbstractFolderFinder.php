<?php
namespace Respect\Foundation\InfoProviders;

abstract class AbstractFolderFinder extends AbstractProvider
{
    public $searchFolders = array();

    public function providerFoundFolder()
    {
        foreach ($this->searchFolders as $folder)
            if (is_dir($this->projectFolder."/".$folder))
                return $folder;

        return reset($this->searchFolders) ?: '';
    }

    protected function runProviders($providers)
    {
        usort($providers, function($a, $b) {
            return method_exists(__CLASS__, $a);
        });
        return parent::runProviders($providers);
    }
}
