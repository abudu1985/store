<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 */
class User
{
    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var \DateTime
     *
     */
    private $createDate;

    private $orders;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        if (strlen($name) < 5) {
            throw new \Exception('At least 5 characters required!');
        }
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return User
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return array
     */
    public function getPublicInfo()
    {
        $arr = [];
        $arr['id']      = $this->getId();
        $arr['name']    = $this->getName();
        $arr['created'] = $this->getCreateDate()->format('Y-m-d');
        return $arr;
    }
}

