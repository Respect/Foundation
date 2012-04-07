<?php

namespace Respect\Foundation;

class ProjectInfoTest extends \PHPUnit_Framework_TestCase
{
	protected $object;

	public function setUp()
	{
		$applicationDir =  realpath(__DIR__.'/../../../../');
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
}