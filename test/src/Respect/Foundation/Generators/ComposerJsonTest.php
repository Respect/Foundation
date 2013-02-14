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

    protected function setUp()
    {
        $this->dir = $applicationDir =  realpath(__DIR__.'/../../../../');
        $this->object = new ComposerJson($applicationDir);
    }

    public function test__toString()
    {
        $val = json_decode(''.$this->object);
        $this->assertEquals('Respect/Foundation', $val->name);
        $this->assertObjectHasAttribute('psr-0', $val->autoload);
    }
}
