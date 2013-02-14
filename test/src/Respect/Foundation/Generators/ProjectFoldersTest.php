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
        $this->assertContains('tests/src/Respect', (string) $this->object);
        $this->assertNotEmpty($this->object.'');
        $this->assertStringEndsWith('Project folders ok', trim(''.$this->object));
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
