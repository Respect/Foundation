<?php
namespace Respect\Foundation\InfoProviders;

/**
 * Path to ~.
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class UserHome extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`echo ~`);
    }
}
