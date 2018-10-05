<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use AppBundle\Entity\Freezer;
use AppBundle\Entity\Hoover;
use AppBundle\Entity\Mobile;
use AppBundle\Repository\DeviceRepository;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class MobileController extends DeviceController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function createMobileAction(Request $request)
    {
        // validation
        $mobile = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Mobile::class,
            'json',
            DeserializationContext::create()->setGroups(['create'])
        );

        $errors = $this->get('validator')->validate($mobile);

        if (count($errors) > 0) {
            return $this->createApiResponse($errors, 422);
        }

        // creation
        $fields = json_decode($request->getContent(), true);
        $mobile = $this->createDevice(new Mobile(), $fields);
        $mobile->setMemory($fields['memory']);
        $mobile->setRam($fields['ram']);

        $this->deviceRepository->insert($mobile);

        return $this->createApiResponse($mobile, 201);
    }
}
