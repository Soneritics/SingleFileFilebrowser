<?php
/**
 * Class FileInstance
 */
class FileInstance extends IOInstance
{
    private $size = 0;

    /**
     * @param SplFileInfo $splFileInfo
     */
    protected function  processFileInfo(SplFileInfo $splFileInfo)
    {
        $this->size = $splFileInfo->getSize();
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
