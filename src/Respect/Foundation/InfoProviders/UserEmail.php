<?php
namespace Respect\Foundation\InfoProviders;

/**
 * Git config user.email
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class UserEmail extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`git config --get user.email`);
    }
}
