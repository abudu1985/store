<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"device" = "Device", "mobile" = "Mobile", "hoover" = "Hoover", "freezer" = "Freezer"})
 * @ExclusionPolicy("all")
 */
class Device
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     * @Groups({"Default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose
     * @Groups({"Default"})
     */
    private $color;


    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=19, scale=2)
     * @Serializer\Expose
     * @Groups({"Default"})
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="firm", type="string", length=255)
     * @Serializer\Expose
     * @Groups({"Default"})
     */
    private $firm;

    /**
     * @param string $firm
     */
    public function setFirm($firm)
    {
        $this->firm = $firm;
    }

    /**
     * @return string
     */
    public function getFirm()
    {
        return $this->firm;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

}

