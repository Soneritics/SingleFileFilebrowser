<?php
/**
 * Class Group
 */
class Group
{
    private $id;
    private $name;
    private $passwd;
    private $members = array();

    public function __construct($groupId)
    {
        $this->id = $groupId;
        $groupInfo = posix_getgrgid($groupId);

        $this->name = !empty($groupInfo['name']) ? $groupInfo['name'] : '';
        $this->passwd = !empty($groupInfo['passwd']) ? $groupInfo['passwd'] : '';
        $this->members = !empty($groupInfo['members']) ? $groupInfo['members'] : array();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }
}
