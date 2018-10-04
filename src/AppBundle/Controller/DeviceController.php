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

class DeviceController extends BaseController
{
    protected $deviceRepository;

    public function __construct(
        DeviceRepository $deviceRepository
    ) {
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * @Rest\Post("/mobile")
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

    /**
     * @Rest\Post("/hoover")
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

    /**
     * @Rest\Post("/freezer")
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

    /**
     * @param Device $device
     * @param array $fields
     * @return Device
     */
    private function createDevice(Device $device, array $fields): Device
    {
        $device->setColor($fields['color']);
        $device->setPrice($fields['price']);
        $device->setFirm($fields['firm']);

        return $device;
    }

    /**
     * @Rest\Get("/device/{id}")
     */
    public function getOneAction(int $id)
    {
        $device = $this->deviceRepository->findOneById($id);
        if (!$device instanceof Device) {
            throw new BadRequestHttpException('Device not found.');
        }
        return $this->createFormatedResponse($device);
    }

    /**
     * @Rest\Get("/devices")
     */
    public function getAllAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Device')->findAll();
        return $this->createApiResponse($restresult, 200);
    }

    /**
     * get all devices related to "type" for example /devices/mobile  or /devices/hoover
     * @Rest\Get("/devices/{alies}")
     */
    public function findAllByAlies(string $alies)
    {
        $devices = $this->deviceRepository->findAllByAlies($alies);
        if (!count($devices)) {
            throw new BadRequestHttpException('Devices not found.');
        }
        return $this->createReFormatedResponse($devices);
    }
}
