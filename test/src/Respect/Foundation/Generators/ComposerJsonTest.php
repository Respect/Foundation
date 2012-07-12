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
    private $expected = '1d0b035f453bf0f5ab8ac664f94b5ce9';

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
