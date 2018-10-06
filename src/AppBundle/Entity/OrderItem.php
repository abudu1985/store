<?php

namespace AppBundle\Entity;


/**
 * OrderItem
 *
 */
class OrderItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     */
    private $price;

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
     * @return OrderItem
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
     * Set price
     *
     * @param string $price
     *
     * @return OrderItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
}

