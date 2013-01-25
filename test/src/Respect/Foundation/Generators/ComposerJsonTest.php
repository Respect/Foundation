<?php
namespace Respect\Foundation\Generators;

/**
 * @covers Respect\Foundation\Generators\ComposerJson
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class ComposerJsonTest extends \PHPUnit_Framework_TestCase
{
    protected   $object,
                $dir;
    private $expected = '8bfb2a610adadc47120d02cdc1529360';

    protected function setUp()
    {
        $this->dir = $applicationDir =  realpath(__DIR__.'/../../../../');
        $this->object = new ComposerJson($applicationDir);
    }

    public function test__toString()
    {
        $this->assertEquals($this->expected, md5((string) $this->object));
    }
}
