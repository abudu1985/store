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

class DefaultController extends BaseController
{
//    private $deviceRepository;
//
//    public function __construct(
//        DeviceRepository $deviceRepository
//    ) {
//        $this->deviceRepository = $deviceRepository;
//    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

//    /**
//     * @Rest\Post("/mobile")
//     */
//    public function createMobileAction(Request $request)
//    {
//        $fields = json_decode($request->getContent(), true);
//
//        $mobile = $this->createDevice(new Mobile(), $fields);
//        $mobile->setMemory($fields['memory']);
//        $mobile->setRam($fields['ram']);
//
//        $this->deviceRepository->insert($mobile);
//
//        return new Response('Mobile created!', Response::HTTP_CREATED);
//    }
//
//    /**
//     * @Rest\Post("/hoover")
//     */
//    public function createHooverAction(Request $request)
//    {
//        $fields = json_decode($request->getContent(), true);
//
//        $hoover = $this->createDevice(new Hoover(), $fields);
//        $hoover->setPower($fields['power']);
//
//        $this->deviceRepository->insert($hoover);
//
//        return new Response('Hoover created!', Response::HTTP_CREATED);
//    }
//
//    /**
//     * @Rest\Post("/freezer")
//     */
//    public function createFreezerAction(Request $request)
//    {
//        $fields = json_decode($request->getContent(), true);
//
//        $freezer = $this->createDevice(new Freezer(), $fields);
//        $freezer->setTemperature($fields['temperature']);
//
//        $this->deviceRepository->insert($freezer);
//
//        return new Response('Freezer created!', Response::HTTP_CREATED);
//    }
//
//    /**
//     * @param Device $device
//     * @param array $fields
//     * @return Device
//     */
//    private function createDevice(Device $device, array $fields): Device
//    {
//        $device->setColor($fields['color']);
//        $device->setPrice($fields['price']);
//        $device->setFirm($fields['firm']);
//
//        return $device;
//    }

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
