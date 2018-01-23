<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 12.01.2018
 * Time: 21:08
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_items")
 */
class OrderItem
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Order|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="items")
     * @ORM\JoinColumn(name="order_id", nullable=true, onDelete="CASCADE")
     */
    private $order;

    /**
     * @var Product|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product_id", nullable=true, onDelete="CASCADE")
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=3)
     */
    private $count;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $amount;

    /**
     * Orderitem constructor.
     */
    public function __construct()
    {
        $this->count = 0;
        $this->amount = 0;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Orderitem
     */
    public function setId(int $id): Orderitem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order|null $order
     * @return Orderitem
     */
    public function setOrder(?Order $order): Orderitem
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return Orderitem
     */
    public function setProduct(?Product $product): Orderitem
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return float
     */
    public function getCount(): float
    {
        return $this->count;
    }

    /**
     * @param float $count
     * @return Orderitem
     */
    public function setCount(float $count): Orderitem
    {
        $this->count = $count;
        $this->amount = $this->product->getPrice() * $count;
        $this->order->recalculeteItems();

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Orderitem
     */
    public function setAmount(float $amount): Orderitem
    {
        $this->amount = $amount;
        return $this;
    }

    public function addCount(float $count): OrderItem
    {
        $this->count += $count;
        $this->setAmount($this->count * $this->product->getPrice());
        $this->order->recalculeteItems();

        return $this;
    }

}