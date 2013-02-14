<?php
namespace Respect\Foundation\Generators;

/**
 * @covers Respect\Foundation\Generators\ProjectFolders
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class ProjectFoldersTest extends \PHPUnit_Framework_TestCase
{
    protected   $object,
                $dir    = 'respect://package',
                $result = '548344eb82a629974a708b24be5c087a',
                $test   = array (
                                'respect://package/src',
                                'respect://package/config',
                                'respect://package/doc',
                                'respect://package/bin',
                                'respect://package/public',
                                'respect://package/scratch',
                                'respect://package/tests',
                                'respect://package/vendor',
                                'respect://package/tests/src',
                                'respect://package/src/Respect',
                                'respect://package/tests/src/Respect',
                                'respect://package/src/Respect/Foundation',
                                'respect://package/tests/src/Respect/Foundation',
                            );

    protected function setUp()
    {
        if(function_exists('apc_cache_info') && @apc_cache_info())
            $this->markTestSkipped("StreamWrapper and apc.enable_cli do not get along.");

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
    public function testCreateFoldersWithTrailingSlash()
    {
        TestStreamWrapper::$folders = array();
        $this->object = new ProjectFolders($this->dir.DIRECTORY_SEPARATOR);
        $this->testCreateFolders();
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
