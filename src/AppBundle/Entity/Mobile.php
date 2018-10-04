<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class Mobile extends Device
{

    /**
     * @ORM\Column(name="memory", type="integer")
     * @Groups({"create", "list"})
     */
    private $memory;

    /**
     * @ORM\Column(name="ram", type="decimal", precision=19, scale=2)
     * @Groups({"create", "list"})
     */
    private $ram;

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param mixed $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @return mixed
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * @param mixed $ram
     */
    public function setRam($ram)
    {
        $this->ram = $ram;
    }

}
