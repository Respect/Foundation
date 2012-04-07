<?php

namespace Respect\Foundation;

class ProjectInfoTest extends \PHPUnit_Framework_TestCase
{
	protected $object;
	protected $dir;

	public function setUp()
	{
		$this->dir = $applicationDir =  realpath(__DIR__.'/../../../../');
		$this->object = new ProjectInfo($applicationDir); 
	}

	public function testPhpVersion()
	{
		$this->assertStringStartsWith((string) $this->object->phpVersion, phpversion());
		$this->assertTrue(3 == strlen($this->object->phpVersion));
	}

	public function testProjectRepository()
	{
		$this->assertEquals('Respect/Foundation', (string) $this->object->projectRepository);
	}

	public function testProjectFolder()
	{
		$this->assertEquals($this->dir, (string) $this->object->projectFolder);
	}

	public function testLibraryfolder()
	{
		$this->assertEquals('src', (string) $this->object->libraryFolder);
	}

	public function testConfigFolder()
	{
		$this->assertEquals('config', (string) $this->object->configFolder);
	}

	public function testPublicFolder()
	{
		$this->assertEquals('public', (string) $this->object->publicFolder);
	}

	public function testExecutablesFolder()
	{
		$this->assertEquals('bin', (string) $this->object->executablesFolder);
	}

	public function testVendorName()
	{
		$this->assertEquals('Respect', (string) $this->object->vendorName);
	}

	public function testPackageName()
	{
		$this->assertEquals('Foundation', (string) $this->object->packageName);
	}
}