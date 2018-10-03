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

class MobileController extends BaseController
{
    /**
     * @Rest\Post("/mobile")
     */
    public function createMobileAction(Request $request)
    {
        $fields = json_decode($request->getContent(), true);

        $mobile = $this->createDevice(new Mobile(), $fields);
        $mobile->setMemory($fields['memory']);
        $mobile->setRam($fields['ram']);

        $this->deviceRepository->insert($mobile);

        return new Response('Mobile created!', Response::HTTP_CREATED);
    }
}
