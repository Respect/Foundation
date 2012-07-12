<?php
namespace Respect\Foundation\Generators;

use Respect\Foundation\ProjectInfo;
use \DirectoryIterator;

/**
 * Produce token replaced template files from library folder/config_templates.
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class ConfigTemplate extends AbstractGenerator
{
    private $template = '';

    public function __call($name, $args) {
        $templateDir = dirname(__DIR__)
            .DIRECTORY_SEPARATOR.'..'
            .DIRECTORY_SEPARATOR.'..'
            .DIRECTORY_SEPARATOR.'config_templates'
            .DIRECTORY_SEPARATOR;
        $templateSuffix = '.template';
        $tokens = $this->getTokens();

        $this->template = strtr(file_get_contents($templateDir.$name.
                        $templateSuffix), $tokens);
    }
    private function getTokens()
    {
        $i = new ProjectInfo($this->projectFolder);
        $infoDir = dirname(__DIR__).DIRECTORY_SEPARATOR.'InfoProviders';

        $tokens = array();
        foreach (new DirectoryIterator($infoDir) as $info)
            if ($info->isFile() && $info->getExtension() == 'php'
                    && false === strpos($info->getFilename(), 'Abstract')) {
                $name = lcfirst($info->getBasename('.php'));
                $tokens['{'.$name.'}'] = (string)$i->$name;
            }

        return $tokens;
    }
    public function __toString()
    {
        return $this->template;
    }
}
