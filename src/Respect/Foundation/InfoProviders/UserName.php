<?php
namespace Respect\Foundation\InfoProviders;

/**
 * Git config user.name
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class UserName extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`git config --get user.name`);
    }
}
