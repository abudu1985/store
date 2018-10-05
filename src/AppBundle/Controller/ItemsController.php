<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OrderItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemsController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $name = $request->request->get('name');
        if(empty($name)) {
            return new Response('Field name can not be empty!', 400);
        }

        $price = $request->request->get('price');
        if(empty($price)) {
            return new Response('Field price can not be empty!', 400);
        }

        $item = new OrderItem();
        $item->setName($name);
        $item->setPrice($price);
        $em = $this->getDoctrine()->getManager();
        $em->persist($item);
        $em->flush();
        return new Response('Item saved!', 201);
    }

    /**
     * @return Response
     */
    public function fetchAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrderItem')->findAll();
        if ($restresult === null) {
            return new Response('No items found!', 204);
        }

        foreach ($restresult as $key => $val) {
            $restresult[$key] = [
                'id' => $val->getId(),
                'name' => $val->getName(),
                'price' => $val->getPrice()
            ];
        }
        return $this->createApiResponse($restresult, 200);

    }
}
