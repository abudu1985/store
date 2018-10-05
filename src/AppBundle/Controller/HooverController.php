<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hoover;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HooverController extends DeviceController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function createHooverAction(Request $request)
    {
        // validation
        $hoover = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Hoover::class,
            'json',
            DeserializationContext::create()->setGroups(['create'])
        );

        $errors = $this->get('validator')->validate($hoover);

        if (count($errors) > 0) {
            return $this->createApiResponse($errors, 422);
        }

        // creation
        $fields = json_decode($request->getContent(), true);
        $hoover = $this->createDevice(new Hoover(), $fields);
        $hoover->setPower($fields['power']);

        $this->deviceRepository->insert($hoover);

        return $this->createApiResponse($hoover, 201);
    }
}
