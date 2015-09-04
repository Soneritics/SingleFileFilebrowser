<?php
/**
 * Class IOInstance
 */
abstract class IOInstance
{
    protected $name;
    protected $lastAccesTime = 0;
    protected $lastModificationTime = 0;
    protected $group;
    protected $owner;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLastAccesTime()
    {
        return $this->lastAccesTime;
    }

    /**
     * @return int
     */
    public function getLastModificationTime()
    {
        return $this->lastModificationTime;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param SplFileInfo $splFileInfo
     * @return void
     */
    protected abstract function  processFileInfo(SplFileInfo $splFileInfo);

    /**
     * @param SplFileInfo $splFileInfo
     */
    public final function __construct(SplFileInfo $splFileInfo)
    {
        $this->setDefaultInfo($splFileInfo);
        $this->processFileInfo($splFileInfo);
    }

    /**
     * @param SplFileInfo $splFileInfo
     */
    private function setDefaultInfo(SplFileInfo $splFileInfo)
    {
        $this->name = $splFileInfo->getFilename();
        $this->lastAccesTime = $splFileInfo->getATime();
        $this->lastModificationTime = $splFileInfo->getMTime();
        $this->group = new Group($splFileInfo->getGroup());
        $this->owner = $splFileInfo->getOwner();
    }
}
