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

    private $phpunit_xml    = '6d1bf560e7b2bd24384ba24b84718611',
            $bootstrap_php  = '93503ceed4cc54a2a52fd7c73d040f58',
            $pearconfig_xml = '85fe159ea744f204be0d88a131178daa';

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
