<?php

namespace Respect\Foundation\Generators;

use \ReflectionClass;

class PackageIniTest extends \PHPUnit_Framework_TestCase
{
	public function test_method_getIniString_simple()
	{
		$object   = new PackageIni(realpath(__DIR__.'/../../../../../'));
		$iniArray = array('package' => array('name'=>'Foundation'));
		$expected = <<<INI
[package]
name = Foundation 
INI;
		$this->assertEquals(trim($expected), trim($object->getIniString($iniArray)));
	}

	public function test_method_getIniString_arrays()
	{
		$object   = new PackageIni(realpath(__DIR__.'/../../../../../'));
		$iniArray = array('package'=>array(
								'name'=>'Foundation',
								'author' => 'John Doe <john@doe.net>',
								'authors' => array(
									'Chuck Norris <chuck@norris.org>',
									'Mickey Mouse <mickey@disney.com>'
								)
							));
		$expected = <<<INI
[package]
name = Foundation
author = John Doe <john@doe.net>
authors[] = Chuck Norris <chuck@norris.org>
authors[] = Mickey Mouse <mickey@disney.com>
INI;
		$this->assertEquals(trim($expected), trim($object->getIniString($iniArray)));
	}
}