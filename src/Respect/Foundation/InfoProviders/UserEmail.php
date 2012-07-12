<?php
namespace Respect\Foundation\InfoProviders;

use DirectoryIterator;

class UserEmail extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`git config --get user.email`);
    }
}
