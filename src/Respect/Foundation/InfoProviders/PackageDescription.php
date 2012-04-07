<?php

namespace Respect\Foundation\InfoProviders;

class PackageDescription extends AbstractProvider
{
	public function providerOneLineSummary()
	{
		return (string) new OneLineSummary($this->projectFolder);
	}
}