<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 16.01.2018
 * Time: 19:11
 */

namespace App\Service;


use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Orders
{

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    public function getCurrentOrder(): Order
    {
        $id = $this->session->get('current_order_id');

        $order = $id ? $this->em->find(Order::class, $id) : null;

        if (!$order) {
            $order = new Order();
            $this->em->persist($order);
            $this->em->flush();
            $this->session->set('current_order_id', $order->getId());
        }

        return $order;
    }

    public function addProduct(Product $product, $count)
    {
        $order = $this->getCurrentOrder();
        $existingItem = null;

        foreach ($order->getItems() as $item) {
            if ($item->getProduct()->getId() == $product->getId()) {
                $existingItem = $item;
                break;
            }
        }

        if (!$existingItem) {
            $existingItem = new OrderItem();
            $existingItem->setProduct($product);
            $order->addItem($existingItem);
            $this->em->persist($existingItem);
        }

        $existingItem->addCount($count);
        $this->em->flush();
    }

    /**
     * @param OrderItem $item
     */
    public function removeItems(OrderItem $item)
    {
        $this->em->remove($item);
        $this->em->flush();
        $this->getCurrentOrder()->recalculeteItems();
        $this->em->flush();

    }

}