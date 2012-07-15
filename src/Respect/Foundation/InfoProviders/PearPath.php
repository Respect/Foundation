<?php
namespace Respect\Foundation\InfoProviders;

/**
 * Pear installation path
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class PearPath extends AbstractProvider
{
    public function providerDefault()
    {
        return trim(`pear config-get php_dir`);
    }
}
