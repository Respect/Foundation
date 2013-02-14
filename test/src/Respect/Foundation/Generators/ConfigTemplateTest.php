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

    private $phpunit_xml    = 'c27d94a9d7cf1907a71e10110f6164b6',
            $bootstrap_php  = '93503ceed4cc54a2a52fd7c73d040f58',
            $pearconfig_xml = 'bc08d20709730f482361296201816e66';

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
