<?php
/**
 * Class DirectoryInstance
 */
class DirectoryInstance extends IOInstance
{
    private $files = 0;
    private $directories = 0;

    /**
     * @param SplFileInfo $splFileInfo
     */
    protected function  processFileInfo(SplFileInfo $splFileInfo)
    {
        $this->files = 0;
        $this->directories = 0;

        $directoryIterator = new DirectoryIterator($splFileInfo->getRealPath());
        if (empty($directoryIterator)) {
            return;
        }

        foreach ($directoryIterator as $splObject) {
            if ($splObject->isDot() !== true && $splObject->isDir() === true) {
                $this->directories++;
            } elseif ($splObject->isFile() === true) {
                $this->files++;
            }
        }
    }

    /**
     * @return int
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return int
     */
    public function getDirectories()
    {
        return $this->directories;
    }
}
