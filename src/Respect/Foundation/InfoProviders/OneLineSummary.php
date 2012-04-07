<?php

namespace Respect\Foundation\InfoProviders;

class OneLineSummary extends AbstractProvider
{
	public function providerReadme()
	{
		$readme      = file_get_contents($this->projectFolder.'/'.new ReadmeFile($this->projectFolder));
		$readmeParts = explode("\n\n", $readme);

		if (isset($readmeParts[1]))
			return $readmeParts[1];

		return '';
	}
}