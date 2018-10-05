<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Freezer;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FreezerController extends DeviceController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function createFreezerAction(Request $request)
    {
        // validation
        $freezer = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Freezer::class,
            'json',
            DeserializationContext::create()->setGroups(['create'])
        );

        $errors = $this->get('validator')->validate($freezer);

        if (count($errors) > 0) {
            return $this->createApiResponse($errors, 422);
        }

        // creation
        $fields = json_decode($request->getContent(), true);
        $freezer = $this->createDevice(new Freezer(), $fields);
        $freezer->setTemperature($fields['temperature']);

        $this->deviceRepository->insert($freezer);

        return $this->createApiResponse($freezer, 201);
    }
}
