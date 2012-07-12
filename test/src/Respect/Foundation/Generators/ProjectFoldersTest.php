<?php
namespace Respect\Foundation\Generators;

/**
 * @covers Respect\Foundation\Generators\ProjectFolders
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class ProjectFoldersTest extends \PHPUnit_Framework_TestCase
{
    protected   $object,
                $dir    = 'respect://',
                $result = 'cf286b102d7591d5fb843039e37cefad',
                $test   = array (
                                'respect://src',
                                'respect://config',
                                'respect://doc',
                                'respect://bin',
                                'respect://public',
                                'respect://scratch',
                                'respect://test',
                                'respect://vendor',
                                'respect://test/src',
                                'respect://src/Respect',
                                'respect://test/src/Respect',
                                'respect://src/Respect/Foundation',
                                'respect://test/src/Respect/Foundation',
                            );

    protected function setUp()
    {
        stream_wrapper_register('respect', 'Respect\\Foundation\\Generators\\TestStreamWrapper');
        $this->object = new ProjectFolders($this->dir);
    }

    protected function tearDown()
    {
        stream_wrapper_unregister('respect');
    }

    public function testCreateFolders()
    {
        foreach ($this->test as $folder)
            $this->assertFalse(file_exists($folder));
        $this->object->createFolders();
        foreach ($this->test as $folder)
            $this->assertTrue(file_exists($folder));
    }

    public function test__toString()
    {
        TestStreamWrapper::$folders = array();
        $this->object->createFolders();
        $this->assertEquals($this->result, md5($this->object));
    }
}

class TestStreamWrapper
{
    public static $folders = array();

    public function url_stat ($path , $flags)
    {
        return in_array($path, static::$folders)
                ? stat('.')
                : false;
    }
    public function mkdir($path, $mode, $options)
    {
        static::$folders[] = $path;
        return true;
    }
}
