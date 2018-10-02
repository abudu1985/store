<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     */
    private $updatedDate;

    /**
     * @var int
     *
     * @ORM\Column(name="total_qty", type="integer")
     */
    private $totalQty;

    /**
     * @var string
     *
     * @ORM\Column(name="total_price", type="decimal", precision=19, scale=2)
     */
    private $totalPrice;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $orderUser;

    /**
     * @var string
     *
     * @ORM\Column(name="order_items", type="text")
     */
    private $orderItems;


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
     * @return Orders
     */
    public function setName($name)
    {
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
     * @return Orders
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
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Orders
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set totalQty
     *
     * @param integer $totalQty
     *
     * @return Orders
     */
    public function setTotalQty($totalQty)
    {
        $this->totalQty = $totalQty;

        return $this;
    }

    /**
     * Get totalQty
     *
     * @return int
     */
    public function getTotalQty()
    {
        return $this->totalQty;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     *
     * @return Orders
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set orderUser
     *
     * @param integer $orderUser
     *
     * @return Orders
     */
    public function setOrderUser(\AppBundle\Entity\User $orderUser)
    {
        $this->orderUser = $orderUser;

        return $this;
    }

    /**
     * Set orderItems
     *
     * @param string $orderItems
     *
     * @return Orders
     */
    public function setOrderItems($orderItems)
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    /**
     * Get orderItems
     *
     * @return string
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @return mixed
     */
    public function getOrderUser(): User
    {
        return $this->orderUser;
    }
}

