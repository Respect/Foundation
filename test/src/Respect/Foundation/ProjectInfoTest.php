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
		$this->assertEquals('git@github.com:Respect/Foundation', (string) $this->object->projectRepository);
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

	public function testProjectName()
	{
		$this->assertEquals('Respect/Foundation', (string) $this->object->projectName);
	}

	public function testReadmeFile()
	{
		$this->assertEquals('README.md', (string) $this->object->readmeFile);
	}

	public function testOneLineSummary()
	{
		$this->assertEquals('A conventional project tool for PHP and git.', (string) $this->object->oneLineSummary);
	}

	public function testPackageDescription()
	{
		$this->assertEquals('A conventional project tool for PHP and git.', (string) $this->object->packageDescription);
	}
	public function testPackageAuthors()
	{
		$this->assertContains('Alexandre', (string) $this->object->packageAuthors);
	}
	public function testGenerate()
	{
            $this->assertInstanceOf('Respect\\Foundation\\Generators\\PackageIni', $this->object->generate('package-ini'));
            $this->assertInstanceOf('Respect\\Foundation\\Generators\\PackageIni', $this->object->generate('packageIni'));
            $this->assertInstanceOf('Respect\\Foundation\\Generators\\PackageIni', $this->object->generate('PackageIni'));
            $this->assertInstanceOf('Respect\\Foundation\\Generators\\PackageIni', $this->object->generate('package ini'));
            $this->assertInstanceOf('Respect\\Foundation\\Generators\\PackageIni', $this->object->generate('package_ini'));
	}

}