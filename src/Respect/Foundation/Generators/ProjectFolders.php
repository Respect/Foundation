<?php
namespace Respect\Foundation\Generators;

/**
 * Ensure that all the project folders are created based on info from
 * the AbstractFolderFinder type InfoProvidrs.
 *
 * @author Nick Lombard <github@jigsoft.co.za>
 */
use Respect\Foundation\InfoProviders as i;
use \UnexpectedValueException;
use \ReflectionClass;
use \DirectoryIterator;

class ProjectFolders extends AbstractGenerator
{

    private $consoleLog = 'Ready to serve but nothing for me to do.';

    private function getSubClassesForParent($parent)
    {
        if (!@class_exists($parent))
            throw new UnexpectedValueException("$parent must be a valid class.");

        $parent = new ReflectionClass($parent);

        if (file_exists($path = dirname($parent->getFileName())))
            foreach (new DirectoryIterator($path) as $entry)
                if (pathinfo($entry->getFilename(), PATHINFO_EXTENSION) == 'php')
                    include_once $entry->getPathname();

        return array_filter(get_declared_classes(),
            function($class) use ($parent) {
                $class = new ReflectionClass($class);
                return $class->getParentClass() == $parent;
            }
        );
    }

    /**
     * create a folder for each AbstractFolderFinder implementation.
     */
    public function createFolders()
    {
        $root = $this->projectFolder;

        $parent  = 'Respect\\Foundation\\InfoProviders\\AbstractFolderFinder';
        $folders = $this->getSubClassesForParent($parent);
        array_walk($folders, function (&$class) use ($root) {
            $folder = new ReflectionClass($class);
            $object = $folder->newInstance($root);
            $class  = $folder->getMethod('__toString')->invoke($object);
        });

        if (false != ($vendor = (string) new i\VendorName($root))) {
            $folders[] = new i\TestFolder($root) . DIRECTORY_SEPARATOR .  new i\LibraryFolder($root);
            $folders[] = $vendor =  new i\LibraryFolder($root) . DIRECTORY_SEPARATOR . $vendor;
            $folders[] = new i\TestFolder($root) . DIRECTORY_SEPARATOR . $vendor;
            $folders[] = $vendor = $vendor . DIRECTORY_SEPARATOR . new i\PackageName($root);
            $folders[] = new i\TestFolder($root) . DIRECTORY_SEPARATOR . $vendor;
        }

        $root .= DIRECTORY_SEPARATOR;
        foreach ($folders as $key => $dir){
            if (!file_exists($root  . $dir))
                mkdir($root . $dir, 0755);
            else
                unset($folders[$key]);
        }

        if (empty($folders))
            return;
        $this->consoleLog = "\nCreating project folder structure:\n\n";

        $this->consoleLog .= implode(PHP_EOL, $folders) . "\n\nProject folders ok\n";
    }

    public function __toString()
    {
        return $this->consoleLog . PHP_EOL . PHP_EOL;
    }
}
