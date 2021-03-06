<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends BaseController
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

        $user = new User();
        $user->setName($name);
        $date = new DateTime(date('Y-m-d', time()));
        $user->setCreateDate($date);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new Response('User saved!', 201);
    }

    /**
     * @return Response
     */
    public function fetchAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        if ($restresult === null) {
            return new Response('No users found!', 204);
        }

        foreach ($restresult as $key => $val) {
            $restresult[$key] = [
                'id' => $val->getId(),
                'name' => $val->getName(),
                'created' => $val->getCreateDate()->format('Y-m-d')
            ];
        }

        return $this->createApiResponse($restresult, 200);
    }
}
