<?php
namespace Respect\Foundation\Generators;

/**
 * @covers Respect\Foundation\Generators\ConfigTemplate
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class ConfigTemplateTest extends \PHPUnit_Framework_TestCase
{
    protected $object,
              $dir;

    private $phpunit_xml    = '4f3ca1cfd13e44f8155c822c5b4d2fe4',
            $bootstrap_php  = 'f2b60238637e65af5dbb676955dc6678',
            $pearconfig_xml = '8d0047dd2ee32ef3c7be1d370d8462e0';

    protected function setUp()
    {
        $this->dir = $applicationDir =  realpath(__DIR__.'/../../../../');
        $this->object = new ConfigTemplate($applicationDir);
    }

    public function test_create_phpunit_xml()
    {
        $this->object->{'phpunit.xml'}();
        $this->assertEquals($this->phpunit_xml, md5((string) $this->object));
    }

    public function test_create_bootstrap_php()
    {
        $this->object->{'bootstrap.php'}();
        $this->assertEquals($this->bootstrap_php, md5((string) $this->object));
    }
    public function test_create_pearconfig_xml()
    {
        $this->object->{'pearconfig.xml'}();
        $this->assertEquals($this->pearconfig_xml, md5((string) $this->object));
    }
}
