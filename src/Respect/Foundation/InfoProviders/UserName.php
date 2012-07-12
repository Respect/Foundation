<?php
namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class UserName extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`git config --get user.name`);
    }
}
