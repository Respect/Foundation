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
            $bootstrap_php  = 'afa564bd3a29aa4dbcdc18f554145d15';

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
        $xml = simplexml_load_string(''.$this->object);
        $this->assertStringEndsWith('cache', ''.$xml->cache_dir);
        $this->assertObjectHasAttribute('plugins_dir', $xml);
        $this->assertEquals('stable', $xml->preferred_state);
    }
}
