<?php

namespace Respect\Foundation\InfoProviders;

class PhpVersion extends AbstractProvider
{
	public function __toString()
	{
		return implode('.', array_slice(explode('.', phpversion()), 0, 2));
	}
}