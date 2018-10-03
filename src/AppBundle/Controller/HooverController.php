<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use AppBundle\Entity\Freezer;
use AppBundle\Entity\Hoover;
use AppBundle\Entity\Mobile;
use AppBundle\Repository\DeviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Repository\AnimalRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;

class HooverController extends BaseController
{
    /**
     * @Rest\Post("/hoover")
     */
    public function createHooverAction(Request $request)
    {
        $fields = json_decode($request->getContent(), true);

        $hoover = $this->createDevice(new Hoover(), $fields);
        $hoover->setPower($fields['power']);

        $this->deviceRepository->insert($hoover);

        return new Response('Hoover created!', Response::HTTP_CREATED);
    }
}