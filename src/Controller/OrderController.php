<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 15.01.2018
 * Time: 23:27
 */

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Form\OrderType;
use App\Service\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class OrderController extends Controller
{
    /**
     * @Route("order/add-product/{id}/{count}", name="order_add_product",
     *          requirements={"id": "\d+", "count": "\d+(\.\d+)?"})
     */
    public function addProduct(Product $product, float $count, Orders $orders, Request $request)
    {
        $orders->addProduct($product, $count);

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("cart", name="order_cart")
     */
    public function showCart(Orders $orders)
    {
        return $this->render(
            'order/cart.html.twig',
        ['order' => $orders->getCurrentOrder()]
    );
    }

    /**
     * @Route("cart/remove-item/{id}", name="order_remove_item")
     * @param OrderItem $item
     */

    public  function  removeItem(OrderItem $item, Orders $orders)
    {
        $orders->removeItems($item);
        return $this->redirectToRoute('order_cart');
    }

    /**
     * @Route("order/complete", name="order_complete")
     */
    public function comleteOrder(Orders $orders, Request $request, \Swift_Mailer $mailer)
    {
        $order = $orders->getCurrentOrder();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         $this->sendEmails($order, $mailer);
         $orders->makeOrder($order);
         $this->addFlash($order->getId(), 'last_order');

         return $this->redirectToRoute('order_success');
        }

        return $this->render('order/completeForm.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("order/success", name="order_success")
     */
    public function successOrder()
    {
        return $this->render('order/success.html.twig');
    }

    public function sendEmails(Order $order, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Новый заказ'))
            ->setFrom([getenv('MAILER_FROM') => getenv('MAILER_FROM_NAME')])
            ->setTo(getenv('ADMIN_EMAIL'))
            ->setBody(
                $this->renderView(
                    'order/admin_message.html.twig',
                    array('order' => $order)
                ),
                'text/html'
            );

        $mailer->send($message);

        $message = (new \Swift_Message('Ваш заказ'))
            ->setFrom([getenv('MAILER_FROM') => getenv('MAILER_FROM_NAME')])
            ->setTo([$order->getEmail() => $order->getCustomerName()])
            ->setBody(
                $this->renderView(
                    'order/customer_message.html.twig',
                    array('order' => $order)
                ),
                'text/html'
            );

        $mailer->send($message);


    }

}