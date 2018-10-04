<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Entity
 */
class Hoover extends Device
{

    /**
     * @ORM\Column(name="power", type="integer")
     * @Groups({"create", "list"})
     */
    private $power;

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }

}
