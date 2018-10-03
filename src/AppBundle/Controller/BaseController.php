<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use AppBundle\Repository\DeviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class BaseController extends Controller
{
    const ENTITY_DIRECTORY = "AppBundle\Entity";

    protected $deviceRepository;

    public function __construct(
        DeviceRepository $deviceRepository
    ) {
        $this->deviceRepository = $deviceRepository;
    }

    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->serialize($data);

        return new Response($json, $statusCode, array(
            'Content-Type' => 'application/json'
        ));
    }

    protected function serialize($data, $format = 'json')
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        return $this->container->get('jms_serializer')
            ->serialize($data, $format, $context);
    }

    protected function createFormatedResponse($data, $format = 'json')
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $json = $serializer->serialize($data, $format, SerializationContext::create()->setGroups(array('Default', 'list')));


        // that for adding type of device
            $arr = (array)json_decode($json);
            $pieces = explode(self::ENTITY_DIRECTORY, get_class($data));
            $arr['device_type'] = preg_replace('/[^A-Za-z\-]/', '',$pieces[1]);
            $json = json_encode($arr);


        return new Response($json, 200, array(
            'Content-Type' => 'application/json'
        ));
    }

    /**
     * @param Device $device
     * @param array $fields
     * @return Device
     */
    protected function createDevice(Device $device, array $fields): Device
    {
        $device->setColor($fields['color']);
        $device->setPrice($fields['price']);
        $device->setFirm($fields['firm']);

        return $device;
    }

//    /**
//     * @Rest\Get("/{id}")
//     */
//    public function getOneAction(int $id)
//    {
//        $device = $this->deviceRepository->findOneById($id);
//        if (!$device instanceof Device) {
//            throw new BadRequestHttpException('Device not found.');
//        }
//
//        return $this->createFormatedResponse($device);
//    }
}
