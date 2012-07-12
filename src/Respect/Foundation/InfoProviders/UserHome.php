<?php
namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class UserHome extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`echo ~`);
    }
}
