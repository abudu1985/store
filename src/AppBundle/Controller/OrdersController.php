<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OrderItem;
use AppBundle\Entity\Orders;
use AppBundle\Entity\User as User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $data = $this->getDoctrine()
            ->getRepository(OrderItem::class)
            ->getTotCost($request->request->get('items'));

        $name = $request->request->get('name');
        if(empty($name)) {
            return new Response('Field name can not be empty!', 400);
        }

        $orderItems = json_encode($data['itm']);

        $createDate = new DateTime(date('Y-m-d', time()));

        $u = $request->request->get('user');
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($u['id']);

        if(empty($user)) {
            return new Response('There is no registered user!', 400);
        }

        $order = new Orders();
        $order->setName($name);
        $order->setCreateDate($createDate);
        $order->setTotalQty($data['tq']);
        $order->setTotalPrice( $data['tp']);
        $order->setOrderItems($orderItems);
        $order->setOrderUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();
        return new Response('Order saved!', 201);
    }

    /**
     * @return Response
     */
    public function fetchAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Orders')->findAll();
        if ($restresult === null) {
            return new Response('No users found!', 204);
        }

        foreach ($restresult as $key => $val) {

            $restresult[$key] = [
                'id' => $val->getId(),
                'name' => $val->getName(),
                'total_qty' => $val->getTotalQty(),
                'total_price' => $val->getTotalPrice(),
                'user' => $val->getOrderUser()->getPublicInfo(),
                'items' => json_decode($val->getOrderItems())
            ];
        }
        //return $this->createApiResponse($restresult);
        //return new Response(json_encode($restresult));

        return new Response(json_encode($restresult), 200, array(
            'Content-Type' => 'application/json'
        ));
    }
}
